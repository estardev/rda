<?php

namespace estar\rda\RdaBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\DependencyInjection\ContainerAware;
use BeSimple\SoapClient;
use BeSimple\SoapServer;
use BeSimple\SoapCommon;
use BeSimple\SoapBundle;
use BeSimple\SoapWsdl;
use Doctrine\Entity;
use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Entity\Utente;


class ServerESTARController extends Controller
{

    /**
     * @Soap\Method("notify")
     * @Soap\Param("username", phpType = "string")
     * @Soap\Param("password", phpType = "string")
     * @Soap\Param("note", phpType = "string")
     * @Soap\Param("idpratica", phpType = "int")
     * @Soap\Param("dataRequest", phpType = "dateTime")
     * @Soap\Param("codicestato", phpType = "int")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\String[]")
     */
    public function notifyAction($username, $password, $note=null, $idpratica, $dataRequest=null, $codicestato)
    {   $username=strtolower($username);
        $em = $this->getDoctrine()->getManager();
        //$postdata = file_get_contents("php://input");
        //file_put_contents("file1.txt",$postdata);

        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataRispostaServer = $dateTime->format(\DateTime::W3C);

        try {
        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
        $utente = $user_manager->loadUserByUsername($username);
        $encoder = $factory->getEncoder($utente);
        $boolvalore = ($encoder->isPasswordValid($utente->getPassword(), $password, $utente->getSalt())) ? "true" : "false";
        } catch(\Exception $e) {

            throw new \SoapFault('Errore', 'not found');
        }

        ////controllare che esista l'utente sistematica e che la password sia quella
        //$utente = $em->getRepository('estarRdaBundle:Utente')->findBy(
        //    array('username' => "$user", 'password' => $pwd));
//
        //$userManager = $this->container->get('fos_user.user_manager');


        if ($username != 'sistematica' AND $boolvalore) {
            $messaggioErrore = "KO";
            $codice = "040";  //KO
            $descrizioneErrore = "Credenziali non corrette";
            return array(
                'CoriceRisposta' => $messaggioErrore,
                'codiceErrore' => $codice,
                'DescrizioneErrore' => $descrizioneErrore,
                'data' => $dataRispostaServer
            );

        } else {
            try {
                $risposta = $this->get('model.richiesta')->getPratica($utente, $dataRequest, $note, $idpratica, $codicestato);
                return array(
                    'CoriceRisposta' => $risposta->getCodiceRisposta(),
                    'codiceErrore' => $risposta->getCodiceErrore(),
                    'DescrizioneErrore' => $risposta->getDescrizioneErrore(),
                    'data' => $risposta->getDataRisposta()
                );
                } catch(\Exception $e) {
                    throw new \SoapFault('Errore', 'not found');
                }



            //  return array(
            //      'CoriceRisposta' => 00,
            //      'codiceErrore' => 01,
            //      'DescrizioneErrore' => "ciao",
            //      'data' =>  $dataRispostaServer
            //  );
//
        }
    }
}
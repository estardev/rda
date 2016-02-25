<?php

namespace estar\rda\RdaBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\DependencyInjection\ContainerAware;
//use Symfony\Component\Security\Core\Security;
//use Symfony\Component\Security\Core\SecurityContextInterface;
//use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use BeSimple\SoapClient;
use BeSimple\SoapServer;
use BeSimple\SoapCommon;
use BeSimple\SoapBundle;
use BeSimple\SoapWsdl;
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
    {   $boolvalore=false;
        $username1=strtolower($username);
        $em = $this->getDoctrine()->getManager();
        //$postdata = file_get_contents("php://input");
        //file_put_contents("file1.txt",$postdata);

        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataRispostaServer = $dateTime->format(\DateTime::W3C);

        try {
            $utente = $em->getRepository('estarRdaBundle:Utente')->findOneBy(
            array('username' => "$username1", 'utentecartaoperatore' => $password));

            if ($utente) {
                //$user_manager = $this->get('fos_user.user_manager');
                //$user = $user_manager->findUserByUsername($username);
                //$token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                //$this->get('security.token_storage')->setToken($token);
                $boolvalore=true;
            }
        } catch(\Exception $e) {

            throw new \SoapFault('Errore', 'Contattare i sistemisti');
        }

        ////controllare che esista l'utente sistematica e che la password sia quella
        //$utente = $em->getRepository('estarRdaBundle:Utente')->findBy(
        //    array('username' => "$user", 'password' => $pwd));
//
        //$userManager = $this->container->get('fos_user.user_manager');


        if ($username1 != 'sistematica'  AND !$boolvalore) {
            $messaggioErrore = "KO";
            $codice = "040";  //KO
            $descrizioneErrore = "Credenziali non corrette";
            return array(
                'CodiceRisposta' => $messaggioErrore,
                'codiceErrore' => $codice,
                'DescrizioneErrore' => $descrizioneErrore,
                'data' => $dataRispostaServer
            );

        } else {
            try {
                $risposta = $this->get('model.richiesta')->getPratica($utente, $dataRequest, $note, $idpratica, $codicestato);
                return array(
                    'CodiceRisposta' => $risposta->getCodiceRisposta(),
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
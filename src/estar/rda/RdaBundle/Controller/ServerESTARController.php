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
     * @Soap\Param("dataRequest", phpType = "string")
     * @Soap\Param("codicestato", phpType = "int")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\String[]")
     */
    public function notifyAction($username, $password, $note=null, $idpratica, $dataRequest=null, $codicestato)
    {   $username1=strtolower($username);
        $em = $this->getDoctrine()->getManager();
        $postdata = file_get_contents("php://input");
        file_put_contents(time()."_request.xml",$postdata);

        //file_put_contents(time()."_user.xml",$username);
        //file_put_contents(time()."_psw.xml",$password);
        //file_put_contents(time()."_note.xml",$note);
        //file_put_contents(time()."_idp.xml",$idpratica);
        //file_put_contents(time()."_data.xml",$dataRequest);
        //file_put_contents(time()."_cod.xml",$codicestato);

        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataRispostaServer = $dateTime->format(\DateTime::ATOM);

        try {
            $utente = $em->getRepository('estarRdaBundle:Utente')->findOneBy(
            array('username' => "$username1", 'utentecartaoperatore' => $password));

            if (!$utente) {
                    //SE C'è BISOGNO DI ABILITARE IL LOGIN TRAMITE WS ABILITARE QUESTE RIGHE
                //$user_manager = $this->get('fos_user.user_manager');
                //$user = $user_manager->findUserByUsername($username);
                //$token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                //$this->get('security.token_storage')->setToken($token);
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
                $risposta = $this->get('model.richiesta')->getPratica($utente, $dataRequest, $note, $idpratica, $codicestato);
                return array(
                    'CodiceRisposta' => $risposta->getCodiceRisposta(),
                    'codiceErrore' => $risposta->getCodiceErrore(),
                    'DescrizioneErrore' => $risposta->getDescrizioneErrore(),
                    'data' => $risposta->getDataRisposta()
                );

        }
        } catch(\Exception $e) {
            throw new \SoapFault('Errore', 'Contattare i sistemisti');
        }
    }
}
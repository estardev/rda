<?php

namespace estar\rda\RdaBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Symfony\Component\DependencyInjection\ContainerAware;
//use Symfony\Component\Security\Core\Security;
//use Symfony\Component\Security\Core\SecurityContextInterface;
//use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
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
     * @Soap\Param("documentazione", phpType = "string")
     * @Soap\Param("idpratica", phpType = "int")
     * @Soap\Param("dataRequest", phpType = "string")
     * @Soap\Param("codicestato", phpType = "string")
     * @Soap\Param("codicegara", phpType = "string")
     * @Soap\Param("prioritaGestav", phpType = "string")
     * @Soap\Param("rup", phpType = "string")
     * @Soap\Param("numeroAttoAggiudicazione", phpType = "string")
     * @Soap\Param("numeroProtocolloLettera", phpType = "string")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\Stringa[]")
     */
    public function notifyAction($username, $password, $note = null, $documentazione=null, $idpratica, $dataRequest = null, $codicestato, $codicegara = null, $rup = null, $numeroAttoAggiudicazione = null, $numeroProtocolloLettera = null, $prioritaGestav = null)
    {
        $logger = $this->get('sistematicaserver_logger');
        $logger->log('ServerEstarController: Invocato: note ' . $note . ', idpratica ' . $idpratica . ', codicestato ' . $codicestato);
        $username1 = strtolower($username);
        $em = $this->getDoctrine()->getManager();
        $postdata = file_get_contents("php://input");
        file_put_contents("REQUESTclient/" . rand() . time() . "_request.xml", $postdata);
        $logger->log('ServerEstarController:  XML puro: ' . $postdata);

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
                $logger->log('Autenticazione fallita');
                return array(
                    'CodiceRisposta' => $messaggioErrore,
                    'codiceErrore' => $codice,
                    'DescrizioneErrore' => $descrizioneErrore,
                    'data' => $dataRispostaServer
                );

            } else {
                $logger->log('ServerEstarController: Avvio processing richiesta');
                $risposta = $this->get('model.richiesta')->getPratica($utente, $dataRequest, $note, $documentazione, $idpratica, $codicestato, $codicegara, $rup, $numeroAttoAggiudicazione, $numeroProtocolloLettera, $prioritaGestav);
                $logger->log('ServerEstarController: Termine processing richiesta');
                if (is_null($risposta)) {
                    $logger->log('ServerEstarController:  RichiestaModel ha dato risposta null');
                } else {
                    $logger->log('ServerEstarController: Ricevuta risposta da richiesta model: ' . $risposta->getCodiceRisposta());
                }
//              Invio mail in caso di esito positivo nei sequenti casi:
//                $codicestato == '090'  In aggiudicazione
//                $codicestato == '030'  attesa documentazione aggiuntiva tecnica
//                $codicestato == '031'  attesa documentazione aggiuntiva amministrativa
//                $codicestato == '130'  attesa documentazione aggiuntiva tecnica rup
//                $codicestato == '091'  In aggiudicazione parziale
//                $codicestato == '040'  Rigetto pratica controllo tecnico
//                $codicestato == '041'  Rigetto pratica controllo amministrativo
//                $codicestato == '100' Chiusa da ESTAR per termine iter (da aggiungere)
//                $codicestato == '140' Chiusura senza esito ESTAR (da aggiungere)
//                20181016 zanna rimosso codice '090', aggiunti codici '100' e '140'
                if ($risposta->getCodiceRisposta() != 'KO'  and  ($codicestato == '030' or $codicestato == '031' or $codicestato == '130' or
                                                                  $codicestato == '091' or $codicestato == '040' or $codicestato == '041' or
                                                                  $codicestato == '100' or $codicestato == '140')
                    ) {
                    $logger->log('ServerEstarController: Avvio invio mail');
                    //FG20180313 invio della mail in try-catch perchè ho il sentore che fallisca.
                    try {
                        $mail = new EmailController($this->getDoctrine()->getManager(), $this->get('service_container'));
                        $mail->notifyEmailAction($idpratica);
                        $logger->log('ServerEstarController: Termine invio mail');
                    } catch (\Exception $e) {
                        $logger->log('ServerEstarController: Errore invio mail: ' . $e->getMessage());
                    }

                }
                $logger->log('ServerEstarController: Fine');
                return array(
                    'CodiceRisposta' => $risposta->getCodiceRisposta(),
                    'codiceErrore' => $risposta->getCodiceErrore(),
                    'DescrizioneErrore' => $risposta->getDescrizioneErrore(),
                    'data' => $risposta->getDataRisposta()
                );

            }
        } catch (\Exception $e) {
            $logger->log('Eccezione non trappata: ' . $e->getMessage());
            throw new \SoapFault('Errore', 'Contattare i sistemisti ' . $e->getMessage());
        }
    }


    /** test
     * */
    public function indexAction()
    {
        $logger = $this->get('sistematicaserver_logger');
        $logger->log('ServerEstarController: Index: invocato');
        return new Response("ok");

    }
}
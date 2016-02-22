<?php

namespace estar\rda\RdaBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerAware;
use BeSimple\SoapClient;
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
     * @Soap\Param("pwd", phpType = "string")
     * @Soap\Param("note", phpType = "string")
     * @Soap\Param("idpratica", phpType = "int")
     * @Soap\Param("dataRequest", phpType = "dateTime")
     * @Soap\Param("codicestato", phpType = "int")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\String[]")
     */
    public function notifyAction($username, $password, $note=null, $idpratica, $dataRequest, $codicestato)
    {   $em = $this->getDoctrine()->getManager();


        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataRispostaServer=  $dateTime->format(\DateTime::W3C);

        $user_manager = $this->get('fos_user.user_manager');
        $factory = $this->get('security.encoder_factory');
        $user = $user_manager->loadUserByUsername($username);
        $encoder = $factory->getEncoder($user);
        $boolvalore = ($encoder->isPasswordValid($user->getPassword(),$password,$user->getSalt())) ? "true" : "false";



        ////controllare che esista l'utente sistematica e che la password sia quella
        //$utente = $em->getRepository('estarRdaBundle:Utente')->findBy(
        //    array('username' => "$user", 'password' => $pwd));
//
        //$userManager = $this->container->get('fos_user.user_manager');



        if($username != 'Sistematica' AND !$boolvalore){
            $messaggioErrore="KO";
            $codice="040";  //KO
            $descrizioneErrore="Credenziali non corrette";
            return array(
                'CoriceRisposta' => $messaggioErrore,
                'codiceErrore' => $codice,
                'DescrizioneErrore' => $descrizioneErrore,
                'data' =>  $dataRispostaServer
            );

        }
        else{

            $risposta = $this->get('model.richiesta')->getPratica($utente, $note, $idpratica, $codicestato);
           //richiamoModel($idpratica, $codicestato, $note)


            /* TODO da mandare a richestamodel per esaminare
        //TODO: DA VERIFICARE IN PASE AL PARSER
        $messaggioErrore="OK";
        $codice="000";  //OK
        $avanti=false;
        $transizione="";
        switch($codicestato){

            case '010': $transizione="rifiutata_amm_ABS"; $avanti=true; break;
            case '020': $transizione="rifiutata_tec_ABS"; $avanti=true; break;
            case '030': $transizione="rifiutata_amm_ABS"; $avanti=true; break;
            default : $messaggioErrore="NOK - Errore per codice non corretto"; $codice="050"; $avanti=false; break;

        }

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idpratica);

        if($avanti){
             if($richiesta){
            // Get the factory
            $factory = $this->get('sm.factory');

            // Get the state machine for this object, and graph called "simple"
            $articleSM = $factory->get($richiesta, 'rda');
            //$utente = $this->get('usercheck.notify')->getUtente();
            $iter= new Iter();

//        TODO recupero ruolo utente


            if ($articleSM->can($transizione)) {
                $iter->setDastato($articleSM->getState());
                $articleSM->apply($transizione);
                $iter->setAstato($articleSM->getState());
                $iter->setIdrichiesta($richiesta);
                $iter->setIdutente($utente[0]);
                $iter->setMotivazione($note);
                $iter->setDataora($data);
                $em->persist($iter);
            }

            $em->flush();

        } else{
            $messaggioErrore ="NOK - Pratica non trovata";
            $codice="050";
        }
        }

            */
         //   return array(
         //       'CoriceRisposta' => "no",
         //       'codiceErrore' => 000,
         //       'DescrizioneErrore' => "nono",
         //       'data' =>  $dataRispostaServer
         //   );

            return array(
                'CoriceRisposta' => $risposta->getCodiceRisposta(),
                'codiceErrore' => $risposta->getCodiceErrore(),
                'DescrizioneErrore' => $risposta->getDescrizioneErrore(),
                'data' =>  $risposta->getDataRisposta()
            );
//
        }
    }

}
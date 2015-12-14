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


class DemoController extends Controller
{
    /**
     * @Soap\Method("hello")
     * @Soap\Param("name", phpType = "string")
     * @Soap\Result(phpType = "string")
     */
    public function helloAction($name)
    {
        return sprintf('CIAO %s!', $name);
    }

    /**
     * @Soap\Method("notify")
     * @Soap\Param("messaggio", phpType = "string")
     * @Soap\Param("idpratica", phpType = "int")
     * @Soap\Param("data", phpType = "dateTime")
     * @Soap\Param("codicemessaggio", phpType = "int")
     * @Soap\Result(phpType = "BeSimple\SoapCommon\Type\KeyValue\String[]")
     */
    public function notifyAction($messaggio=null, $idpratica, $data, $codicemessaggio)
    {   $em = $this->getDoctrine()->getManager();
        $messaggioErrore="OK";
        $codice="000";  //OK
       // //$richiesta = $em->getRepository('estarRdaBundle:Iter')->findBy(
        //    array('idrichiesta' => $idpratica),
        //    array('id' => 'DESC'));
        //$astato= $richiesta[0]->getAstato();

        $utente = $em->getRepository('estarRdaBundle:Utente')->findBy(
            array('nomecognome' => "Sistematica"));
        //$idutente= $utente[0]->getId();
        $avanti=false;
        $transizione="";
        switch($codicemessaggio){

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
                $iter->setMotivazione($messaggio);
                $iter->setDataora($data);
                $em->persist($iter);
            }

            $em->flush();

        } else{
            $messaggioErrore ="NOK - Pratica non trovata";
            $codice="050";
        }
        }


       // $iter -> setDastato($astato);
       // $iter -> setAstato((string)$codicemessaggio);
       // $iter -> setIdutente($utente[0]);
       // $iter -> setIdrichiesta($idpratica);
       // $iter -> setMotivazione($messaggio);
       // $iter -> setDataora($data);
       // $em->persist($iter);

        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
       $data=  $dateTime->format(\DateTime::W3C);

        return array(
            'risposta' => $messaggioErrore,
            'codice' => $codice,
            'data' =>  $data
        );
    }

    /**
     * @Soap\Method("goodbye")
     * @Soap\Param("name", phpType = "string")
     * @Soap\Result(phpType = "string")
     */
    public function goodbyeAction($name)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Goodbye %s!', $name));
    }
}
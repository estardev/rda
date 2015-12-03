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
     * @Soap\Result(phpType = "string")
     */
    public function notifyAction($messaggio=null, $idpratica, $data, $codicemessaggio)
    {   $em = $this->getDoctrine()->getManager();
        $richiesta = $em->getRepository('estarRdaBundle:Iter')->findBy(
            array('idrichiesta' => $idpratica),
            array('id' => 'DESC'));
        $astato= $richiesta[0]->getAstato();

        $utente = $em->getRepository('estarRdaBundle:Utente')->findBy(
            array('nomecognome' => "Sistematica"));
        $idutente= $utente[0]->getId();


        $iter= new Iter();
        $iter -> setDastato($astato);
        $iter -> setAstato((string)$codicemessaggio);
        $iter -> setIdutente($utente[0]);
        $iter -> setIdrichiesta($idpratica);
        $iter -> setMotivazione($messaggio);
        $iter -> setDataora($data);
        $em->persist($iter);



        return sprintf('CIAO %s!', $astato);
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
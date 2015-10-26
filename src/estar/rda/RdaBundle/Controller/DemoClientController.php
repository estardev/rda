<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeSimple\SoapClient;
use BeSimple\SoapCommon;
use BeSimple\SoapBundle;
use BeSimple\SoapWsdl;

class DemoClientController extends Controller
{
    public function helloAction($name)
    {
        $city="pisa";
        $country="italy";
        // The client service name is `besimple.soap.client.demoapi`:
        // `besimple.soap.client.`: is the base name of your client
        // `demoapi`: is the name specified in your config file converted to lowercase
        $clientbuilder = $this->get('besimple.soap.client.builder.tempo');

        $soapClient= $clientbuilder->build();


        $wsdl= $clientbuilder->getWsdl();
        //var_dump($wsdl);
        $soapClient->SoapClient($wsdl, array('trace' => 1,
            'exception' => 0,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'soap_version' => SOAP_1_1));


        // call `hello` method on WebService with the string parameter `$name`
        //$helloResult = $client->hello($name);

        $inputparam = new \SoapVar('<ns1:GetWeather><ns1:CityName>'.$city.'</ns1:CityName><ns1:CountryName>'.$country.'</ns1:CountryName></ns1:GetWeather>', XSD_ANYXML);

        $helloResult= $soapClient->GetWeather($inputparam);

        $helloResult= $soapClient->__getLastResponse();
        //var_dump($helloResult);
        //exit();
        return $this->render('@estarRda/Testing/index.html.twig', array(
            'hello' => $helloResult,
        ));
    }
}
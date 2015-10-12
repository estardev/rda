<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * SoapEsempio controller.
 *
 */
class SoapEsempioController extends Controller
{

    /**
     *
     */
    public function indexAction($city,$country)
    {
        $wsdl = 'http://www.webservicex.com/globalweather.asmx?WSDL';
        $url = 'http://www.webservicex.com/globalweather.asmx';

        $client = new \SoapClient($wsdl, array('trace' => 1,
            'exception' => 0,
            'location' => $url,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'soap_version' => SOAP_1_1));

        $inputparam = new \SoapVar('<ns1:GetWeather><ns1:CityName>'.$city.'</ns1:CityName><ns1:CountryName>'.$country.'</ns1:CountryName></ns1:GetWeather>', XSD_ANYXML);
        $return = $client->GetWeather($inputparam);

        $myresponse = $client->__getLastResponse();
        //return new Response(
            //'<html><body>Soap Esempio Response: <br>'.$client->__getLastResponse().'</body></html>'
        //);

        //$number = rand(1, $limit);
        return $this->render('estarRdaBundle:SoapEsempio:index.html.twig', array('myresponse' => $myresponse));
    }

}

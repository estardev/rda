<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use BeSimple\SoapCommon\Helper as BeSimpleSoapHelper;
use BeSimple\SoapClient\SoapClient as BeSimpleSoapClient;
use BeSimple\SoapClient;
use BeSimple\SoapCommon;
use BeSimple\SoapBundle;
use BeSimple\SoapWsdl;


class SistematicaClientController extends Controller
{
    /**
     * @param $idPratica
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($idPratica)
    {
        $nome = "richiesta_".time().".zip";
        $clientbuilder = $this->get('besimple.soap.client.builder.sistematica');

        $soapClient= $clientbuilder->build();

        $wsdl= $clientbuilder->getWsdl();
        //var_dump($wsdl);

        $sc = new BeSimpleSoapClient($wsdl, array(
            'attachment_type' => BeSimpleSoapHelper::ATTACHMENTS_TYPE_MTOM,
            'cache_wsdl'      => WSDL_CACHE_NONE,
            'trace' => 1,
            'exception' => true,
            'location' => 'https://democorepaumbria.grupposistematica.it/isharedoc/webservices/webserviceInstance.wsdl'));

        //$b64= new Mime();
        ////$b64->encodeBase64('text/plain');
        //////$b64 = new base64Binary();
        //////$b64->_ = 'This is a test. :)';
        //////$b64->contentType = 'text/plain';
        ////$attachment = new AttachmentRequest();
        ////$attachment->fileName = 'mio.rar';
        ////$attachment->binaryData = $b64;sa
//
        $ss= new SoapCommon\Mime\Part();
        $ss->setHeader("Content-Type","applicatio/xop+xml");
        $ss->setHeader("type","text/xml");
        $ss->setHeader("Content-Transfer-Encoding","base64");

        //$ss->setContent(base64_encode('mio.txt'));

        $b53 = new SoapCommon\Mime\MultiPart();
        $aa= $ss->getMessagePart();
        $b53->getMimeMessage($aa);


       // boundary



        $soapClient->getSoapKernel()->addAttachment($ss);

        var_dump($aa);
        //$cc= new SoapBundle\Soap\SoapHeader('ns1','ins','');
        //$soapClient->__setSoapHeaders($cc);


        $b53->addPart($ss);
        //var_dump($ss);

        $sc->getSoapKernel()->addAttachment($ss);


        ////$ss= new SoapCommon\Mime\MultiPart();
        ////$ss->setHeader("Content-Type","Multipart/Related");
//
        ////$b53->setHeader("Content-ID","the-attachment");
        //$b53->setHeader("Content-Type","Multipart/Related");
        //$b53->setHeader("start-info","text/xml");
        //$b53->setHeader("type","application/xop+xml");
//      //  $b53->setContent('mio.txt');
//
        ////        $cid= new Mime();
        ////$cid->encodeBase64('mio.txt');
        ////$sc->getSoapKernel()->addAttachment($b53);
//
        ////var_dump($b53);
        //print_r($b53);

        // PARAMETRI HEADER
        $headerUsername = "demo";
        $headerPassword = "demo100";

        $guid = trim(com_create_guid(),'{}');
        $guidBase64 = base64_encode($guid);

        date_default_timezone_set('Europe/Rome');
        $dt = Date("Y-m-d H:i:s");
        $dtCreated = date("Y-m-d\TH:i:s.000\Z", strtotime($dt));

        // PARAMETRI BODY
        $partitionId = 5;
        $storyboardCode = "protocollo";
        $messageBoxId = 4;
        $metaViewName = "protocollo";
        $startWorkflow = true;
        $instanceOperation = "protocolla";

        // direzione messaggio
        $direction = "IN"; // messaggio in ingresso
        // ufficio autore
        $contactTypeAut = "O";
        $referenceTypeAut = "OU";
        $referenceCodeAut = "ASL4CDC0009";
        // ufficio destinatario
        $contactTypeDest = "T";
        $referenceTypeDest = "OU";
        $referenceCodeDest = "ASL3B400";
        // mittente
        $contactTypeMitt = "F";
        $referenceTypeMitt = "AB";
        $referenceCodeMitt = "ESTAR";



        // CREAZIONE HEADER
        $CredentialObjectXML  = '
		<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
			<wsse:UsernameToken wsu:Id="UsernameToken-9E95C729FF5F13BA5714443833654194">
				<wsse:Username>'.$headerUsername.'</wsse:Username>
				<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$headerPassword.'</wsse:Password>
				<wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$guidBase64.'</wsse:Nonce>
				<wsu:Created>'.$dtCreated.'</wsu:Created>
			 </wsse:UsernameToken>
		</wsse:Security>';
        $CredentialObject  = new \SoapVar($CredentialObjectXML,XSD_ANYXML);
        $header = new \SoapHeader('http://schemas.xmlsoap.org/soap/envelope/','null',$CredentialObject);
        $soapClient->__setSoapHeaders($header);

        // CREAZIONE BODY
        $inputparam = new \SoapVar('
		<ns1:InstanceMessageCreateRequest>
			<partitionId>'.$partitionId.'</partitionId>
			<storyboardCode>'.$storyboardCode.'</storyboardCode>
			<messageBoxId>'.$messageBoxId.'</messageBoxId>
			<!--Optional:-->
			<metaViewName>'.$metaViewName.'</metaViewName>
			<direction>'.$direction.'</direction>
			<!--Optional:-->
			<contacts>
			<!--Zero or more repetitions:-->
			<contact>
			   <type>'.$contactTypeAut.'</type>
			   <referenceType>'.$referenceTypeAut.'</referenceType>
			   <!--You have a CHOICE of the next 2 items at this level-->
			   <referenceCode>'.$referenceCodeAut.'</referenceCode>
			</contact>
			<contact>
			   <type>'.$contactTypeDest.'</type>
			   <referenceType>'.$referenceTypeDest.'</referenceType>
			   <!--You have a CHOICE of the next 2 items at this level-->
			   <referenceCode>'.$referenceCodeDest.'</referenceCode>
			</contact>
			<contact>
			   <type>'.$contactTypeMitt.'</type>
			   <referenceType>'.$referenceTypeMitt.'</referenceType>
			   <!--You have a CHOICE of the next 2 items at this level-->
			   <referenceCode>'.$referenceCodeMitt.'</referenceCode>
			</contact>
			</contacts>
			<!--Optional:-->
			<subject>richiesta</subject>
			<!--Optional:-->
			<tags>'.$idPratica.'</tags>
			<!--Optional:-->
			<variables>
				 <variable>
						<key>transition</key>
						<type>string</type>
						<valueString>Protocolla</valueString>
				 </variable>
			</variables>
			  <!--Optional:-->
         <attachments>
            <!--Zero or more repetitions:-->
            <attachment>
               <fileset>isharedocMailAttach</fileset>
               <filename>'.$nome.'</filename>
               <!--Optional:-->
               <contentType>mimeType</contentType>
               <data>cid:1157971487190</data>
            </attachment>
         </attachments>
         <!--Optional:-->
        <!--Optional:-->
			<startWorkflow>'.$startWorkflow.'</startWorkflow>
			<!--Optional:-->
			<instanceOperation>'.$instanceOperation.'</instanceOperation>
		</ns1:InstanceMessageCreateRequest>', XSD_ANYXML);

        // CHIAMATA RICHIESTA
        try {
            $return = $soapClient->InstanceMessageCreate($inputparam);
            $sc->getSoapKernel()->filterRequest($return);
        }
        catch (\SoapFault $exception) {
            echo $exception->getMessage() . "<br>";
        }



        $myreq= $soapClient->__getLastRequest();
        file_put_contents('ProvaRichiesta.xml', print_r($myreq, true));
        //var_dump($myreq);
        $headermio= $soapClient->__getLastRequestHeaders();
        file_put_contents('Provaheader.xml', print_r($headermio, true));
        $myrespons= $soapClient->__getLastResponse();
        file_put_contents('ProvaRisposta.xml', print_r($myrespons, true));
        //var_dump($myrespons);

        return $this->redirect($this->generateUrl("richiesta"));
        //return $this->render('@estarRda/Testing/index.html.twig', array(
        //    'hello' => $myrespons,
        //));
    }
}

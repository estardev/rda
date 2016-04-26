<?php
/**
 * Created by PhpStorm.
 * User: MrZANO
 * Date: 11/03/2016
 * Time: 11.58
 */

namespace estar\rda\RdaBundle\Model;
use nusoap_client;


class ClientSistematica
{
    /**
     * @var string
     */
    private $idPratica;

    /**
     * @var string
     */
    private $oggettomessaggio;

    /**
     * @return string
     */
    public function getOggettomessaggio()
    {
        return $this->oggettomessaggio;
    }

    /**
     * @param string $oggettomessaggio
     */
    public function setOggettomessaggio($oggettomessaggio)
    {
        $this->oggettomessaggio = $oggettomessaggio;
    }

    /**
     * @var string
     */
    private $numeroProtocollo; // 0000088 in caso di aggiornamento

    /**
     * @var string
     */
    private $idgestav;

    /**
     * @var string
     */
    private $idgara;

    /**
     * @return string
     */
    public function getIdgara()
    {
        return $this->idgara;
    }

    /**
     * @param string $idgara
     */
    public function setIdgara($idgara)
    {
        $this->idgara = $idgara;
    }

    /**
     * @return string
     */
    public function getIdgestav()
    {
        return $this->idgestav;
    }

    /**
     * @param string $idgestav
     */
    public function setIdgestav($idgestav)
    {
        $this->idgestav = $idgestav;
    } // 0000088 in caso di aggiornamento

    /**
     * @return string
     */
    public function getNumeroProtocollo()
    {
        return $this->numeroProtocollo;
    }

    /**
     * @param string $numeroProtocollo
     */
    public function setNumeroProtocollo($numeroProtocollo)
    {
        $this->numeroProtocollo = $numeroProtocollo;
    }

    /**
     * @return string
     */
    public function getIdPratica()
    {
        return $this->idPratica;
    }

    /**
     * @param string $idPratica
     */
    public function setIdPratica($idPratica)
    {
        $this->idPratica = $idPratica;
    }

    /**
     * @return string
     */
    public function getTipologia()
    {
        return $this->tipologia;
    }

    /**
     * @param string $tipologia
     */
    public function setTipologia($tipologia)
    {
        $this->tipologia = $tipologia;
    }

    /**
     * @return string
     */
    public function getStrutturarichiedente()
    {
        return $this->strutturarichiedente;
    }

    /**
     * @param string $strutturarichiedente
     */
    public function setStrutturarichiedente($strutturarichiedente)
    {
        $this->strutturarichiedente = $strutturarichiedente;
    }

    /**
     * @return string
     */
    public function getCategoriamerceologica()
    {
        return $this->categoriamerceologica;
    }

    /**
     * @param string $categoriamerceologica
     */
    public function setCategoriamerceologica($categoriamerceologica)
    {
        $this->categoriamerceologica = $categoriamerceologica;
    }

    /**
     * @return string
     */
    public function getNomefile()
    {
        return $this->nomefile;
    }

    /**
     * @param string $nomefile
     */
    public function setNomefile($nomefile)
    {
        $this->nomefile = $nomefile;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @var string
     */
    private $tipologia;

    /**
     * @var string
     */
    private $priorita;

    /**
     * @return string
     */
    public function getPriorita()
    {
        return $this->priorita;
    }

    /**
     * @param string $priorita
     */
    public function setPriorita($priorita)
    {
        $this->priorita = $priorita;
    }

    /**
     * @var string
     */
    private $gruppogestav;

    /**
     * @return string
     */
    public function getGruppogestav()
    {
        return $this->gruppogestav;
    }

    /**
     * @param string $gruppogestav
     */
    public function setGruppogestav($gruppogestav)
    {
        $this->gruppogestav = $gruppogestav;
    }

    /**
     * @var string
     */
    private $strutturarichiedente;

    /**
     * @var string
     */
    private $categoriamerceologica;

    /**
     * @var string
     */
    private $nomefile;

    /**
     * @var string
     */
    private $path;

    /** costruttore di default. Mi serve un entity manager e l'utente corrente */
    public function __construct($em, $user)
    {
        $this->em = $em;
        $this->user = $user;
    }

    public function RequestWebServer()
    {
        //$partitionPuId = "109";                        //FISSO
        //$messageBoxCode = "richiesta";            //FISSO
        //$startWorkflow = "true";
        //$searchtype1="EXTID";
        //$searchmode1="NOTFOUNDDEF";
        // $searchtype2="CODE";

        $searchvalue1="vuoto";



        $strutturarichiedente= $this->getStrutturarichiedente(); //"USL Sud Est Toscana"; //passare come parametro da RDA la struttura dell'utente che invia la richiesta
        //$sottoCategoriaMerceologica= "valore due";
        $categoriamerceologica = $this->getCategoriamerceologica(); //"Farmaci (importo Gara > 40.000 EU)";
        $tipologia= $this->getTipologia(); //Nuova, Annulamento, Documentazione aggiuntiva
        $idPratica=$this->getIdPratica(); // passato come parametro

        // estrazione parametri per la richiesta
        $parametri = $this->em->getRepository('estarRdaBundle:Sistematica')->find(1);
        $headerusername = $parametri->getUser();
        $headerpassword = $parametri->getPsw();
        $wsdl = $parametri->getWsdl();
        $storyboardcode = $parametri->getStoryboardcode();
        $setmetaviewname = $parametri->getSetmetaviewname();
        $setdirection = $parametri->getSetdirection();
        $contactsettype1 = $parametri->getContactSettype1();
        $contactreferencetype1 = $parametri->getContactReferencetype1();
        $partitionPuId  = $parametri->getContactReferencecode1();
        $contactsettype2 = $parametri->getContactSettype2();
        $contactreferencetype2 = $parametri->getContactReferencetype2();
        $messageBoxCode = $parametri->getContactReferencecode2();
        $startWorkflow = $parametri->getContactSettype3();
        $searchtype1 = $parametri->getContactReferencetype3();
        $searchmode1 = $parametri->getContactReferencecode3();
        $variableSetkey1 = $parametri->getVariableSetkey1();
        $variableSettype1 = $parametri->getVariableSettype1();
        $variableSetvaluestring1 = $parametri->getVariableSetvaluestring1();
        $attachmentSetfileset1 = $parametri->getAttachmentSetfileset1();
        $attachmentSetcontenttype1 = $parametri->getAttachmentSetcontenttype1();
        $searchtype2 = $parametri->getRequestSetinstanceoperation();

        $contact='<contact>
               <type>'.$contactsettype1.'</type>
               <referenceType>'.$contactreferencetype1.'</referenceType>
               <searchType>'.$searchtype1.'</searchType>
              	<searchMode>'.$searchmode1.'</searchMode>
              	<searchValue>'.$searchvalue1.'</searchValue>
              <description>'.$strutturarichiedente.'</description>
            </contact>
             <contact>
               <type>'.$contactsettype2.'</type>
               <referenceType>'.$contactreferencetype2.'</referenceType>
               <searchType>'.$searchtype2.'</searchType>
               <searchValue>'.trim($this->getGruppogestav()).'</searchValue>
             </contact>';


        switch($this->getTipologia()){
            case "Annullamento":
                $references='<references>
            <reference>
               <id>'.$this->getIdgestav().'</id>
            </reference>
                </references>';
                break;

            case "Nuova":
                $references='<references/>
';
                break;

            case "Documentazione aggiuntiva":
                $references='<references>
            <reference>
               <id>'.$this->getIdgestav().'</id>
            </reference>
                </references>';
                break;

            case "Documentazione richiesta da RUP":
                $references='<references>
            <reference>
               <id>'.$this->getIdgestav().'</id>
            </reference>
            <reference>
               <id>'.$this->getIdgara().'</id>
            </reference>
                </references>';
                break;
        }



    //    $references='<references>
    //        <reference>
    //           <id>236439</id>
    //        </reference>
    //         <reference>
    //           <appIdentifier>0000088</appIdentifier>
    //           <appIdentifierDate>2016-03-01T10:44:49.112+01:00</appIdentifierDate>
    //        </reference>
    //     </references>';





        if($this->tipologia=="Annullamento"){
            $attachmentfile="<attachments/>";
        } else {
            $attachmentfile='<attachments>
             <attachment>
               <fileset>'.$attachmentSetfileset1.'</fileset>
               <filename>'.$this->getNomefile().'</filename>
              <contentType>'.$attachmentSetcontenttype1.'</contentType>
              <data>'.base64_encode(file_get_contents($this->getPath())).'</data>
            </attachment>
         </attachments>';
        }





        $guid = $this->getGUID();
        $guidBase64 = base64_encode($guid);

        date_default_timezone_set('Europe/Rome');
        $dt = Date("Y-m-d H:i:s");
        $dtCreated = date("Y-m-d\TH:i:s.000\Z", strtotime($dt));

        $number=time().rand();
        //$dateTime = date('Y-m-d').'T'.date('H:i:s');
        $client = new \nusoap_client($wsdl);



        $client->endpoint = 'http://devbss3.grupposistematica.it/isharedoc/webservices/instanceService3';
        $client->operation = "InstanceMessageCreate";
        $client->soap_defencoding = 'utf-8';
        $client->username='$headerusername';
        $client->password='$headerpassword';
        $client->useHTTPPersistentConnection(); // Uses http 1.1 instead of 1.0
        $soapaction = "http://devbss3.grupposistematica.it/isharedoc/webservices/instanceService3/";

        $request_xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ins="http://www.isharedoc.it/schemas/instance">
   <soapenv:Header><wsse:Security
   soapenv:mustUnderstand="1"
   xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
   xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
   <wsse:UsernameToken wsu:Id="UsernameToken-1B3481B8C0988EE07114573512720675">
   <wsse:Username>'.$headerusername.'</wsse:Username>
   <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordText">'.$headerpassword.'</wsse:Password>
   <wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$guidBase64.'</wsse:Nonce>
   <wsu:Created>'.$dtCreated.'</wsu:Created></wsse:UsernameToken></wsse:Security>
   </soapenv:Header>
      <soapenv:Body>
      <ins:InstanceMessageCreateRequest>
         <partitionPuid>'.$partitionPuId.'</partitionPuid>
         <messageBoxCode>'.$messageBoxCode.'</messageBoxCode>
         <storyboardCode>'.$storyboardcode.'</storyboardCode>
         <metaViewName>'.$setmetaviewname.'</metaViewName>
         <direction>'.$setdirection.'</direction>
         <contacts>
            '.$contact.'
         </contacts>
         <subject>'.$this->getOggettomessaggio().'</subject>
         <variables>
            <variable>
                <key>tipoRichiesta</key>
               	<type>'.$variableSettype1.'</type>
                <valueString>'.$tipologia.'</valueString>
			</variable>
			<variable>
	            <key>idPratica</key>
               	<type>'.$variableSettype1.'</type>
                <valueString>'.$idPratica.'</valueString>
			</variable>
			<variable>
	            <key>'.$variableSetkey1.'</key>
               	<type>'.$variableSettype1.'</type>
                <valueString>'.$variableSetvaluestring1.'</valueString>
			</variable>
			<variable>
	            <key>categoriaMerceologica</key>
               	<type>'.$variableSettype1.'</type>
                <valueString>'.$categoriamerceologica.'</valueString>
			</variable>
			<variable>
	            <key>prioritaPortale</key>
               	<type>string</type>
                <valueString>'.$this->getPriorita().'</valueString>
			</variable>
         </variables>
        '.$references.$attachmentfile.'
         <startWorkflow>'.$startWorkflow.'</startWorkflow>

      </ins:InstanceMessageCreateRequest>
   </soapenv:Body>
</soapenv:Envelope>'; //appIdentifier '.$this->getNumeroProtocollo().'


        $response = $client->send($request_xml, $soapaction, '');
        $res=$client->responseData;
        file_put_contents("REQUESTserver/".$number."_richiestaclient.xml",$client->request );
        file_put_contents("REQUESTserver/".$number."_rispostastaclient.xml",$client->response );
        if($rispostaSistematica= file_get_contents("REQUESTserver/".$number."_rispostastaclient.xml")){
            if(!strstr($rispostaSistematica,"<SOAP-ENV:Fault>")){
                $responseXML=strstr($res,"<SOAP-ENV:Body>");
                $ultimaposizione= strpos($responseXML,"------=_Part");
                $responseXML=substr($responseXML,0,$ultimaposizione-1);
                $responseXML=str_replace('<SOAP-ENV:Body>','',$responseXML);
                $responseXML=str_replace('</SOAP-ENV:Body></SOAP-ENV:Envelope>','',$responseXML);

                $xml=simplexml_load_string($responseXML);
                if($xml->id or $xml->identifier or $xml->identifierDate or $xml->viewUrl){
                    $idChiaveUnivoca= $xml->id;
                    $numProt = $xml->identifier;
                    $identifierDate=$xml->identifierDate;
                    $viewUrl=$xml->viewUrl;
                }
                else{
                    return array('esito'=>false, 'codice'=> 1 ); //trovato un fault
                }


                return array('esito'=>true ,'codice'=> 0 ,'protocollo'=> $numProt, 'dataprotocollo'=> $identifierDate, 'chiavesistematica'=>$idChiaveUnivoca, 'urlprotocollo'=>$viewUrl);
            }
            else{
                return array('esito'=>false, 'codice'=> 1 ); //trovato un fault
            }
        }
        else return array('esito'=>false, 'codice'=> 2); //non trovato il file dentro REQUESTserver/".$number."_rispostastaclient.xml


    }

    function getGUID()
    {
        {
            if (function_exists('com_create_guid') === true) {
                return trim(com_create_guid(), '{}');
            }

            return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        }
    }
}
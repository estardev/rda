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
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Form\FormTemplateType;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

use BeSimple\SoapClient\Tests\AxisInterop\Fixtures\AttachmentRequest;
use BeSimple\SoapClient\Tests\AxisInterop\Fixtures\AttachmentType;
use BeSimple\SoapClient\Tests\AxisInterop\Fixtures\base64Binary;


class SistematicaClientController extends Controller
{
    // cancellazione di cartella non vuota
    public static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function getChoicesOptions($string)
    {
        $options = explode('||', $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode('|', $option);
            if (count($subOption) > 1) {
                $returnOptions[$subOption[0]] = $subOption[1];
            } else {
                $returnOptions[$subOption[0]] = $subOption[0];
            }
        }


        return $returnOptions;
    }

    function selectedOption($options, $key)
    {
        return $options[$key];
    }

    /**
     * @param $idRichiesta
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($idCategoria, $idRichiesta)
    {
        // generazione file pdf e zip
        $directory_sender = "sender";
        $max = 0;
        $results = scandir($directory_sender);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;

            if (is_dir($directory_sender . '/' . $result)) {
                $primo = explode("_", $result);
                $primo = $primo[0];
                if ($max <= $primo)
                    $max = $primo;
            }
        }
        $num = $max + 1;
        $path = $num . "_Richiesta_" . $idRichiesta . "_categoria_" . $idCategoria;
        if (!is_dir($directory_sender . "/" . $path)) mkdir($directory_sender . "/" . $path, 0777);

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT IDENTITY (c.iddocumento ) as iddocu
                                   FROM estarRdaBundle:Richiestadocumento c
                                   WHERE c.idrichiesta = :idRichiesta')->setparameter('idRichiesta', $idRichiesta);
        $arrayiddocumento = $query->getResult();

        foreach ($arrayiddocumento as $idDoc) {
            $idD = $idDoc;
            $idDoc= $idD['iddocu'];
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT c.id as idcampo,c.nome,c.descrizione,c.fieldset,c.tipo,vc.id,vc.valore
                                    FROM estarRdaBundle:Campodocumento c
                                    LEFT JOIN estarRdaBundle:Valorizzazionecampodocumento vc
                                    WITH c.id = vc.idcampodocumento
                                    LEFT JOIN estarRdaBundle:Richiestadocumento r
                                    WITH r.id = vc.idrichiestadocumento
                                    WHERE r.idrichiesta = :idRichiesta
                                    AND r.iddocumento = :idDocumento
                                    ')->setparameters(array('idRichiesta' => $idRichiesta, 'idDocumento' => $idDoc));
            $campiValorizzati = $query->getResult();
            $formbuilder = $this->createFormBuilder();
            $documento = $em->getRepository('estarRdaBundle:Documento')->find($idDoc);
            $nomedescrizione = $documento->getDescrizione();
            $formbuilder->add("nome", "text", array(
                'label' => "nome",
                'data' => $documento->getNome(),
                'read_only' => true
            ));
            $formbuilder->add("descrizione", "textarea", array(
                'label' => "descrizione",
                'data' => $documento->getDescrizione(),
                'read_only' => true
            ));
            foreach ($campiValorizzati as $campovalorizzato) {
                $campo = $campovalorizzato;

                $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campodocumento');
                $campoCheck = $repository->find($campo['idcampo']);

                if ($campo['tipo'] == 'choice') {
                    $descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                    $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                        'label' => $campo['descrizione'],
                        'data' => $descrizioneValore,
                        'read_only' => true
                    ));
                } else {

                    $formbuilder->add($campo['nome'] . '-' . $campo['id'], $campo['tipo'], array(
                        'label' => $campo['descrizione'],
                        'data' => $campo['valore'],
                        'read_only' => true
                    ));
                }
            }
            $form = $formbuilder->getForm();


            $html = $this->renderView('::printbase.html.twig', array(
                'form' => $form->createView()
            ));
            $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . 'Documento_' . $idDoc . '_' . $nomedescrizione . "_Richiesta" . $idRichiesta . ".pdf");
        }

        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);
        $query = $em->createQuery('SELECT c.id as idcampo,c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,vc.id,vc.valore
                                    FROM estarRdaBundle:Campo c LEFT JOIN estarRdaBundle:Valorizzazionecamporichiesta vc
                                    WITH c.id = vc.idcampo
                                    AND vc.idrichiesta = :idRichiesta')
            ->setparameter('idRichiesta', $idRichiesta);
        $campiValorizzati = $query->getResult();

        $formbuilder = $this->createFormBuilder();
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $formbuilder->add("titolo", "text", array(
            'label' => "titolo",
            'data' => $richiesta->getTitolo(),
            'read_only' => true
        ));
        $formbuilder->add("descrizione", "textarea", array(
            'label' => "descrizione",
            'data' => $richiesta->getDescrizione(),
            'read_only' => true
        ));
        foreach ($campiValorizzati as $campovalorizzato) {
            $campo = $campovalorizzato;

            $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campo');
            $campoCheck = $repository->find($campo['idcampo']);
            if (!($diritti->campoVisualizzabile($diritti, $campoCheck))) continue;

            if ($campo['tipo'] == 'choice') {
                $descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                    'label' => $campo['descrizione'],
                    'data' => $descrizioneValore,
                    'read_only' => true
                ));
            } else {

                $formbuilder->add($campo['nome'] . '-' . $campo['id'], $campo['tipo'], array(
                    'label' => $campo['descrizione'],
                    'data' => $campo['valore'],
                    'read_only' => true
                ));
            }
        }
        $form = $formbuilder->getForm();

        $html = $this->renderView('::printbase.html.twig', array(
//            'entity' => $entity,
            'form' => $form->createView()
        ));


        /*if(file_exists($path."/Richiesta".$idRichiesta.".pdf")){
            unlink($path."/Richiesta".$idRichiesta.".pdf");
        }
        if(file_exists($path.'/'.$path.'.zip')){
            unlink($path.'/'.$path.'.zip');
        }*/

        //$response = new Response(
        $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . $num . "_Richiesta" . $idRichiesta . ".pdf");
        //);

        $zip = \Comodojo\Zip\Zip::create($directory_sender . '/' . $path . '/' . $path . '.zip');

        $pathdocumenti='documenti/Richiesta_'.$idRichiesta;
        //TODO prendere tutti i file e documenti
        $zip->add($directory_sender . "/" . $path, true)->add($pathdocumenti, true);
        $zip->close();

        // estrazione parametri per la richiesta
        $em = $this->getDoctrine()->getManager();
        $parametri = $em->getRepository('estarRdaBundle:Sistematica')->find(1);
        $user = $parametri->getUser();
        $psw = $parametri->getPsw();
        $wsdl = $parametri->getWsdl();
        $storyboardcode = $parametri->getStoryboardcode();
        $setmetaviewname = $parametri->getSetmetaviewname();
        $setdirection = $parametri->getSetdirection();
        $contactSettype1 = $parametri->getContactSettype1();
        $contactReferencetype1 = $parametri->getContactReferencetype1();
        $contactReferencecode1 = $parametri->getContactReferencecode1();
        $contactSettype2 = $parametri->getContactSettype2();
        $contactReferencetype2 = $parametri->getContactReferencetype2();
        $contactReferencecode2 = $parametri->getContactReferencecode2();
        $contactSettype3 = $parametri->getContactSettype3();
        $contactReferencetype3 = $parametri->getContactReferencetype3();
        $contactReferencecode3 = $parametri->getContactReferencecode3();
        $variableSetkey1 = $parametri->getVariableSetkey1();
        $variableSettype1 = $parametri->getVariableSettype1();
        $variableSetvaluestring1 = $parametri->getVariableSetvaluestring1();
        $attachmentSetfileset1 = $parametri->getAttachmentSetfileset1();
        $attachmentSetcontenttype1 = $parametri->getAttachmentSetcontenttype1();
        $requestSetinstanceoperation = $parametri->getRequestSetinstanceoperation();

        // generazione file .java
        $stringa = "
import java.io.*;
import java.math.BigInteger;
import java.text.SimpleDateFormat;
import java.util.*;

import javax.activation.DataHandler;
import javax.activation.FileDataSource;
import javax.xml.soap.MessageFactory;
import javax.xml.soap.SOAPException;
import javax.xml.soap.SOAPMessage;
import javax.xml.ws.BindingProvider;
import javax.xml.ws.handler.Handler;
import javax.xml.ws.handler.HandlerResolver;
import javax.xml.ws.handler.MessageContext;
import javax.xml.ws.handler.PortInfo;
import javax.xml.ws.soap.MTOMFeature;

import it.isharedoc.schemas.instance.InstanceMessageCreateRequest;
import it.isharedoc.schemas.instance.InstanceMessageCreateRequest.*;
import it.isharedoc.schemas.instance.InstanceMessageCreateRequest.Attachments.Attachment;
import it.isharedoc.schemas.instance.InstanceMessageCreateRequest.Contacts.Contact;
import it.isharedoc.schemas.instance.InstanceMessageCreateRequest.Variables.Variable;
import it.isharedoc.schemas.instance.InstanceMessageCreateResponse;
import it.isharedoc.schemas.instance.InstancePort;
import it.isharedoc.schemas.instance.InstancePortService;
import it.isharedoc.schemas.instance.ObjectFactory;

public class TestClient {

	public static void main(String[] args) throws SOAPException {
		InstancePortService service = new InstancePortService();

		service.setHandlerResolver( new HandlerResolver() {

			@Override
			public List<Handler> getHandlerChain(PortInfo portInfo) {
				List<Handler> handlerList = new ArrayList<Handler>();
                handlerList.add(new WSSUsernameTokenSecurityHandler(\"" . $user . "\", \"" . $psw . "\"));
                return handlerList;
			}
		});

		InstancePort port = service.getInstancePortSoap11( new MTOMFeature(10240));
		Map<String, Object> ctxt = ((BindingProvider)port).getRequestContext();
		ctxt.put(BindingProvider.ENDPOINT_ADDRESS_PROPERTY, \"" . $wsdl . "\");

		String fileName = \"" . $path . ".zip\";
		String filePath = \"../../" . $directory_sender . "/" . $path . "/\" + fileName;

		InstanceMessageCreateRequest request = prepareRequestObject(filePath);

		InstanceMessageCreateResponse response = port.instanceMessageCreate(request);
		System.out.println( response );
		BufferedWriter output = null;
		try {
            File file = new File(\"" . $path . "_protocollo.txt\");
			output = new BufferedWriter(new FileWriter(file));
			output.write(response.getIdentifier().getValue());
		} catch ( IOException e ) {
        e.printStackTrace();
    } finally {
        try {
            if ( output !=  null ) output.close();
        } catch ( Exception ex ) {

        }

		}
	}

private static InstanceMessageCreateRequest prepareRequestObject(String filePath) {
SimpleDateFormat sdf = new SimpleDateFormat( \"dd/MM/yyyy HH:mm:ss.SSS\");
ObjectFactory factory = new ObjectFactory();

InstanceMessageCreateRequest request = new InstanceMessageCreateRequest();
request.setPartitionId( BigInteger.valueOf(5));
request.setStoryboardCode( \"" . $storyboardcode . "\" );
request.setMessageBoxId( BigInteger.valueOf(4));
request.setMetaViewName( factory.createInstanceMessageCreateRequestMetaViewName(\"" . $setmetaviewname . "\"));
request.setDirection(\"" . $setdirection . "\");

Contacts contacts = factory.createInstanceMessageCreateRequestContacts();
Contact contact = factory.createInstanceMessageCreateRequestContactsContact();
contact.setType(\"" . $contactSettype1 . "\");
contact.setReferenceType(\"" . $contactReferencetype1 . "\");
contact.setReferenceCode(\"" . $contactReferencecode1 . "\");
contacts.getContact().add(contact);

contact = factory.createInstanceMessageCreateRequestContactsContact();
contact.setType(\"" . $contactSettype2 . "\");
contact.setReferenceType(\"" . $contactReferencetype2 . "\");
contact.setReferenceCode(\"" . $contactReferencecode2 . "\");
contacts.getContact().add(contact);

contact = factory.createInstanceMessageCreateRequestContactsContact();
contact.setType(\"" . $contactSettype3 . "\");
contact.setReferenceType(\"" . $contactReferencetype3 . "\");
contact.setReferenceCode(\"" . $contactReferencecode3 . "\");
contacts.getContact().add(contact);

request.setContacts( factory.createInstanceMessageCreateRequestContacts(contacts));

request.setSubject( factory.createInstanceMessageCreateRequestSubject(\"Richiesta del \" + sdf.format(new Date())));

request.setTags( factory.createInstanceMessageCreateRequestTags( \"" . $idRichiesta . "\" ));

Variables variables = factory.createInstanceMessageCreateRequestVariables();
Variable variable = factory.createInstanceMessageCreateRequestVariablesVariable();
variable.setKey( \"" . $variableSetkey1 . "\" );
variable.setType( \"" . $variableSettype1 . "\" );
variable.setValueString( factory.createInstanceMessageCreateRequestVariablesVariableValueString( \"" . $variableSetvaluestring1 . "\" ));
variables.getVariable().add(variable);

request.setVariables( factory.createInstanceMessageCreateRequestVariables(variables) );

File f = new File( filePath );

Attachments attachments = factory.createInstanceMessageCreateRequestAttachments();
Attachment attachment = factory.createInstanceMessageCreateRequestAttachmentsAttachment();
attachment.setFileset( \"" . $attachmentSetfileset1 . "\" );
attachment.setFilename( f.getName() );
attachment.setContentType( factory.createInstanceMessageCreateRequestAttachmentsAttachmentContentType( \"" . $attachmentSetcontenttype1 . "\" ));

FileDataSource fds = new FileDataSource( f );
DataHandler handler = new DataHandler( fds );

attachment.setData( handler );

attachments.getAttachment().add(attachment);

request.setAttachments( factory.createInstanceMessageCreateRequestAttachments(attachments));

request.setStartWorkflow( factory.createInstanceMessageCreateRequestStartWorkflow(true) );
request.setInstanceOperation( factory.createInstanceMessageCreateRequestInstanceOperation( \"" . $requestSetinstanceoperation . "\" ));

return request;
}

}

";
        file_put_contents("client/src/TestClient.java", $stringa, FILE_USE_INCLUDE_PATH);

        // generazione file batch
        $righe_batch = "@echo off \ncd client\\src\\ \n";
        $righe_batch .= "javac TestClient.java \n";
        $righe_batch .= "java TestClient \n";
        $righe_batch .= "cd ..\\..\\ \n";
        $righe_batch .= "pause";
        $batfile = $path . "_esec.bat";

        file_put_contents($batfile, $righe_batch);

        // esecuzione file batch
        // abilitare su php.ini di apache (wamp) safe_mode_exec_dir=off
        exec($path . "_esec.bat", $output, $return);

        // estrazione del numero di protocollo dalla risposta
        $numProt = file_get_contents("/client/src/" . $path . "_protocollo.txt", FILE_USE_INCLUDE_PATH);

        // scrittura del numero di protocollo sulla richiesta
        $em = $this->getDoctrine()->getManager();
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $richiesta->setNumeroprotocollo($numProt);
        $em->persist($richiesta);
        $em->flush();

        $richiestadocumento = $em->getRepository('estarRdaBundle:Richiestadocumento')->findOneBy(
        array('idrichiesta' => $idRichiesta)
        );
        if(!empty($richiestadocumento)){
            $richiestadocumento->setNumeroprotocollo($numProt);
            $em->persist($richiestadocumento);
            $em->flush();
        }

        // cancellazione file
        // da decommentare nel caso non volessimo più fare storage delle richieste zippate e inviate
        //$this->delTree($path);
        unlink($batfile);
        unlink("client/src/" . $path . "_protocollo.txt");

        return $this->redirect($this->generateUrl("richiesta"));
    }

}
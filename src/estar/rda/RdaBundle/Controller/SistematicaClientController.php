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

    public function num(){
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
        return $num = $max + 1;
    }

    public function generateZip($idCategoria, $idRichiesta)
    {
        // generazione file pdf e zip
        $directory_sender = "sender";
        $num=$this->num();
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


        $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . $num . "_Richiesta" . $idRichiesta . ".pdf");
           $zip = \Comodojo\Zip\Zip::create($directory_sender . '/' . $path . '/' . $path . '.zip');

        $pathdocumenti='documenti/Richiesta_'.$idRichiesta;
        $documenti=$em->getRepository('estarRdaBundle:Richiestadocumento')->findBy(array('idrichiesta' => $idRichiesta));
        foreach($documenti as $documentidazippare) {
            if (is_null($documentidazippare->getNumeroprotocollo()))
                $zip->setPath($pathdocumenti)->add($documentidazippare->getFilepath());
        }

        $documentiliberi=$em->getRepository('estarRdaBundle:Richiestadocumentolibero')->findBy(array('idrichiesta' => $idRichiesta));
        foreach($documentiliberi as $documentiliberidazippare) {
            if (is_null($documentiliberidazippare->getNumeroprotocollo()))
                $zip->setPath($pathdocumenti)->add($documentiliberidazippare->getFilepath());
        }

        //TODO prendere tutti i file e documenti
        $zip->add($directory_sender . "/" . $path, true); //->add($pathdocumenti, true);
        $zip->close();

       return array('esito'=>true, 'progressivo'=>$num, 'path'=>$path );
           //true;
    }

    /**
     * @param string $idRichiesta
     * @param string $idCategoria
     * @param string $tipologia
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($idCategoria, $idRichiesta, $tipologia){

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $gruppogestav = $categoria->getGruppogestav();
        $categoriamerciologica= $categoria->getNome();

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $azienda=$richiesta->getIdazienda()->getNome();


        switch($tipologia) {

            case "Annulamento":
                $pathfile = "";
                $nomefile = "";
                $protocollo = $richiesta->getNumeroprotocollo();
                break;

            case "Nuova":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta);
                if ($ritorno['esito']) {
                    $protocollo = "";
                    $pathfile="sender/".$ritorno['path']."/".$ritorno['path'].".zip";
                    $nomefile=$ritorno['path'].'.zip';

                }
                break;
            case "Documentazione Aggiuntiva":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta);
                if ($ritorno['esito']) {
                    $protocollo = $richiesta->getNumeroprotocollo();
                    $pathfile="sender/".$ritorno['path']."/".$ritorno['path'].".zip";
                    $nomefile=$ritorno['path'].'.zip';

                }
                break;
        }
                $risposta = $this->get('model.client');
                $risposta->setIdPratica($idRichiesta);
                $risposta->setNomefile($nomefile);
                $risposta->setPath($pathfile);
                $risposta->setTipologia($tipologia);
                $risposta->setCategoriamerceologica($categoriamerciologica);
                $risposta->getGruppogestav($gruppogestav);
                $risposta->setNumeroProtocollo($protocollo);
                $risposta->setStrutturarichiedente($azienda);

                $esito=$risposta->RequestWebServer();


        $numprotocollo=$esito['protocollo'];

        //TODO: aggiungere il protocollo in richiesta solo se tipologia è nuova
       // scrivo il numero di protocollo sulla richiesta
        if($tipologia=="Nuova"){
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $richiesta->setNumeroprotocollo($numprotocollo);
        $em->persist($richiesta);
        }

        //TODO: aggiungere il protocollo in iter, richiestadocumenti e richiestadocumentiliberi se protocollo null

        $documentiliberi=$em->getRepository('estarRdaBundle:Richiestadocumentolibero')->findBy(array('idRichiesta' => $idRichiesta));
        foreach($documentiliberi as $documentiliberiscrittura) {
            if (is_null($documentiliberiscrittura->getNumeroprotocollo()))
            {
                $documentiliberiscrittura->setNumeroprotocollo($numprotocollo);
                $em->persist($documentiliberiscrittura);
            }
        }
        $documenti=$em->getRepository('estarRdaBundle:Richiestadocumento')->findBy(array('idRichiesta' => $idRichiesta));
        foreach($documenti as $documentiscrittura) {
            if (is_null($documentiscrittura->getNumeroprotocollo()))
            {
                $documentiscrittura->setNumeroprotocollo($numprotocollo);
                $em->persist($documentiscrittura);
            }
        }

        $iter=$em->getRepository('estarRdaBundle:Iter')->findBy(array('idRichiesta' => $idRichiesta));
        foreach($iter as $iterscrittura) {
            if (is_null($iterscrittura->getNumeroprotocollo()))
            {
                $iterscrittura->setNumeroprotocollo($numprotocollo);
                $em->persist($iterscrittura);
            }
        }

        $em->flush();

        //return $this->redirect($this->generateUrl("richiesta"));
        //return $this->render('@estarRda/Testing/index.html.twig', array(
        //    'hello' => $myrespons,
        //));

        return $this->redirect($this->generateUrl("richiesta"));

        }




    }


/*

        // estrazione parametri per la richiesta
        $em = $this->getDoctrine()->getManager();
        $parametri = $em->getRepository('estarRdaBundle:Sistematica')->find(1);
        //$user = $parametri->getUser();
        //$psw = $parametri->getPsw();
        //$wsdl = $parametri->getWsdl();
        //$storyboardcode = $parametri->getStoryboardcode();
        //$setmetaviewname = $parametri->getSetmetaviewname();
        //$setdirection = $parametri->getSetdirection();
        //$contactSettype1 = $parametri->getContactSettype1();
        //$contactReferencetype1 = $parametri->getContactReferencetype1();
        //$contactReferencecode1 = $parametri->getContactReferencecode1();
        //$contactSettype2 = $parametri->getContactSettype2();
        //$contactReferencetype2 = $parametri->getContactReferencetype2();
        //$contactReferencecode2 = $parametri->getContactReferencecode2();
        //$contactSettype3 = $parametri->getContactSettype3();
        //$contactReferencetype3 = $parametri->getContactReferencetype3();
        //$contactReferencecode3 = $parametri->getContactReferencecode3();
        //$variableSetkey1 = $parametri->getVariableSetkey1();
        //$variableSettype1 = $parametri->getVariableSettype1();
        //$variableSetvaluestring1 = $parametri->getVariableSetvaluestring1();
        //$attachmentSetfileset1 = $parametri->getAttachmentSetfileset1();
        //$attachmentSetcontenttype1 = $parametri->getAttachmentSetcontenttype1();
        //$requestSetinstanceoperation = $parametri->getRequestSetinstanceoperation();

        // esecuzione file java
        // abilitare su php.ini di apache (wamp) safe_mode_exec_dir=off
        //exec($path . "_esec.bat", $output, $return);
        exec("java -cp ./client/src TestClient ".$path." ../../sender/".$path."/", $output, $return);


        // estrazione del numero di protocollo dalla risposta
        //$numProt = file_get_contents("/client/src/" . $path . "_protocollo.txt", FILE_USE_INCLUDE_PATH);
        $numProt = file_get_contents($path . "_protocollo.txt", FILE_USE_INCLUDE_PATH);

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
        //unlink($batfile);
        //unlink("client/src/" . $path . "_protocollo.txt");
        unlink($path . "_protocollo.txt");

        return $this->redirect($this->generateUrl("richiesta"));

}

}
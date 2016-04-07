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
use estar\rda\RdaBundle\Model\ClientSistematica;
use estar\rda\RdaBundle\Controller\FormTemplateController;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Iter;
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
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_VALORI = '|';
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_CAMPI = '||';

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
        $options = explode(FormTemplateController::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateController::SEPARATORE_VALORI, $option);
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

    function getFirstLevel($string)
    {
        $options = explode(FormTemplateController::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateController::SEPARATORE_VALORI, $option);
            array_push($returnOptions, $subOption[1]);
        }

        return $returnOptions;
    }

    function getFather($string)
    {
        $options = explode(FormTemplateController::SEPARATORE_CAMPI, $string);
        $subOption = explode(FormTemplateController::SEPARATORE_VALORI, $options[0]);

        return $subOption[0];
    }

    public function num()
    {
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
        $num = $this->num();
        $path = $num . "_Richiesta_" . $idRichiesta . "_categoria_" . $idCategoria;
        if (!is_dir($directory_sender . "/" . $path)) mkdir($directory_sender . "/" . $path, 0777);

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT IDENTITY (c.iddocumento ) as iddocu
                                   FROM estarRdaBundle:Richiestadocumento c
                                   WHERE c.idrichiesta = :idRichiesta')->setparameter('idRichiesta', $idRichiesta);
        $arrayiddocumento = $query->getResult();

        foreach ($arrayiddocumento as $idDoc) {
            $idD = $idDoc;
            $idDoc = $idD['iddocu'];
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
            $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . 'Documento_' . $idDoc . '_' . $nomedescrizione . "_Richiesta_" . $idRichiesta . ".pdf");
        }

        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);
        $query = $em->createQuery('SELECT c.id AS idcampo, identity (c.idcategoria) as pippocategoria, c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,vc.id,vc.valore
                                    FROM estarRdaBundle:Campo c LEFT JOIN estarRdaBundle:Valorizzazionecamporichiesta vc
                                    WITH c.id = vc.idcampo
                                    AND vc.idrichiesta = :idRichiesta')
            ->setparameter('idRichiesta', $idRichiesta);
        //FG20160317 hack: non c'è verso di far capire a doctrine che voglio solo quelli di una categoria.
        $campiValorizzatiIntermedi = $query->getResult();
        //Itero sul risultato e sego. Mi vergogno di me stesso.
        $campiValorizzati = array();
        foreach ($campiValorizzatiIntermedi as $campovalorizzato) {
            $campoTemp = $campovalorizzato;
            if ($campoTemp['pippocategoria'] == $idCategoria)
                array_push($campiValorizzati, $campoTemp);
        }

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


        $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . $num . "_Richiesta_" . $idRichiesta . ".pdf");
        $zip = \Comodojo\Zip\Zip::create($directory_sender . '/' . $path . '/' . $path . '.zip');

        $zip->add($directory_sender . "/" . $path, true); //->add($pathdocumenti, true);


        $pathdocumenti = 'documenti/Richiesta_' . $idRichiesta;
        if (!is_dir($pathdocumenti)) mkdir($pathdocumenti, 0777);
        $documenti = $em->getRepository('estarRdaBundle:Richiestadocumento')->findBy(array('idrichiesta' => $idRichiesta));
        foreach ($documenti as $documentidazippare) {
            if (is_null($documentidazippare->getNumeroprotocollo()))
                $zip->setPath($pathdocumenti)->add($documentidazippare->getFilepath());
        }

        $documentiliberi = $em->getRepository('estarRdaBundle:Richiestadocumentolibero')->findBy(array('idrichiesta' => $idRichiesta));
        foreach ($documentiliberi as $documentiliberidazippare) {
            if (is_null($documentiliberidazippare->getNumeroprotocollo()))
                $zip->setPath($pathdocumenti)->add($documentiliberidazippare->getFilepath());
        }


        $zip->close();

        return array('esito' => true, 'progressivo' => $num, 'path' => $path);
        //true;
    }


    /**
     * @param string $idRichiesta
     * @param string $idCategoria
     * @param string $tipologia
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($idCategoria, $idRichiesta, $tipologia)
    {

        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $gruppogestav = $categoria->getGruppogestav();
        $categoriamerciologica = $categoria->getNomegestav();

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $azienda = $richiesta->getIdazienda()->getNome();


        switch ($tipologia) {

            case "Annullamento":
                $pathfile = "";
                $nomefile = "";
                $idGestav = $richiesta->getIdgestav();
                break;

            case "Nuova":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta);
                if ($ritorno['esito']) {
                    $idGestav = "xxxxx";
                    $pathfile = "sender/" . $ritorno['path'] . "/" . $ritorno['path'] . ".zip";
                    $nomefile = $ritorno['path'] . '.zip';

                }
                break;
            case "Documentazione Aggiuntiva":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta);
                if ($ritorno['esito']) {
                    $idGestav = $richiesta->getIdgestav();
                    $pathfile = "sender/" . $ritorno['path'] . "/" . $ritorno['path'] . ".zip";
                    $nomefile = $ritorno['path'] . '.zip';

                }
                break;
        }



        $risposta = $this->get('model.client');
        $risposta->setIdPratica($idRichiesta);
        $risposta->setNomefile($nomefile);
        $risposta->setPath($pathfile);
        $risposta->setTipologia($tipologia);
        $risposta->setCategoriamerceologica($categoriamerciologica);
        $risposta->setGruppogestav($gruppogestav);
        $risposta->setIdgestav($idGestav);
        $risposta->setStrutturarichiedente($azienda);

        $esito = $risposta->RequestWebServer();

        if ($esito['esito'] == true and ($tipologia == "Nuova" or $tipologia == "Documentazione Aggiuntiva")) {
            $numprotocollo = $esito['protocollo'];
            $idGestav=$esito['chiavesistematica'];
            $urlGestav=$esito['urlprotocollo'];

            $factory = $this->container->get('sm.factory');
            $articleSM = $factory->get($richiesta, 'rda');
            if ($articleSM->can('inviato_ABS')) {
                $iter = new Iter();
                $iter->setDastato($articleSM->getState());
                $articleSM->apply('inviato_ABS');
                $iter->setAstato($articleSM->getState());
                $iter->setNumeroprotocollo($numprotocollo);
                $iter->setIdrichiesta($richiesta);
                $iter->setMotivazione("Inviato e protocollato");
                $iter->setDataora(new \DateTime('now'));
                $iter->setIdutente($this->getUser());
                $iter->setDatafornita(false);
                $em->persist($iter);


                //TODO: aggiungere il protocollo in richiesta solo se tipologia è nuova
                // scrivo il numero di protocollo sulla richiesta
                if ($tipologia == "Nuova") {
                    $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
                    $richiesta->setNumeroprotocollo($numprotocollo);
                    $em->persist($richiesta);
                }

                //TODO: aggiungere il protocollo in iter, richiestadocumenti e richiestadocumentiliberi se protocollo null

                $documentiliberiscr = $em->getRepository('estarRdaBundle:Richiestadocumentolibero')->findBy(array('idrichiesta' => $idRichiesta));
                foreach ($documentiliberiscr as $documentiliberiscrittura) {
                    if (is_null($documentiliberiscrittura->getNumeroprotocollo())) {
                        $documentiliberiscrittura->setNumeroprotocollo($numprotocollo);
                        $em->persist($documentiliberiscrittura);
                    }
                }
                $documentiscr = $em->getRepository('estarRdaBundle:Richiestadocumento')->findBy(array('idrichiesta' => $idRichiesta));
                foreach ($documentiscr as $documentiscrittura) {
                    if (is_null($documentiscrittura->getNumeroprotocollo())) {
                        $documentiscrittura->setNumeroprotocollo($numprotocollo);
                        $em->persist($documentiscrittura);
                    }
                }

                //$iter=$em->getRepository('estarRdaBundle:Iter')->findBy(array('idrichiesta' => $idRichiesta));
                //foreach($iter as $iterscrittura) {
                //    if (is_null($iterscrittura->getNumeroprotocollo()))
                //    {
                //        $iterscrittura->setNumeroprotocollo($numprotocollo);
                //        $em->persist($iterscrittura);
                //    }
                //}

                $em->flush();

                //return $this->redirect($this->generateUrl("richiesta"));
                //return $this->render('@estarRda/Testing/index.html.twig', array(
                //    'hello' => $myrespons,
                //));

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    array(
                        'alert' => 'success',
                        'title' => 'Success!',
                        'message' => 'Pratica protocollata correttamente!'
                    )
                );

            } else {
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    array(
                        'alert' => 'danger',
                        'title' => 'warning!',
                        'message' => 'C\'è stato un errore nell\'invio, riprovare'
                    )
                );
            }
            return $this->redirect($this->generateUrl("richiesta_bycategoria", array('idCategoria' => $idCategoria)));

        } else if ($esito['esito'] == true and $tipologia == "Annullamento") {
            $numprotocollo = $esito['protocollo'];
            $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);

            $factory = $this->container->get('sm.factory');
            $articleSM = $factory->get($richiesta, 'rda');
            if ($articleSM->can('annullamento')) {
                $iter = new Iter();
                $iter->setDastato($articleSM->getState());
                $articleSM->apply('annullamento');
                $iter->setAstato($articleSM->getState());
                $iter->setNumeroprotocollo($numprotocollo);
                $iter->setDastatogestav($entity->getStatusgestav());
                $iter->setAstatogestav($entity->getStatusgestav());
                $iter->setIdrichiesta($entity);
                $iter->setMotivazione("richiesta Annullata dall'utente");
                $iter->setDataora(new \DateTime('now'));
                $iter->setIdutente($this->getUser());
                $iter->setDatafornita(false);
                $em->persist($iter);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    array(
                        'alert' => 'success',
                        'title' => 'Success!',
                        'message' => 'Pratica annullata correttamente!'
                    )
                );
            } else {

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    array(
                        'alert' => 'danger',
                        'title' => 'warning!',
                        'message' => 'C\'è stato un errore nell\'invio, riprovare'
                    )
                );
            }

            return $this->redirect($this->generateUrl("richiesta_bycategoria", array('idCategoria' => $idCategoria)));
        }

        $this->get('session')->getFlashBag()->add(
            'notice',
            array(
                'alert' => 'info',
                'title' => 'info!',
                'message' => 'Contattare'
            )
        );

        return $this->redirect($this->generateUrl("richiesta_bycategoria", array('idCategoria' => $idCategoria)));


    }
}


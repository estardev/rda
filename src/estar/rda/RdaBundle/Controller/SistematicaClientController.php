<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Model\RichiestaModel;
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

use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

use BeSimple\SoapClient\Tests\AxisInterop\Fixtures\AttachmentRequest;
use BeSimple\SoapClient\Tests\AxisInterop\Fixtures\AttachmentType;
use BeSimple\SoapClient\Tests\AxisInterop\Fixtures\base64Binary;
use estar\rda\RdaBundle\Entity\Utente;
use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Bundle\FrameworkBundle\Routing\Router as Router;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;




class SistematicaClientController extends Controller
{
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_VALORI = '|';
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_CAMPI = '||';

    public $toReturn=array();

    // cancellazione di cartella non vuota
    public static function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    //copia i file necessari nella cartella e genera l'array necessario per l'attachment
    public static function arrayFile($src,$dest, $filepath=null)
    {   global $toReturn;
        $files = array_diff(scandir($src), array('.', '..'));
        foreach ($files as $file) {
            if(is_dir("$src/$file"))
                arrayFile("$src/$file");
            else{
                if($filepath==null){
                    array_push($toReturn,"$file");
                }
                else
                    array_push($toReturn,"$filepath");

                if($src.'/'.$file != $dest.'/'.$file)
                    copy($src.'/'.$file, $dest.'/'.$file);
            }
        }
        return true;
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

    public function generateZip($idCategoria, $idRichiesta )
    {
        $directory_sender = "sender";
        $num = $this->num();
        //Pathname da usare
        $path = $num . "_Richiesta_" . $idRichiesta . "_categoria_" . $idCategoria;
        //Se non esiste, lo creo
        if (!is_dir($directory_sender . "/" . $path)) mkdir($directory_sender . "/" . $path, 0777);
        $em = $this->getDoctrine()->getManager();

                // generazione file pdf e zip

                //Recupero tutti i documenti con campi valorizzati collegati a quella richiesta!!
                $query = $em->createQuery('SELECT IDENTITY (c.iddocumento ) as iddocu
                                   FROM estarRdaBundle:Richiestadocumento c
                                   WHERE c.idrichiesta = :idRichiesta')->setparameter('idRichiesta', $idRichiesta);
                $arrayiddocumento = $query->getResult();
                //Vado a generare tutti i documenti
                foreach ($arrayiddocumento as $idDoc) {
                    $idD = $idDoc;
                    $idDoc = $idD['iddocu'];
                    $em = $this->getDoctrine()->getManager();
                    /*
                     * se i documenti sono
                     * - Copertura Economica (2)
                     * - Dichiarazione di assenza conflitto interesse (7)
                     */
                    //if ($idDoc==2 or $idDoc==7) continue;
                    //Recupero tutti i campi di quel documento che siano definiti con l'eventuale valorizzazione
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
                    //Campi fissi
                    //FG 20170410 rimossi e riparametrati nel printbase per darne maggiore evidenza
//                    $formbuilder->add("nome", "text", array(
//                        'label' => "nome",
//                        'data' => $documento->getNome(),
//                        'read_only' => true
//                    ));
//                    $formbuilder->add("descrizione", "textarea", array(
//                        'label' => "descrizione",
//                        'data' => $documento->getDescrizione(),
//                        'read_only' => true
//                    ));
                    //Per tutti i campi...
                    foreach ($campiValorizzati as $campovalorizzato) {
                        $campo = $campovalorizzato;
                        $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campodocumento');
                        $campoCheck = $repository->find($campo['idcampo']);
                        if($campo['tipo']=='text') $tipocampo ='textarea'; else $tipocampo=$campo['tipo'];
                        if ($tipocampo == 'choice') {
                            //Se è una scelta...
                            //Se è effettivamente valorizzato...
                            if(!is_null($this->getChoicesOptions($campoCheck->getFieldset())) and !is_null($campo['valore']) ){
                                //..lo aggiungo
                                $descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                                $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                                    'label' => $campo['descrizione'],
                                    'data' => $descrizioneValore,
                                    'read_only' => true
                                ));
                            } else continue; //diversamente lo ignoro
                          //  $descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                          //  $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                          //      'label' => $campo['descrizione'],
                          //      'data' => $descrizioneValore,
                          //      'read_only' => true
                          //  ));
                            //FG 20170410 il significato di un value trasformer in un campo di lettura mi è oscuro. Peraltro su un choice.
                            $formbuilder->get($campo['nome'] . '-' . $campo['id'])
                                ->addModelTransformer(new CallbackTransformer(
                                    function ($originalValue) {
                                        if ("" === $originalValue) return null;
                                        if (is_numeric($originalValue)) {
                                            return intval($originalValue);
                                        } else {
                                            return $originalValue;
                                        }
                                    },
                                    function ($submittedValue) {
                                        return $submittedValue;
                                    }
                                ));
                        } else {
                            // ... se non è una scelta lo aggiungo punto e basta
                            $formbuilder->add($campo['nome'] . '-' . $campo['id'], $tipocampo, array(
                                'label' => $campo['descrizione'],
                                'data' => $campo['valore'],
                                'read_only' => true
                            ));

                            //FG20170410 idem come sopra
                            $formbuilder->get($campo['nome'] . '-' . $campo['id'])
                                ->addModelTransformer(new CallbackTransformer(
                                    function ($originalValue) {
                                        if ("" === $originalValue) return null;
                                        if (is_numeric($originalValue)) {
                                            return intval($originalValue);
                                        } else {
                                            return $originalValue;
                                        }
                                    },
                                    function ($submittedValue) {
                                        return $submittedValue;

                                    }
                                ));
                        }
                    }
                    $form = $formbuilder->getForm();

                    $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
                    $prioritapossibili = $richiesta::getPossibleEnumPriorita();
                    $priorita = $prioritapossibili[$richiesta->getPriorita()];
                    $iter = $em->getRepository('estarRdaBundle:Iter')->findByIdrichiesta($richiesta);
                    $html = $this->renderView('::printbase.html.twig', array(
                        'form' => $form->createView(),
                        'azienda' => $richiesta->getIdazienda(),
                        'documento' => $documento,
                        'categoria' => $richiesta->getIdcategoria(),
                        'titolo' => $richiesta->getTitolo(),
                        'descrizione' => $richiesta->getDescrizione(),
                        'priorita' => $priorita,
                        'iter' => $iter
                    ));
                    //FG20170410 sistemiamo a parte il nome file
                    $filename = 'Documento_'.$idDoc.'_'.str_replace(' ', '_', $nomedescrizione).'_Richiesta_'.$idRichiesta.'.pdf';
//                    $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . 'Documento_' . $idDoc . '_' . $nomedescrizione . "_Richiesta_" . $idRichiesta . ".pdf");
                    $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" .$filename);
                }

                //prendo la richiesta con tutti i campi da valorizzare!!!
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
                //FG20170410 questi campi vanno rimossi perchè nella modifica del printbase di pochi giorni fa sono parametrati.
//                $formbuilder->add("Azienda", "text", array(
//                    'label' => "Azienda richiedente",
//                    'data'=> $richiesta->getIdazienda()->getNome(),
//                    'read_only' => true
//                ));
//                $formbuilder->add("titolo", "text", array(
//                    'label' => "titolo",
//                    'data' => $richiesta->getTitolo(),
//                    'read_only' => true
//                ));
//                $formbuilder->add("descrizione", "textarea", array(
//                    'label' => "descrizione",
//                    'data' => $richiesta->getDescrizione(),
//                    'read_only' => true
//                ));

                foreach ($campiValorizzati as $campovalorizzato) {
                    $campo = $campovalorizzato;

                    $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campo');
                    $campoCheck = $repository->find($campo['idcampo']);
                    if($campo['tipo']=='text') $tipocampo ='textarea'; else $tipocampo=$campo['tipo'];
                    if (!($diritti->campoVisualizzabile($diritti, $campoCheck))) continue;

                    if ($tipocampo == 'choice') {

                        if(!is_null($this->getChoicesOptions($campoCheck->getFieldset())) and !is_null($campo['valore']) ){
                            $descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                            $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                                'label' => $campo['descrizione'],
                                'data' => $descrizioneValore,
                                'read_only' => true
                            ));
                        } else continue;

                    //    $descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                    //    $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                    //        'label' => $campo['descrizione'],
                    //        'data' => $descrizioneValore,
                    //        'read_only' => true
                    //    ));

                        $formbuilder->get($campo['nome'] . '-' . $campo['id'])
                            ->addModelTransformer(new CallbackTransformer(

                                function ($originalValue) {

                                    if ("" === $originalValue) return null;

                                    if (is_numeric($originalValue)) {
                                        return intval($originalValue);
                                    } else {
                                        return $originalValue;
                                    }


                                },
                                function ($submittedValue) {

                                    return $submittedValue;

                                }
                            ));
                    } else {

                        $formbuilder->add($campo['nome'] . '-' . $campo['id'], $tipocampo, array(
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'read_only' => true
                        ));
                        $formbuilder->get($campo['nome'] . '-' . $campo['id'])
                            ->addModelTransformer(new CallbackTransformer(

                                function ($originalValue) {

                                    if ("" === $originalValue) return null;

                                    if (is_numeric($originalValue)) {
                                        return intval($originalValue);
                                    } else {
                                        return $originalValue;
                                    }


                                },
                                function ($submittedValue) {

                                    return $submittedValue;

                                }
                            ));
                    }
                }
                $form = $formbuilder->getForm();
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $prioritapossibili = $richiesta::getPossibleEnumPriorita();
        $priorita = $prioritapossibili[$richiesta->getPriorita()];
        $iter = $em->getRepository('estarRdaBundle:Iter')->findByIdrichiesta($richiesta);
                $html = $this->renderView('::printbase.html.twig', array(
//            'entity' => $entity,
                    'form' => $form->createView(),
                    'azienda' => $richiesta->getIdazienda(),
                    'categoria' => $richiesta->getIdcategoria(),
                    'titolo' => $richiesta->getTitolo(),
                    'descrizione' => $richiesta->getDescrizione(),
                    'priorita' => $priorita,
                    'iter' => $iter
                ));


                $this->get('knp_snappy.pdf')->generateFromHtml($html, $directory_sender . "/" . $path . "/" . $num . "_Richiesta_" . $idRichiesta . ".pdf");

                //$filearray=self::arrayFile($directory_sender . "/" . $path, $directory_sender . "/" . $path,null);

                //TODO: ELIMINARE ZIP
                $zip = \Comodojo\Zip\Zip::create($directory_sender . '/' . $path . '/' . $path . '.zip');
                $zip->add($directory_sender . "/" . $path, true); //->add($pathdocumenti, true);


                $pathdocumenti = 'documenti/Richiesta_' . $idRichiesta;
                if (!is_dir($pathdocumenti)) mkdir($pathdocumenti, 0777);
                $documenti = $em->getRepository('estarRdaBundle:Richiestadocumento')->findBy(array('idrichiesta' => $idRichiesta));
                foreach ($documenti as $documentidazippare) {
                    if (is_null($documentidazippare->getNumeroprotocollo()))
                        //$filearray=self::arrayFile($pathdocumenti, $directory_sender . "/" . $path,$documentidazippare->getFilepath());
                        //array_push($filearray,$documentidazippare->getFilepath());
                    //TODO: CAMBIARE LO ZIP CON LO SPOSTAMENTO DEI FILE NEL PATH DELLA CARTELLA DA INVIARE
                        if(!is_null($documentidazippare->getFilepath())){
                            $zip->setPath($pathdocumenti)->add($documentidazippare->getFilepath());
                        } else continue;

                }

                $documentiliberi = $em->getRepository('estarRdaBundle:Richiestadocumentolibero')->findBy(array('idrichiesta' => $idRichiesta));
                foreach ($documentiliberi as $documentiliberidazippare) {
                    if (is_null($documentiliberidazippare->getNumeroprotocollo()))
                        //$filearray=self::arrayFile($pathdocumenti, $directory_sender . "/" . $path,$documentiliberidazippare->getFilepath());
                    //array_push($filearray,$documentidazippare->getFilepath());
                    //TODO: CAMBIARE LO ZIP CON LO SPOSTAMENTO DEI FILE NEL PATH DELLA CARTELLA DA INVIARE
                        if(!is_null($documentiliberidazippare->getFilepath())){
                            $zip->setPath($pathdocumenti)->add($documentiliberidazippare->getFilepath());
                        } else continue;
                }

                //TODO: ELIMINARE ZIP
                $zip->close();

                return array('esito' => true, 'progressivo' => $num, 'path' => $path);



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
        $priorita=$richiesta->getPriorita();
        switch ($priorita){
            case 1: $prioritastringa="Prioritaria"; break;
            case 2: $prioritastringa="Elevata"; break;
            case 3: $prioritastringa="Standard"; break;
        }
        $anno=date('Y');


        switch ($tipologia) {

            case "Annullamento":
                $pathfile = "";
                $nomefile = "";
                $idgara="";
                $idGestav = $richiesta->getIdgestav();
                break;

            case "Nuova":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta);
                if ($ritorno['esito']) {
                    $idGestav = "xxxxx";
                    $idgara="";
                    $pathfile = "sender/" . $ritorno['path'] . "/" . $ritorno['path'] . ".zip";
                    $nomefile = $ritorno['path'] . '.zip';

                }
                break;

            case "Documentazione aggiuntiva":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta);
                if ($ritorno['esito']) {
                    $idGestav = $richiesta->getIdgestav();
                    $idgara="";
                    $pathfile = "sender/" . $ritorno['path'] . "/" . $ritorno['path'] . ".zip";
                    $nomefile = $ritorno['path'] . '.zip';

                }
                break;

            case "Documentazione richiesta da RUP":
                $ritorno = $this->generateZip($idCategoria, $idRichiesta, $tipologia);
                if ($ritorno['esito']) {
                    $idGestav = $richiesta->getIdgestav();
                    $idgara= $richiesta->getCodicegara();
                    $pathfile = "sender/" . $ritorno['path'] . "/" . $ritorno['path'] . ".zip";
                    $nomefile = $ritorno['path'] . '.zip';

                }
                break;

        }


        $risposta = $this->get('model.client');
        $risposta->setIdPratica($idRichiesta);
        $risposta->setNomefile($nomefile);
        $risposta->setPath($pathfile);
        $titolo = $richiesta->getTitolo();
        str_replace('<','&lt;',$titolo);
        str_replace('>','&gt;',$titolo);
        str_replace('&','&amp;',$titolo);
        $risposta->setOggettomessaggio($azienda.": ".$categoriamerciologica.", ".$titolo);
        $risposta->setTipologia($tipologia);
        $risposta->setPriorita($prioritastringa);
        $risposta->setCategoriamerceologica($categoriamerciologica);
        $risposta->setGruppogestav($gruppogestav);
        $risposta->setIdgestav($idGestav);
        $risposta->setIdgara($idgara);
        $risposta->setStrutturarichiedente($azienda);

//        if ($this->getParameter("tipoinstallazione") == "test")
//            $pippo = "pluto";
//        else
//            $pippo = "paperino";

        $esito = $risposta->RequestWebServer();

        if ($esito['esito'] == true and ($tipologia == "Nuova" or $tipologia == "Documentazione aggiuntiva" or $tipologia == "Documentazione richiesta da RUP" )) {
            $numprotocollo = $esito['protocollo'];
            $idGestav=$esito['chiavesistematica'];
            $urlGestav=$esito['urlprotocollo'];
            $dataprotocollo=$esito['dataprotocollo'];

            /*
             * Valutazione amministrativa:
                    15 Beni economali,
                    16 Arredi,
                    8  Servizi Tecnico Amministrativi e Sanitari,
                    19 Servizi Socio Sanitari
               Valutazione tecnica:
                    Farmaci (importo Gara > 40.000 EU),
                    Dispositivi Medici (importo Gara > 40.000 EU),
                    Diagnostici (importo Gara > 40.000 EU),
                    Attrezzature sanitarie,
                    Servizi manutenzione Attrezzature Sanitarie,
                    Acquisto Software, Manutenzione Software,
                    Attrezzature informatiche,
                    Servizi manutenzione Attrezzature Informatiche
             */

            $factory = $this->container->get('sm.factory');
            $articleSM = $factory->get($richiesta, 'rda');
            if ($articleSM->can('inviato_ESTAR')) {
                $iter = new Iter();
                $iter->setDastato($articleSM->getState());
                $articleSM->apply('inviato_ESTAR');
                $iter->setAstato($articleSM->getState());
                $iter->setNumeroprotocollo($numprotocollo."/".$anno);
                $iter->setIdrichiesta($richiesta);
                if($tipologia=="Nuova"){
                    $iter->setMotivazione("Nuova richiesta inviata e protocollata");
                    if ($categoria->getId()==15 or $categoria->getId()==16 or $categoria->getId()==8 or $categoria->getId()==19){
                        $iter->setAstatogestav('Validazione Amministrativa in ESTAR');
                        $richiesta->setStatusgestav('Validazione Amministrativa in ESTAR');
                    }
                    else{
                        $iter->setAstatogestav('Validazione Tecnica in ESTAR');
                        $richiesta->setStatusgestav('Validazione Tecnica in ESTAR');
                    }

                }
                elseif ($tipologia == "Documentazione aggiuntiva"){
                    $iter->setMotivazione("Inviata Documentazione aggiuntiva per la pratica ".$idRichiesta);
                    $iter->setAstatogestav("Inviata Documentazione Aggiuntiva");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                }
                elseif ($tipologia == "Documentazione richiesta da RUP"){
                    $iter->setMotivazione("Inviata Documentazione aggiuntiva per la gara ".$idgara);
                    $iter->setAstatogestav("Inviata Documentazione Aggiuntiva");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                }
                $iter->setDataora(new \DateTime('now'));
                $iter->setIdutente($this->getUser());
                $iter->setIdgestav($idGestav);
                $iter->setUrlprotocollo($urlGestav);
                $iter->setDataprotocollo($dataprotocollo);
                $iter->setDatafornita(false);
                $em->persist($iter);
                $em->persist($richiesta);

                // scrivo il numero di protocollo sulla richiesta se è nuova
                if ($tipologia == "Nuova") {
                    $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
                    $richiesta->setNumeroprotocollo($numprotocollo."/".$anno);
                    $richiesta->setDataprotocollo($dataprotocollo);
                    $richiesta->setUrlprotocollo($urlGestav);
                    $richiesta->setIdgestav($idGestav);
                    $richiesta->setPresentato(0);
                    $em->persist($richiesta);
                }
                elseif ($tipologia == "Documentazione aggiuntiva"){

                    $richiesta->setPresentato(0);
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ATTESA_INV);
                    $em->persist($richiesta);
                }
                elseif ($tipologia == "Documentazione richiesta da RUP"){
                    $richiesta->setPresentato(0);
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ATTESA_INV);
                    $em->persist($richiesta);
                }


                //aggiungere il protocollo in iter, richiestadocumenti e richiestadocumentiliberi se protocollo null

                $documentiliberiscr = $em->getRepository('estarRdaBundle:Richiestadocumentolibero')->findBy(array('idrichiesta' => $idRichiesta));
                foreach ($documentiliberiscr as $documentiliberiscrittura) {
                    if (is_null($documentiliberiscrittura->getNumeroprotocollo())) {
                        $documentiliberiscrittura->setNumeroprotocollo($numprotocollo."/".$anno);
                        $documentiliberiscrittura->setIdgestav($idGestav);
                        $documentiliberiscrittura->setDatainvio(new \DateTime('now'));
                        $documentiliberiscrittura->setDainviare(true);
                        $documentiliberiscrittura->setDataprotocollo($dataprotocollo);
                        $documentiliberiscrittura->setUrlprotocollo($urlGestav);
                        $em->persist($documentiliberiscrittura);
                    }
                }
                $documentiscr = $em->getRepository('estarRdaBundle:Richiestadocumento')->findBy(array('idrichiesta' => $idRichiesta));
                foreach ($documentiscr as $documentiscrittura) {
                    if (is_null($documentiscrittura->getNumeroprotocollo())) {
                        $documentiscrittura->setNumeroprotocollo($numprotocollo."/".$anno);
                        $documentiscrittura->setIdgestav($idGestav);
                        $documentiscrittura->setDatainvio(new \DateTime('now'));
                        $documentiscrittura->setDainviare(true);
                        $documentiscrittura->setDataprotocollo($dataprotocollo);
                        $documentiscrittura->setUrlprotocollo($urlGestav);
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
            $idGestav=$esito['chiavesistematica'];
            $urlGestav=$esito['urlprotocollo'];
            $dataprotocollo=$esito['dataprotocollo'];
            $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);

            $factory = $this->container->get('sm.factory');
            $articleSM = $factory->get($richiesta, 'rda');
            if ($articleSM->can('annullamento')) {
                $iter = new Iter();
                $iter->setDastato($articleSM->getState());
                $articleSM->apply('annullamento');
                $iter->setAstato($articleSM->getState());
                $iter->setNumeroprotocollo($numprotocollo."/".$anno);
                $iter->setDastatogestav($entity->getStatusgestav());
                $iter->setAstatogestav($entity->getStatusgestav());
                $iter->setIdrichiesta($entity);
                $iter->setIdgestav($idGestav);
                $iter->setUrlprotocollo($urlGestav);
                $iter->setDataprotocollo($dataprotocollo);
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
                'alert' => 'danger',
                'title' => 'info!',
                'message' => 'C\'è stato un errore nell\'invio della domanda verso iShareDoc, Riprovare o contattare i sistemisti'
            )
        );

        return $this->redirect($this->generateUrl("richiesta_bycategoria", array('idCategoria' => $idCategoria)));


    }
}


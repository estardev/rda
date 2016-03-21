<?php

namespace estar\rda\RdaBundle\Controller;


use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Utente;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FormTemplateController extends Controller
{

    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_VALORI = '|';
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_CAMPI = '||';

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


    /**
     * Displays a form to create a new FormTemplate entity.
     * @param $idCategoria
     * @return Response
     */
    public function newAction($idCategoria)
    {

        $repository = $this->getDoctrine()->getRepository(Campo::class);

        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamento' => 'ASC')
        );

        $entity = new FormTemplate($idCategoria, $campi);


        $res = $this->get('form_template_factory')->build($this->get('form.factory')->createNamedBuilder('form', 'form', array()), $entity, 0);
        $form = $res[0];

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_back', array('idCategoria' => $idCategoria)));
        $backForm = $formbuilder->getForm();
        $backForm->add('back', 'submit', array('label' => 'Indietro'));


        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'form' => $form->createView(),
            'firstLevels' => $res[1],
            'back_form' => $backForm->createView()

        ));


    }

    public function createAction(Request $request, $idCategoria)
    {


        $em = $this->getDoctrine()->getManager();

        $utente = $this->getUser();
        $idazienda= $utente->getIdazienda();
        $campi = $request->request->all();

        $campiStruttura = $em->getRepository('estarRdaBundle:Campo')->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamento' => 'ASC')
        );

        $entity = new FormTemplate($idCategoria, $campiStruttura);
        $res = $this->get('form_template_factory')->build($this->get('form.factory')->createNamedBuilder('form', 'form', array()), $entity, 0);
        $form = $res[0];

        $form->handleRequest($request);

        if ($form->isValid()) {
            $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
            $richiesta = new Richiesta();
            $richiesta->setIdcategoria($categoria);
            $richiesta->setIdazienda($idazienda);
            $richiesta->setStatus('bozza');
            $richiesta->setTitolo($campi['form']['titolo']);
            $richiesta->setDescrizione($campi['form']['descrizione']);
            $richiesta->setPriorita($campi['form']['priorita']);
            $em->persist($richiesta);


            foreach ($campi['form'] as $key => $value) {
                if (!strrpos($key, "-")) {
                    //FG20151016 salto perch� i campi li ho gi� sistemati prima
                    continue;
                }
                $a = explode('-', $key);
                $idCampo = $a[1];

                $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);
                $vcr = new Valorizzazionecamporichiesta();
                $vcr->setIdcampo($campo);
                $vcr->setIdcategoria($categoria);
                $vcr->setIdrichiesta($richiesta);
                $vcr->setValore($value);
                $em->persist($vcr);

            }

            $em->flush();

            return $this->redirect($this->generateUrl("richiesta_bycategoria", array("idCategoria" => $idCategoria)));
        }

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_back', array('idCategoria' => $idCategoria)));
        $backForm = $formbuilder->getForm();
        $backForm->add('back', 'submit', array('label' => 'Indietro'));


        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'form' => $form->createView(),
            'firstLevels' => $res[1],
            'back_form' => $backForm->createView()
        ));

    }


    /**
     * Finds and displays a FormTemplate entity.
     * @param $idRichiesta
     * @param $idCategoria
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($idCategoria, $idRichiesta)
    {

        //TODO: vanno aggiunti anche i documenti (generati o creati, della stessa sostanza del Padre)
        $em = $this->getDoctrine()->getManager();

        //FG20151028 modifica per i diritti: prendiamo i diritti
        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);

//        $queryBuilder
//            ->select('u.id', 'u.name', 'p.number')
//            ->from('users', 'u')
//            ->innerJoin('u', 'phonenumbers', 'p', 'u.id = p.user_id')
//        $qb->join('u.Group', 'g', 'WITH', 'u.status = ?1')

//        $repository = $this->getDoctrine()
//            ->getRepository('estarRdaBundle:Campo');
        //FG modificata 20151028 aggiunto campo.id as idcampo
        $query = $em->createQuery('SELECT c.id AS idcampo, c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,vc.id,vc.valore
                                    FROM estarRdaBundle:Campo c LEFT JOIN estarRdaBundle:Valorizzazionecamporichiesta vc
                                    WITH c.id = vc.idcampo
                                    AND vc.idrichiesta = :idRichiesta')
            ->setparameter('idRichiesta', $idRichiesta);
//        $categoria = $query->getResult();
//        $query = $em->createQueryBuilder()
//            ->select('c,cv')
//            ->from('estar\rda\RdaBundle\Entity\Valorizzazionecampo','vc')
//            ->join('vc.idcampo', 'c', 'WITH', 'vc.idrichiesta=:idRichiesta')
//            ->setParameter('idRichiesta', $idRichiesta)
//            ->getQuery();

        $campiValorizzati = $query->getResult();
//
//        $campi = $repository->findBy(
//            array('idcategoria' => $idCategoria),
//            array('ordinamento' => 'ASC')
//        );
//
//
//        $repository = $this->getDoctrine()
//            ->getRepository('estarRdaBundle:Valorizzazionecamporichiesta');
//
//        $campiValorizzati = $repository->findBy(
//            array('idrichiesta' => $idRichiesta)
//        );

        $formbuilder = $this->createFormBuilder();
//        $fieldsetVisitati = array();

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
//            $campo = $campovalorizzato->getIdcampo();
            $campo = $campovalorizzato;

            //FG20151028 se il campo non è visualizzabile, skip.
            $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campo');
            $campoCheck = $repository->find($campo['idcampo']);
            if (!($diritti->campoVisualizzabile($diritti, $campoCheck))) continue;

//            if ($campo->getTipo() == 'choice') {
            if ($campo['tipo'] == 'choice') {
//                $fieldsetName = $campo->getFieldset();

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
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
//        }

        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
//            'entity' => $entity,
            'form' => $form->createView()

        ));
    }


    /**
     * Displays a form to edit an existing Richiesta entity.
     *
     * @param string $idCategoria la categoria
     * @param string $idRichiesta la richiesta
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editAction($idCategoria, $idRichiesta)
    {
        $em = $this->getDoctrine()->getManager();

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $res = $this->get('form_template_factory')->build($this->get('form.factory')->createNamedBuilder('form', 'form', array()), $richiesta, 1);
        $editForm = $res[0];

        if(is_null($richiesta->getNumeroprotocollo())){
            $tipologia="Nuova";
        } else $tipologia="Documentazione Aggiuntiva";

        //FG20151028 modifica per i diritti: prendiamo i diritti
//        $usercheck = $this->get("usercheck.notify");
//        $diritti = $usercheck->allRole($idCategoria);
//        $repository = $this->getDoctrine()
//            ->getRepository('estarRdaBundle:Campo');
//
//        $campi = $repository->findBy(
//            array('idcategoria' => $idCategoria),
//            array('ordinamento' => 'ASC')
//        );

//        $entity = new FormTemplate($idCategoria, $campi);

//        $repository = $this->getDoctrine()
//            ->getRepository('estarRdaBundle:Valorizzazionecamporichiesta');
//
//        $campiValorizzati = $repository->findBy(
//            array('idrichiesta' => $idRichiesta)
//        );
        //FG 20151028 modificata: aggiunto c.id as idcampo

        // $editForm->add('submit', 'submit', array('label' => 'Modifica'));

        $factory = $this->get('sm.factory');
        $articleSM = $factory->get($richiesta, 'rda');
        $stato = $articleSM->getState();

        $formbuilder = $this->createFormBuilder();

        $formbuilder->setAction($this->generateUrl('sistematicaclient_index', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta, 'tipologia' => $tipologia)));
        $ClientSoapForm = $formbuilder->getForm();
        $ClientSoapForm->add('submit', 'submit', array('label' => ' invia in ESTAR', 'attr' => array('icon' => 'glyphicon glyphicon-plane')));

        //FGDO20130310 il tasto "elimina" compare se e solo se la transizione si può fare
        $factory = $this->container->get('sm.factory');
        $articleSM = $factory->get($richiesta, 'rda');
        $deleteForm = $formbuilder->getForm();
        if ($articleSM->can('cancellazione')) {
            $formbuilder = $this->createFormBuilder();
            $formbuilder->setAction($this->generateUrl('richiesta_delete', array('id' => $idRichiesta)));
            $deleteForm = $formbuilder->getForm();
            $deleteForm->add('submit_delete', 'submit', array('label' => ' Elimina', 'attr' => array('icon' => 'glyphicon glyphicon-remove')));
        }

        $annullaForm = $formbuilder->getForm();
        if ($articleSM->can('annullamento')) {
            $formbuilder = $this->createFormBuilder();
            $formbuilder->setAction($this->generateUrl('richiesta_annulla', array('id' => $idRichiesta)));
            $annullaForm = $formbuilder->getForm();
            $annullaForm->add('submit_annulla', 'submit', array('label' => ' Annulla', 'attr' => array('icon' => 'glyphicon glyphicon-remove')));
        }

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_print', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta)));
        $printForm = $formbuilder->getForm();
        $printForm->add('submit', 'submit', array('label' => ' Stampa', 'attr' => array('icon' => 'glyphicon glyphicon-print')));


        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_back', array('idCategoria' => $idCategoria)));
        $backForm = $formbuilder->getForm();
        $backForm->add('back', 'submit', array('label' => ' Indietro', 'attr' => array('icon' => 'glyphicon glyphicon-arrow-left')));


        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);


//        TODO recupero ruolo utente e controllo se la richiesta pu� essere avanzata

//        $articleSM->can('a_transition_name');

        $possibili = $articleSM->getPossibleTransitions();

        $formbuilder = $this->createFormBuilder();

        $validaForms = array();
        foreach ($possibili as $key => $value) {

            $formbuilder->setAction($this->generateUrl('richiesta_valida', array('id' => $idRichiesta, 'transizione' => $value)));
            $validaForm = $formbuilder->getForm();
            //$formbuilder = $this->createFormBuilder();
            $validaForm->add("messaggio", "textarea", array(
                'label' => "Messaggio",
                'data' => "indicare motivazione di rigetto o validazione"
            ));
            $validaForm->add('submit', 'submit', array('label' => $value));
            //$MessaggioForm = $formbuilder->getForm();
            array_push($validaForms, $validaForm->createView());
        }
        $usercheckControl = $this->get('usercheck.notify');
        $dirittiucc = $usercheckControl->allRole($idCategoria);

        return $this->render('estarRdaBundle:FormTemplate:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'annulla_form' => $annullaForm->createView(),
            'print_form' => $printForm->createView(),
            'valida_forms' => $validaForms,
            'soap_form' => $ClientSoapForm->createView(),
            'back_form' => $backForm->createView(),
            'diritti' => $dirittiucc,
            'stato' => $stato,
            'firstLevels' => $res[1]
        ));

    }

    public
    function updateAction(Request $request, $idCategoria, $idRichiesta)
    {

        $em = $this->getDoctrine()->getManager();

        $campi = $request->request->all();

//        $campiStruttura = $em->getRepository('estarRdaBundle:Campo')->findBy(
//            array('idcategoria' => $idCategoria),
//            array('ordinamento' => 'ASC')
//        );

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $res = $this->get('form_template_factory')->build($this->get('form.factory')->createNamedBuilder('form', 'form', array()), $richiesta, 1);
        $editForm = $res[0];

        if(is_null($richiesta->getNumeroprotocollo())){
            $tipologia="Nuova";
        } else $tipologia="Documentazione Aggiuntiva";


        $editForm->handleRequest($request);

        if($editForm->isValid()) {


            //FG 20151016 valorizzazione campi richiesta
            $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
            $richiesta->setTitolo($campi['form']['titolo']);
            $richiesta->setDescrizione($campi['form']['descrizione']);

            foreach ($campi['form'] as $key => $value) {
                if (!strrpos($key, "-")) {
                    continue;
                }
                $a = explode('-', $key);
                $idCampo = $a[1];

//            $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

                $vcr = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->findOneBy(
                    array('idrichiesta' => $idRichiesta, 'id' => $idCampo)

                );
                if ($vcr != null) {
                    $vcr->setValore($value);
                }

            }

            //todo sistemare la tabella richiestautente
            $em->flush();

            return $this->redirect($this->generateUrl("richiesta_bycategoria", array("idCategoria" => $idCategoria)));

        }

        $factory = $this->get('sm.factory');
        $articleSM = $factory->get($richiesta, 'rda');
        $stato = $articleSM->getState();

        $formbuilder = $this->createFormBuilder();

        $formbuilder->setAction($this->generateUrl('sistematicaclient_index', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta, 'tipologia' => $tipologia)));
        $ClientSoapForm = $formbuilder->getForm();
        $ClientSoapForm->add('submit', 'submit', array('label' => ' invia in ESTAR', 'attr' => array('icon' => 'glyphicon glyphicon-plane')));

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('richiesta_delete', array('id' => $idRichiesta)));
        $deleteForm = $formbuilder->getForm();
        $deleteForm->add('submit_delete', 'submit', array('label' => ' Elimina', 'attr' => array('icon' => 'glyphicon glyphicon-remove')));

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_print', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta)));
        $printForm = $formbuilder->getForm();
        $printForm->add('submit', 'submit', array('label' => ' Stampa', 'attr' => array('icon' => 'glyphicon glyphicon-print')));


        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_back', array('idCategoria' => $idCategoria)));
        $backForm = $formbuilder->getForm();
        $backForm->add('back', 'submit', array('label' => ' Indietro', 'attr' => array('icon' => 'glyphicon glyphicon-arrow-left')));


        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);


//        TODO recupero ruolo utente e controllo se la richiesta pu� essere avanzata

//        $articleSM->can('a_transition_name');

        $possibili = $articleSM->getPossibleTransitions();

        $formbuilder = $this->createFormBuilder();

        $validaForms = array();
        foreach ($possibili as $key => $value) {

            $formbuilder->setAction($this->generateUrl('richiesta_valida', array('id' => $idRichiesta, 'transizione' => $value)));
            $validaForm = $formbuilder->getForm();
            //$formbuilder = $this->createFormBuilder();
            $validaForm->add("messaggio", "textarea", array(
                'label' => "Messaggio",
                'data' => "indicare motivazione di rigetto o validazione"
            ));
            $validaForm->add('submit', 'submit', array('label' => $value));
            //$MessaggioForm = $formbuilder->getForm();
            array_push($validaForms, $validaForm->createView());
        }
        $usercheckControl = $this->get('usercheck.notify');
        $dirittiucc = $usercheckControl->allRole($idCategoria);

        return $this->render('estarRdaBundle:FormTemplate:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'print_form' => $printForm->createView(),
            'valida_forms' => $validaForms,
            'soap_form' => $ClientSoapForm->createView(),
            'back_form' => $backForm->createView(),
            'diritti' => $dirittiucc,
            'stato' => $stato,
            'firstLevels' => $res[1]
        ));


    }

    public
    function printAction($idCategoria, $idRichiesta)
    {


        $em = $this->getDoctrine()->getManager();
        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);
        //FG il controllo dei campi è intenzionalmente tenuto fuori da ACL
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

//        $repository = $this->getDoctrine()
//            ->getRepository('estarRdaBundle:Campo');
//
//        $campi = $repository->findBy(
//            array('idcategoria' => $idCategoria),
//            array('ordinamento' => 'ASC')
//        );


//        $repository = $this->getDoctrine()
//            ->getRepository('estarRdaBundle:Valorizzazionecamporichiesta');
//
//        $campiValorizzati = $repository->findBy(
//            array('idrichiesta' => $idRichiesta)
//        );

        $formbuilder = $this->createFormBuilder();
//        $fieldsetVisitati = array();
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
//            $campo = $campovalorizzato->getIdcampo();
            $campo = $campovalorizzato;

            $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campo');
            $campoCheck = $repository->find($campo['idcampo']);
            if (!($diritti->campoVisualizzabile($diritti, $campoCheck))) continue;

//            if ($campo->getTipo() == 'choice') {
            if ($campo['tipo'] == 'choice') {
//                $fieldsetName = $campo->getFieldset();
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
//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
//        }

        $html = $this->renderView('::printbase.html.twig', array(
//            'entity' => $entity,
            'form' => $form->createView()
        ));


        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type' => 'application/pdf',
//                'Content-Disposition'   => 'attachment; filename="pippo.pdf"'
            )
        );
    }
}
<?php

namespace estar\rda\RdaBundle\Controller;


use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Form\FormTemplateType;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;


class FormTemplateController extends Controller
{


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


    /**
     * Displays a form to create a new FormTemplate entity.
     *
     */
    public function newAction($idCategoria)
    {
        //TODO fg aggiungere il passaggio alla form della obbligatoriet� o meno dei campi (manca! � tutto obbligatorio)


        $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campo');

        //FG20151027 modifica per i diritti: prendiamo i diritti
        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);

        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamento' => 'ASC')
        );

        $formbuilder = $this->createFormBuilder();
        $formbuilder->add("titolo", "text", array(
            'label' => "Titolo",
            'data' => "Specificare un oggetto per la propria richiesta"
        ));
        $formbuilder->add("descrizione", "textarea", array(
            'label' => "Descrizione",
            'data' => "indicare descrizione, azienda sanitaria e UOC destinataria"
        ));


        foreach ($campi as $campo) {
            //FG 20151027 modifica per campi visualizzabili a seconda dei diritti
            if (!($diritti->campoVisualizzabile($diritti, $campo))) continue;

            $obbligatorio = $campo->getObbligatorioinserzione();
            if ($campo->getTipo() == 'choice') {


//                $options = getChoicesOptions($campo->getFieldset());
                $options = $this->getChoicesOptions($campo->getFieldset());
                if ($obbligatorio) {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                        'choices' => $options,
                        'expanded' => true,
                        'multiple' => false,
                        'label' => $campo->getDescrizione(),
                        'constraints' => new NotBlank()
                    ));
                } else {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                        'choices' => $options,
                        'expanded' => true,
                        'multiple' => false,
                        'label' => $campo->getDescrizione()
                    ));
                }

            } else {
                if ($obbligatorio) {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                        'label' => $campo->getDescrizione(),
                        'constraints' => new NotNull()
                    ));
                } else {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                        'label' => $campo->getDescrizione(),
                    ));
                }
            }
        }

        $formbuilder->setAction($this->generateUrl('formtemplate_create', array('idCategoria' => $idCategoria)));
        $form = $formbuilder->getForm();

        $form->add('submit', 'submit', array('label' => 'Crea Nuova Richiesta'));
        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'form' => $form->createView()

        ));
    }


    public function createAction(Request $request, $idCategoria)
    {

        $form = $this->createForm(new FormTemplateType());
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();


        $campi = $request->request->all();

        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $richiesta = new Richiesta();
        $richiesta->setIdcategoria($categoria);
        $richiesta->setStatus('bozza');
        $richiesta->setTitolo($campi['form']['titolo']);
        $richiesta->setDescrizione($campi['form']['descrizione']);
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


    /**
     * Finds and displays a FormTemplate entity.
     * @param $idRichiesta
     * @param $idCategoria
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public
    function showAction($idCategoria, $idRichiesta)
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
        $query = $em->createQuery('SELECT c.id as idcampo, c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,vc.id,vc.valore
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
            if (!($this->campoVisualizzabile($diritti, $campoCheck))) continue;

//            if ($campo->getTipo() == 'choice') {
            if ($campo['tipo'] == 'choice') {
//                $fieldsetName = $campo->getFieldset();

                $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                    'label' => $campo['descrizione'],
                    'data' => $campo['valore'],
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

//    public
//    function showpdfAction($idCategoria, $idRichiesta)
//    {
//        require_once($this->get('kernel')->getRootDir() . '/config/dompdf_config.inc.php');
//
//        $dompdf = new \DOMPDF();
//        $htmlfinale = $this->showAction($idCategoria, $idRichiesta);
//
//        $dompdf->load_html($htmlfinale);
//        $dompdf->render();
//
//
//        return new Response($dompdf->output(), 200, array(
//            'Content-Type' => 'application/pdf'
//        ));
//    }

    /**
     * Displays a form to edit an existing Richiesta entity.
     *
     */
    public
    function editAction($idCategoria, $idRichiesta)
    {
        $em = $this->getDoctrine()->getManager();
        //FG20151028 modifica per i diritti: prendiamo i diritti
        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);
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
        $query = $em->createQuery('SELECT c.id as idcampo, c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,vc.id,vc.valore
                                    FROM estarRdaBundle:Campo c LEFT JOIN estarRdaBundle:Valorizzazionecamporichiesta vc
                                    WITH c.id = vc.idcampo
                                    AND vc.idrichiesta = :idRichiesta
                                    ORDER BY c.ordinamento')
            ->setparameter('idRichiesta', $idRichiesta);

        $campiValorizzati = $query->getResult();

        $formbuilder = $this->createFormBuilder();
        //FG 20151016 gestione dei campi della richiesta
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $formbuilder->add("titolo", "text", array(
            'label' => "Titolo",
            'data' => $richiesta->getTitolo()
        ));
        $formbuilder->add("descrizione", "textarea", array(
            'label' => "Descrizione",
            'data' => $richiesta->getDescrizione()
        ));
//        $fieldsetVisitati = array();

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
//                if (in_array($fieldsetName, $fieldsetVisitati)) {
//                    continue;
//                }

//                array_push($fieldsetVisitati, $fieldsetName);
//                $options = array();
//                foreach ($campi as $item) {
//                    if ($item->getTipo() == 'radio' and $item->getFieldset() == $fieldsetName)
//                        array_push($options, $item->getDescrizione());
//
//                }
                $options = $this->getChoicesOptions($campo['fieldset']);
                $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'choice', array(
                    'choices' => $options,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => $campo['descrizione'],
                    'data' => $campo['valore']
                ));
                $serializer = $this->get('serializer');
                $json = $serializer->serialize($options, 'json');
                dump($json);
            } else {

                $formbuilder->add($campo['nome'] . '-' . $campo['id'], $campo['tipo'], array(
                    'label' => $campo['descrizione'],
                    'data' => $campo['valore']
                ));
            }
        }


//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
//        }


        $formbuilder->setAction($this->generateUrl('formtemplate_update', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta)));

        $editForm = $formbuilder->getForm();
        $editForm->add('submit', 'submit', array('label' => 'Modifica'));

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('richiesta_delete', array('id' => $idRichiesta)));
        $deleteForm = $formbuilder->getForm();
        $deleteForm->add('submit', 'submit', array('label' => 'Elimina'));

        $formbuilder = $this->createFormBuilder();
        $formbuilder->setAction($this->generateUrl('formtemplate_print', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta)));
        $printForm = $formbuilder->getForm();
        $printForm->add('submit', 'submit', array('label' => 'Stampa'));

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);

        // Get the factory
        $factory = $this->get('sm.factory');

        // Get the state machine for this object, and graph called "simple"
        $articleSM = $factory->get($entity, 'rda');

//        TODO recupero ruolo utente e controllo se la richiesta pu� essere avanzata


//        $articleSM->can('a_transition_name');

        $possibili = $articleSM->getPossibleTransitions();

        $formbuilder = $this->createFormBuilder();

        $validaForms = array();
        foreach ($possibili as $key => $value) {

            $formbuilder->setAction($this->generateUrl('richiesta_valida', array('id' => $idRichiesta, 'transizione' => $value)));
            $validaForm = $formbuilder->getForm();
            $validaForm->add('submit', 'submit', array('label' => $value));
            array_push($validaForms, $validaForm->createView());
        }


        return $this->render('estarRdaBundle:FormTemplate:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'print_form' => $printForm->createView(),
            'valida_forms' => $validaForms,
        ));
    }

    public
    function updateAction(Request $request, $idCategoria, $idRichiesta)
    {

        $form = $this->createForm(new FormTemplateType());
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();


        $campi = $request->request->all();

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
                array('idrichiesta' => $idRichiesta, 'idcampo' => $idCampo)

            );
            if ($vcr != null) {
                $vcr->setValore($value);
            }

        }

        //todo sistemare la tabella richiestautente
        $em->flush();

        return $this->redirect($this->generateUrl("richiesta"));


    }

    public
    function printAction($idCategoria, $idRichiesta)
    {


        $em = $this->getDoctrine()->getManager();
        //FG il controllo dei campi è intenzionalmente tenuto fuori da ACL
        $query = $em->createQuery('SELECT c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,vc.id,vc.valore
                                    FROM estarRdaBundle:Campo c LEFT JOIN estarRdaBundle:Valorizzazionecamporichiesta vc
                                    WITH c.id = vc.idcampo
                                    AND vc.idrichiesta = :idRichiesta')
            ->setparameter('idRichiesta', $idRichiesta);
        $campiValorizzati = $query->getResult();
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
//            if ($campo->getTipo() == 'choice') {
            if ($campo['tipo'] == 'choice') {
//                $fieldsetName = $campo->getFieldset();

                $formbuilder->add($campo['nome'] . '-' . $campo['id'], 'text', array(
                    'label' => $campo['descrizione'],
                    'data' => $campo['valore'],
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
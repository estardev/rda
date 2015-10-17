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
//commento per commit
class FormTemplateController extends Controller
{


    /**
     * Displays a form to create a new FormTemplate entity.
     *
     */
    public function newAction($idCategoria)
    {
        //TODO fg aggiungere il passaggio alla form della obbligatorietà o meno dei campi (manca! è tutto obbligatorio)

//        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Campo');


        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamentofieldset' => 'ASC', 'ordinamento' => 'ASC')
        );




        $entity = new FormTemplate($idCategoria, $campi);

        $formbuilder = $this->createFormBuilder();
        $fieldsetVisitati = array();
        //FG 20151016 gestione dei campi della richiesta
        $formbuilder->add("titolo", "text", array(
            'label' => "Titolo",
            'data' => "Specificare un oggetto per la propria richiesta"
        ));
        $formbuilder->add("descrizione", "textarea", array(
            'label' => "Descrizione",
            'data' => "indicare descrizione, azienda sanitaria e UOC destinataria"
        ));

        foreach ($campi as $campo) {

            if ($campo->getTipo() == 'radio') {
                $fieldsetName = $campo->getFieldset();
                if (in_array($fieldsetName, $fieldsetVisitati)) {
                    continue;
                }

                array_push($fieldsetVisitati, $fieldsetName);
                $options = array();
                foreach ($campi as $item) {
                    if ($item->getTipo() == 'radio' and $item->getFieldset() == $fieldsetName)
                        array_push($options, $item->getDescrizione());

                }

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                    'choices' => $options,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => $fieldsetName
                ));
            } else {

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                    'label' => $campo->getDescrizione()
                ));
            }
        }

        $formbuilder->setAction($this->generateUrl('formtemplate_create', array('idCategoria' => $idCategoria)));
        $form = $formbuilder->getForm();

        $form->add('submit', 'submit', array('label' => 'Crea Nuova Richiesta'));
        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'entity' => $entity,
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
                //FG20151016 salto perchè i campi li ho già sistemati prima
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


        return $this->render('estarRdaBundle:FormTemplate:create.html.twig', array(
            'request' => $request
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


        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Campo');

        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamentofieldset' => 'ASC', 'ordinamento' => 'ASC')
        );

        $entity = new FormTemplate($idCategoria, $campi);

        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Valorizzazionecamporichiesta');

        $campiValorizzati = $repository->findBy(
            array('idrichiesta' => $idRichiesta)
        );

        $formbuilder = $this->createFormBuilder();
        $fieldsetVisitati = array();
        //FG 20151016 gestione dei campi della richiesta
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
            $campo = $campovalorizzato->getIdcampo();
            if ($campo->getTipo() == 'radio') {
                $fieldsetName = $campo->getFieldset();

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'text', array(
                    'label' => $fieldsetName,
                    'data' => $campo->getDescrizione(),
                    'read_only' => true
                ));
            } else {

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                    'label' => $campo->getDescrizione(),
                    'data' => $campovalorizzato->getValore(),
                    'read_only' => true
                ));
            }
        }
        $form = $formbuilder->getForm();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
        }

        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()

        ));
    }

    public function showpdfAction($idCategoria, $idRichiesta)
    {
        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');

        $dompdf = new \DOMPDF();
        $htmlfinale =  $this->showAction($idCategoria, $idRichiesta);

        $dompdf->load_html($htmlfinale);
        $dompdf->render();


        return new Response($dompdf->output(), 200, array(
            'Content-Type' => 'application/pdf'
        ));
    }
    /**
     * Displays a form to edit an existing Richiesta entity.
     *
     */
    public function editAction($idCategoria, $idRichiesta)
    {
        $em = $this->getDoctrine()->getManager();
        //TODO fg aggiungere il passaggio alla form della obbligatorietà o meno dei campi (manca! è tutto obbligatorio)
        //TODO FG verificare: se io aggiungo un campo a una categoria ed esiste già una richiesta di questa categoria, il campo non si vede
        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Campo');

        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamentofieldset' => 'ASC', 'ordinamento' => 'ASC')
        );

        $entity = new FormTemplate($idCategoria, $campi);

        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Valorizzazionecamporichiesta');

        $campiValorizzati = $repository->findBy(
            array('idrichiesta' => $idRichiesta)
        );

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
        $fieldsetVisitati = array();

        foreach ($campiValorizzati as $campovalorizzato) {
            $campo = $campovalorizzato->getIdcampo();
            if ($campo->getTipo() == 'radio') {
                $fieldsetName = $campo->getFieldset();
                if (in_array($fieldsetName, $fieldsetVisitati)) {
                    continue;
                }

                array_push($fieldsetVisitati, $fieldsetName);
                $options = array();
                foreach ($campi as $item) {
                    if ($item->getTipo() == 'radio' and $item->getFieldset() == $fieldsetName)
                        array_push($options, $item->getDescrizione());

                }

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                    'choices' => $options,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => $fieldsetName,
                    'data' => $campovalorizzato->getValore()
                ));
            } else {

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                    'label' => $campo->getDescrizione(),
                    'data' => $campovalorizzato->getValore()
                ));
            }
        }


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
        }


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

//        TODO recupero ruolo utente e controllo se la richiesta può essere avanzata


//        $articleSM->can('a_transition_name');

        $possibili = $articleSM->getPossibleTransitions();

        $formbuilder = $this->createFormBuilder();

        $validaForms=array();
        foreach ($possibili as $key=>$value) {

            $formbuilder->setAction($this->generateUrl('richiesta_valida', array('id' => $idRichiesta, 'transizione' => $value)));
            $validaForm = $formbuilder->getForm();
            $validaForm->add('submit', 'submit', array('label' => $value));
            array_push($validaForms,$validaForm->createView());
        }


        return $this->render('estarRdaBundle:FormTemplate:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'print_form' => $printForm->createView(),
            'valida_forms' => $validaForms,
        ));
    }

    public function updateAction(Request $request, $idCategoria, $idRichiesta)
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

            $vcr = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->findBy(
                array('idrichiesta' => $idRichiesta, 'idcampo' => $idCampo)

            );

            $vcr[0]->setValore($value);

        }

        //todo sistemare la tabella richiestautente
        $em->flush();

        return $this->redirect($this->generateUrl("richiesta"));


    }

    public function printAction($idCategoria, $idRichiesta)
    {


        $em = $this->getDoctrine()->getManager();

        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Campo');

        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamentofieldset' => 'ASC', 'ordinamento' => 'ASC')
        );

        $entity = new FormTemplate($idCategoria, $campi);

        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Valorizzazionecamporichiesta');

        $campiValorizzati = $repository->findBy(
            array('idrichiesta' => $idRichiesta)
        );

        $formbuilder = $this->createFormBuilder();
        $fieldsetVisitati = array();

        foreach ($campiValorizzati as $campovalorizzato) {
            $campo = $campovalorizzato->getIdcampo();
            if ($campo->getTipo() == 'radio') {
                $fieldsetName = $campo->getFieldset();

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'text', array(
                    'label' => $fieldsetName,
                    'data' => $campo->getDescrizione(),
                    'read_only' => true
                ));
            } else {

                $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                    'label' => $campo->getDescrizione(),
                    'data' => $campovalorizzato->getValore(),
                    'read_only' => true
                ));
            }
        }
        $form = $formbuilder->getForm();
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
        }

        $html = $this->renderView('estarRdaBundle:FormTemplate:new.html.twig', array(
            'entity' => $entity,
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
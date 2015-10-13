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

class FormTemplateController extends Controller
{


    /**
     * Displays a form to create a new FormTemplate entity.
     *
     */
    public function newAction($idCategoria)
    {


        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Campo');


        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamentofieldset' => 'ASC', 'ordinamento' => 'ASC')
        );


        $entity = new FormTemplate($idCategoria, $campi);

        $formbuilder = $this->createFormBuilder();
        $fieldsetVisitati = array();

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

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()

        ));
    }

    /**
     * Creates a form to create a FormTemplate entity.
     *
     * @param FormTemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FormTemplate $entity)
    {
        $form = $this->createForm(new FormTemplateType(), $entity, array(
            'action' => $this->generateUrl('formtemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }


    public function createAction(Request $request, $idCategoria)
    {

        $form = $this->createForm(new FormTemplateType());
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();


        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $richiesta = new Richiesta();
        $richiesta->setIdcategoria($categoria);
        $em->persist($richiesta);


        $campi = $request->request->all();


        foreach ($campi['form'] as $key => $value) {
            if (!strrpos($key, "-")) {
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


        return $this->render('estarRdaBundle:FormTemplate:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView()

        ));
    }

    public function updateAction(Request $request, $idCategoria, $idRichiesta)
    {

        $form = $this->createForm(new FormTemplateType());
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
//        $repository = $em->getRepository('estarRdaBundle:Richiesta');

//        $richiesta = $repository->find($idRichiesta);

        $campi = $request->request->all();


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

        $em->flush();


        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'request' => $request,


        ));

    }


}
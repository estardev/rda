<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Form\RichiestaType;

/**
 * Richiesta controller.
 *
 */
class RichiestaController extends Controller
{

    /**
     * Lists all Richiesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Richiesta')->findAll();

        return $this->render('estarRdaBundle:Richiesta:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Richiesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Richiesta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('richiesta_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Richiesta:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Richiesta entity.
     *
     * @param Richiesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Richiesta $entity)
    {
        $form = $this->createForm(new RichiestaType(), $entity, array(
            'action' => $this->generateUrl('richiesta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Richiesta entity.
     *
     */
    public function newAction()
    {
        $entity = new Richiesta();
        $form = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Richiesta:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Richiesta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Richiesta:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Richiesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Richiesta:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Richiesta entity.
     *
     * @param Richiesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Richiesta $entity)
    {
        $form = $this->createForm(new RichiestaType(), $entity, array(
            'action' => $this->generateUrl('richiesta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Richiesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('richiesta_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Richiesta:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Richiesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

//        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }


        $vcr = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->findby(
            array('idrichiesta' => $id)
        );

        foreach ($vcr as $item) {
            $em->remove($item);
        }
        $em->remove($entity);

        $em->flush();
//        }

        return $this->redirect($this->generateUrl('richiesta'));
    }

    /**
     * Creates a form to delete a Richiesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('richiesta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}

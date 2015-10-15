<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Categoriadocumento;
use estar\rda\RdaBundle\Form\CategoriadocumentoType;

/**
 * Categoriadocumento controller.
 *
 */
class CategoriadocumentoController extends Controller
{

    /**
     * Lists all Categoriadocumento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Categoriadocumento')->findAll();

        return $this->render('estarRdaBundle:Categoriadocumento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Categoriadocumento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Categoriadocumento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoriadocumento_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Categoriadocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categoriadocumento entity.
     *
     * @param Categoriadocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categoriadocumento $entity)
    {
        $form = $this->createForm(new CategoriadocumentoType(), $entity, array(
            'action' => $this->generateUrl('categoriadocumento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Categoriadocumento entity.
     *
     */
    public function newAction()
    {
        $entity = new Categoriadocumento();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Categoriadocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoriadocumento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoriadocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoriadocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Categoriadocumento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoriadocumento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoriadocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoriadocumento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Categoriadocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Categoriadocumento entity.
    *
    * @param Categoriadocumento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Categoriadocumento $entity)
    {
        $form = $this->createForm(new CategoriadocumentoType(), $entity, array(
            'action' => $this->generateUrl('categoriadocumento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Categoriadocumento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoriadocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoriadocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('categoriadocumento_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Categoriadocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Categoriadocumento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Categoriadocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categoriadocumento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoriadocumento'));
    }

    /**
     * Creates a form to delete a Categoriadocumento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoriadocumento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

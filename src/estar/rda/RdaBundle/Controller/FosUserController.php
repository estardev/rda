<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\FosUser;
use estar\rda\RdaBundle\Form\FosUserType;

/**
 * FosUser controller.
 *
 */
class FosUserController extends Controller
{

    /**
     * Lists all FosUser entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:FosUser')->findAll();

        return $this->render('estarRdaBundle:FosUser:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new FosUser entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new FosUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fosuser_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:FosUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a FosUser entity.
     *
     * @param FosUser $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FosUser $entity)
    {
        $form = $this->createForm(new FosUserType(), $entity, array(
            'action' => $this->generateUrl('fosuser_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new FosUser entity.
     *
     */
    public function newAction()
    {
        $entity = new FosUser();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:FosUser:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a FosUser entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:FosUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:FosUser:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing FosUser entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:FosUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:FosUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a FosUser entity.
    *
    * @param FosUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(FosUser $entity)
    {
        $form = $this->createForm(new FosUserType(), $entity, array(
            'action' => $this->generateUrl('fosuser_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing FosUser entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:FosUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find FosUser entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fosuser_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:FosUser:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a FosUser entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:FosUser')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find FosUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fosuser'));
    }

    /**
     * Creates a form to delete a FosUser entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fosuser_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

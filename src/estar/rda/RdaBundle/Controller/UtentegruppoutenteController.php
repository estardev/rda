<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Utentegruppoutente;
use estar\rda\RdaBundle\Form\UtentegruppoutenteType;

/**
 * Utentegruppoutente controller.
 *
 */
class UtentegruppoutenteController extends Controller
{

    /**
     * Lists all Utentegruppoutente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Utentegruppoutente')->findAll();

        return $this->render('estarRdaBundle:Utentegruppoutente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Utentegruppoutente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Utentegruppoutente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('utentegruppoutente_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Utentegruppoutente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Utentegruppoutente entity.
     *
     * @param Utentegruppoutente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Utentegruppoutente $entity)
    {
        $form = $this->createForm(new UtentegruppoutenteType(), $entity, array(
            'action' => $this->generateUrl('utentegruppoutente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Utentegruppoutente entity.
     *
     */
    public function newAction()
    {
        $entity = new Utentegruppoutente();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Utentegruppoutente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Utentegruppoutente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Utentegruppoutente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utentegruppoutente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Utentegruppoutente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Utentegruppoutente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Utentegruppoutente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utentegruppoutente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Utentegruppoutente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Utentegruppoutente entity.
    *
    * @param Utentegruppoutente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Utentegruppoutente $entity)
    {
        $form = $this->createForm(new UtentegruppoutenteType(), $entity, array(
            'action' => $this->generateUrl('utentegruppoutente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Utentegruppoutente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Utentegruppoutente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utentegruppoutente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('utentegruppoutente_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Utentegruppoutente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Utentegruppoutente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Utentegruppoutente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Utentegruppoutente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('utentegruppoutente'));
    }

    /**
     * Creates a form to delete a Utentegruppoutente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utentegruppoutente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Gruppoutente;
use estar\rda\RdaBundle\Form\GruppoutenteType;

/**
 * Gruppoutente controller.
 *
 */
class GruppoutenteController extends Controller
{

    /**
     * Lists all Gruppoutente entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Gruppoutente')->findAll();

        return $this->render('estarRdaBundle:Gruppoutente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Gruppoutente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Gruppoutente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('gruppoutente_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Gruppoutente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Gruppoutente entity.
     *
     * @param Gruppoutente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Gruppoutente $entity)
    {
        $form = $this->createForm(new GruppoutenteType(), $entity, array(
            'action' => $this->generateUrl('gruppoutente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Gruppoutente entity.
     *
     */
    public function newAction()
    {
        $entity = new Gruppoutente();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Gruppoutente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Gruppoutente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gruppoutente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Gruppoutente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Gruppoutente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gruppoutente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Gruppoutente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Gruppoutente entity.
    *
    * @param Gruppoutente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Gruppoutente $entity)
    {
        $form = $this->createForm(new GruppoutenteType(), $entity, array(
            'action' => $this->generateUrl('gruppoutente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Gruppoutente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Gruppoutente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('gruppoutente_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Gruppoutente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Gruppoutente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Gruppoutente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('gruppoutente'));
    }

    /**
     * Creates a form to delete a Gruppoutente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('gruppoutente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

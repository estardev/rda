<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Campodocumento;
use estar\rda\RdaBundle\Form\CampodocumentoType;

/**
 * Campodocumento controller.
 *
 */
class CampodocumentoController extends Controller
{

    /**
     * Lists all Campodocumento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Campodocumento')->findAll();

        return $this->render('estarRdaBundle:Campodocumento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Campodocumento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Campodocumento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('campodocumento_show', array('id' => $entity->getIdcampodocumento())));
        }

        return $this->render('estarRdaBundle:Campodocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Campodocumento entity.
     *
     * @param Campodocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Campodocumento $entity)
    {
        $form = $this->createForm(new CampodocumentoType(), $entity, array(
            'action' => $this->generateUrl('campodocumento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Campodocumento entity.
     *
     */
    public function newAction()
    {
        $entity = new Campodocumento();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Campodocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Campodocumento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Campodocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campodocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Campodocumento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Campodocumento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Campodocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campodocumento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Campodocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Campodocumento entity.
    *
    * @param Campodocumento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Campodocumento $entity)
    {
        $form = $this->createForm(new CampodocumentoType(), $entity, array(
            'action' => $this->generateUrl('campodocumento_update', array('id' => $entity->getIdcampodocumento())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Campodocumento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Campodocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campodocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('campodocumento_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Campodocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Campodocumento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Campodocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Campodocumento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campodocumento'));
    }

    /**
     * Creates a form to delete a Campodocumento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campodocumento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

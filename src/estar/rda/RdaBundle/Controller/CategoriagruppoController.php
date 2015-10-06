<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Categoriagruppo;
use estar\rda\RdaBundle\Form\CategoriagruppoType;

/**
 * Categoriagruppo controller.
 *
 */
class CategoriagruppoController extends Controller
{

    /**
     * Lists all Categoriagruppo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Categoriagruppo')->findAll();

        return $this->render('estarRdaBundle:Categoriagruppo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Categoriagruppo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Categoriagruppo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoriagruppo_show', array('id' => $entity->getIdcategoriagruppo())));
        }

        return $this->render('estarRdaBundle:Categoriagruppo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categoriagruppo entity.
     *
     * @param Categoriagruppo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categoriagruppo $entity)
    {
        $form = $this->createForm(new CategoriagruppoType(), $entity, array(
            'action' => $this->generateUrl('categoriagruppo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Categoriagruppo entity.
     *
     */
    public function newAction()
    {
        $entity = new Categoriagruppo();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Categoriagruppo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoriagruppo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoriagruppo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoriagruppo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Categoriagruppo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoriagruppo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoriagruppo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoriagruppo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Categoriagruppo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Categoriagruppo entity.
    *
    * @param Categoriagruppo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Categoriagruppo $entity)
    {
        $form = $this->createForm(new CategoriagruppoType(), $entity, array(
            'action' => $this->generateUrl('categoriagruppo_update', array('id' => $entity->getIdcategoriagruppo())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Categoriagruppo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoriagruppo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoriagruppo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('categoriagruppo_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Categoriagruppo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Categoriagruppo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Categoriagruppo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categoriagruppo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoriagruppo'));
    }

    /**
     * Creates a form to delete a Categoriagruppo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoriagruppo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

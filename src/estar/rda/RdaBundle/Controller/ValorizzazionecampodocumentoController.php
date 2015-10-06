<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Valorizzazionecampodocumento;
use estar\rda\RdaBundle\Form\ValorizzazionecampodocumentoType;

/**
 * Valorizzazionecampodocumento controller.
 *
 */
class ValorizzazionecampodocumentoController extends Controller
{

    /**
     * Lists all Valorizzazionecampodocumento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Valorizzazionecampodocumento')->findAll();

        return $this->render('estarRdaBundle:Valorizzazionecampodocumento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Valorizzazionecampodocumento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Valorizzazionecampodocumento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('valorizzazionecampodocumento_show', array('id' => $entity->getIdvalorizzazionecampodocumentocol())));
        }

        return $this->render('estarRdaBundle:Valorizzazionecampodocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Valorizzazionecampodocumento entity.
     *
     * @param Valorizzazionecampodocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Valorizzazionecampodocumento $entity)
    {
        $form = $this->createForm(new ValorizzazionecampodocumentoType(), $entity, array(
            'action' => $this->generateUrl('valorizzazionecampodocumento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Valorizzazionecampodocumento entity.
     *
     */
    public function newAction()
    {
        $entity = new Valorizzazionecampodocumento();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Valorizzazionecampodocumento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Valorizzazionecampodocumento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Valorizzazionecampodocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Valorizzazionecampodocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Valorizzazionecampodocumento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Valorizzazionecampodocumento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Valorizzazionecampodocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Valorizzazionecampodocumento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Valorizzazionecampodocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Valorizzazionecampodocumento entity.
    *
    * @param Valorizzazionecampodocumento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Valorizzazionecampodocumento $entity)
    {
        $form = $this->createForm(new ValorizzazionecampodocumentoType(), $entity, array(
            'action' => $this->generateUrl('valorizzazionecampodocumento_update', array('id' => $entity->getIdvalorizzazionecampodocumentocol())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Valorizzazionecampodocumento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Valorizzazionecampodocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Valorizzazionecampodocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('valorizzazionecampodocumento_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Valorizzazionecampodocumento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Valorizzazionecampodocumento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Valorizzazionecampodocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Valorizzazionecampodocumento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('valorizzazionecampodocumento'));
    }

    /**
     * Creates a form to delete a Valorizzazionecampodocumento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('valorizzazionecampodocumento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

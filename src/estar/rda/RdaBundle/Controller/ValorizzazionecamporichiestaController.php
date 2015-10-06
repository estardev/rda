<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use estar\rda\RdaBundle\Form\ValorizzazionecamporichiestaType;

/**
 * Valorizzazionecamporichiesta controller.
 *
 */
class ValorizzazionecamporichiestaController extends Controller
{

    /**
     * Lists all Valorizzazionecamporichiesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->findAll();

        return $this->render('estarRdaBundle:Valorizzazionecamporichiesta:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Valorizzazionecamporichiesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Valorizzazionecamporichiesta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('valorizzazionecamporichiesta_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Valorizzazionecamporichiesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Valorizzazionecamporichiesta entity.
     *
     * @param Valorizzazionecamporichiesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Valorizzazionecamporichiesta $entity)
    {
        $form = $this->createForm(new ValorizzazionecamporichiestaType(), $entity, array(
            'action' => $this->generateUrl('valorizzazionecamporichiesta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Valorizzazionecamporichiesta entity.
     *
     */
    public function newAction()
    {
        $entity = new Valorizzazionecamporichiesta();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Valorizzazionecamporichiesta:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Valorizzazionecamporichiesta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Valorizzazionecamporichiesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Valorizzazionecamporichiesta:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Valorizzazionecamporichiesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Valorizzazionecamporichiesta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Valorizzazionecamporichiesta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Valorizzazionecamporichiesta entity.
    *
    * @param Valorizzazionecamporichiesta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Valorizzazionecamporichiesta $entity)
    {
        $form = $this->createForm(new ValorizzazionecamporichiestaType(), $entity, array(
            'action' => $this->generateUrl('valorizzazionecamporichiesta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Valorizzazionecamporichiesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Valorizzazionecamporichiesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('valorizzazionecamporichiesta_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Valorizzazionecamporichiesta:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Valorizzazionecamporichiesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Valorizzazionecamporichiesta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('valorizzazionecamporichiesta'));
    }

    /**
     * Creates a form to delete a Valorizzazionecamporichiesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('valorizzazionecamporichiesta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

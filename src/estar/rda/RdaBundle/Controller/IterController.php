<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Form\IterType;

/**
 * Iter controller.
 *
 */
class IterController extends Controller
{

    /**
     * Lists all Iter entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Iter')->findAll();

        return $this->render('estarRdaBundle:Iter:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function iterByRichiestaAction()
    {
        $request = $this->get('request');
        $idRichiesta = $request->request->get('idrichiesta');

        $em = $this->getDoctrine()->getManager();
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $entities = $em->getRepository('estarRdaBundle:Iter')->findBy(
            array('idrichiesta' => $idRichiesta),
            array('dataora' => 'DESC')
            );
        //TODO: fare un filtro sui permessi dell'utente appena pronti
        //TODO: fare un filtro sui permessi dell'utente relativi agli stati
        //Sono tutti pulsanti che puntano a FormTemplateController
        return $this->render('estarRdaBundle:Richiesta:itertable.html.twig', array(
            'entities' => $entities,
            'richiesta' => $richiesta
        ));
    }

    public function iterByRichiestaGestavAction()
    {
        $request = $this->get('request');
        $idRichiesta = $request->request->get('idrichiesta');

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Iter')->findBy(array('idrichiesta' => $idRichiesta));
        //TODO: fare un filtro sui permessi dell'utente appena pronti
        //TODO: fare un filtro sui permessi dell'utente relativi agli stati
        //Sono tutti pulsanti che puntano a FormTemplateController
        return $this->render('estarRdaBundle:Richiesta:itertablegestav.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Creates a new Iter entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Iter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('iter_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Iter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Iter entity.
     *
     * @param Iter $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Iter $entity)
    {
        $form = $this->createForm(new IterType(), $entity, array(
            'action' => $this->generateUrl('iter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Iter entity.
     *
     */
    public function newAction()
    {
        $entity = new Iter();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Iter:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Iter entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Iter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Iter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Iter:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Iter entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Iter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Iter entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Iter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Iter entity.
    *
    * @param Iter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Iter $entity)
    {
        $form = $this->createForm(new IterType(), $entity, array(
            'action' => $this->generateUrl('iter_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Iter entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Iter')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Iter entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('iter_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Iter:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Iter entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Iter')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Iter entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('iter'));
    }

    /**
     * Creates a form to delete a Iter entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('iter_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

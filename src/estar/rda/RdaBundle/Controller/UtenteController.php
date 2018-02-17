<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Utente;
use estar\rda\RdaBundle\Form\UtenteType;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Utente controller.
 *
 */
class UtenteController extends Controller
{

    /**
     * Lists all Utente entities.
     *
     */
    public function indexAction()
    {   $entities= new ArrayCollection();
        $em = $this->getDoctrine()->getManager();

        $ent = $em->getRepository('estarRdaBundle:Utente')->findAll();
        //var_dump($entities);
        foreach($ent as $entity){
            if($entity->getNomecognome()=='Sistematica' or $entity->getNomecognome()=='Software Programmazione') continue;
            else $entities->add($entity);
        }
        return $this->render('estarRdaBundle:Utente:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Utente entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Utente();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('utente_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Utente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Utente entity.
     *
     * @param Utente $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Utente $entity)
    {
        $form = $this->createForm(new UtenteType(), $entity, array(
            'action' => $this->generateUrl('utente_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Utente entity.
     *
     */
    public function newAction()
    {
        $entity = new Utente();
        $form   = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Utente:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Utente entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Utente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Utente:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Utente entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Utente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utente entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Utente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Utente entity.
    *
    * @param Utente $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Utente $entity)
    {
        $form = $this->createForm(new UtenteType(), $entity, array(
            'action' => $this->generateUrl('utente_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Utente entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Utente')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Utente entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('utente_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Utente:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Utente entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Utente')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Utente entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('utente'));
    }

    /**
     * Creates a form to delete a Utente entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('utente_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

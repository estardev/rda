<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Form\CampoType;

/**
 * Campo controller.
 *
 */
class CampoController extends Controller
{

    /**
     * Lists all Campo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Campo')->findAll();

        return $this->render('estarRdaBundle:Campo:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Campo entity.
     *
     */
    public function createAction(Request $request, $idCategoria,$ordinamento)
    {
        $entity = new Campo();
        $form = $this->createCreateForm($entity,$idCategoria,$ordinamento);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setIdcategoria($em->getRepository('estarRdaBundle:Categoria')->find($idCategoria));
            $entity->setOrdinamento($ordinamento);
            if($entity->getFiglio()!=null){
                $entity->setFiglio();
            }
            //20160119 modifica per campi "orfani" generati in caso di figlio non presente
            if ($entity->nonHaFiglio()) $entity->setFiglio(null);
            $em->persist($entity);

            $em->flush();

            return $this->redirect($this->generateUrl('categoria_edit', array('id' => $idCategoria)));
        }

        return $this->render('estarRdaBundle:Campo:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Campo entity.
     *
     * @param Campo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Campo $entity, $idCategoria,$ordinamento)
    {
        $form = $this->createForm(new CampoType(), $entity, array(
            'action' => $this->generateUrl('campo_create',array('idCategoria'=>$idCategoria,'ordinamento'=>$ordinamento)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Campo entity.
     *
     */
    public function newAction($idCategoria,$ordinamento)
    {
        $entity = new Campo();
        $form = $this->createCreateForm($entity, $idCategoria,$ordinamento);

        return $this->render('estarRdaBundle:Campo:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Campo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Campo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Campo:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Campo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Campo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Campo:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Campo entity.
     *
     * @param Campo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Campo $entity)
    {
        $form = $this->createForm(new CampoType(), $entity, array(
            'action' => $this->generateUrl('campo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Campo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Campo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Campo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            //20160117 controllo se non ha figli
            if ($entity->nonHaFiglio()) $entity->setFiglio(null);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_edit', array('id' => $entity->getIdcategoria()->getId())));
        }

        return $this->redirect($this->generateUrl('categoria_edit', array('id' => $entity->getIdcategoria()->getId())));
    }

    /**
     * Deletes a Campo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Campo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Campo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('campo'));
    }

    /**
     * Creates a form to delete a Campo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('campo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }
}

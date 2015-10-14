<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Richiestadocumento;
use estar\rda\RdaBundle\Form\RichiestadocumentoType;

/**
 * Richiestadocumento controller.
 *
 */
class RichiestadocumentoController extends Controller
{

    /**
     * Lists all Richiestadocumento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Richiestadocumento')->findAll();

        return $this->render('estarRdaBundle:Richiestadocumento:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Richiestadocumento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Richiestadocumento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('richiestadocumento_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Richiestadocumento:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Richiestadocumento entity.
     *
     * @param Richiestadocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Richiestadocumento $entity)
    {
        $form = $this->createForm(new RichiestadocumentoType(), $entity, array(
            'action' => $this->generateUrl('richiestadocumento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Richiestadocumento entity.
     *
     */
    public function newAction()
    {
        $entity = new Richiestadocumento();
        $form = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Richiestadocumento:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Richiestadocumento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiestadocumento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiestadocumento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Richiestadocumento:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Richiestadocumento entity.
     *
     */
    public function editAction($id)
    {
        //TODO vanno sistemati i parametri
        //tira su il documento
        //tira su richiestaDocumento se esiste. Se esiste siamo in edit.
        //per ogni campodocumento
        // - crea un input come in formtemplatecontroller
        // - se siamo in edit, mostra i dati di valorizzazionecampodocumento
        //   che puntano a richiestadocumento e campodocumento
        //crea il pulsante per la submit verso updateAction

        //$em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('estarRdaBundle:Richiestadocumento')->find($id);

        //if (!$entity) {
        //    throw $this->createNotFoundException('Unable to find Richiestadocumento entity.');
        //}

        //$editForm = $this->createEditForm($entity);
        //$deleteForm = $this->createDeleteForm($id);

        //return $this->render('estarRdaBundle:Richiestadocumento:edit.html.twig', array(
        //    'entity'      => $entity,
        //    'edit_form'   => $editForm->createView(),
        //    'delete_form' => $deleteForm->createView(),
        //));
    }

    /**
     * Creates a form to edit a Richiestadocumento entity.
     *
     * @param Richiestadocumento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Richiestadocumento $entity)
    {
        $form = $this->createForm(new RichiestadocumentoType(), $entity, array(
            'action' => $this->generateUrl('richiestadocumento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Richiestadocumento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        //TODO sistemare i parametri
        //tirare su il documento e la richiesta
        //se non esiste una riga di richiestadocumento, crearla
        //per ogni riga di campodocumento
        // - se esiste una riga di valorizzazionecampodocumento
        //   che punta alla riga di richiestadocumento e campodocumento, fare update del valore ricevuto
        // - se non esiste, crearla
        // salvataggio
        //ritorno a documentoController.editByCategoria

        //$em = $this->getDoctrine()->getManager();

        //$entity = $em->getRepository('estarRdaBundle:Richiestadocumento')->find($id);

        //if (!$entity) {
        //    throw $this->createNotFoundException('Unable to find Richiestadocumento entity.');
        //}

        //$deleteForm = $this->createDeleteForm($id);
        //$editForm = $this->createEditForm($entity);
        //$editForm->handleRequest($request);

        //if ($editForm->isValid()) {
        //$em->flush();

        //return $this->redirect($this->generateUrl('richiestadocumento_edit', array('id' => $id)));
        //}

        return $this->render('estarRdaBundle:Richiestadocumento:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Richiestadocumento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Richiestadocumento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Richiestadocumento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('richiestadocumento'));
    }

    /**
     * Creates a form to delete a Richiestadocumento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('richiestadocumento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    //gestisce l'upload di un documento
    public function uploadForm($idCategoria, $idRichiesta, $idDocumento)
    {
        //form di upload del documento
        //transizione verso updateaction
    }

//    public function uploadAction($idCategoria, $idRichiesta, $idDocumento) {
    public function uploadAction(Request $request, $idRichiesta, $idDocumento)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //tira su la richiesta e il documento

//        if ($request->getMethod() == 'POST') {
            $doc = $request->files->get('docfile');
//        }
        $rd = new Richiestadocumento();
        $repository = $em->getRepository('estarRdaBundle:Richiesta');
        $richiesta=$repository->find($idRichiesta);
        $rd->setIdrichiesta($richiesta);
        $repository = $em->getRepository('estarRdaBundle:Documento');
        $documento=$repository->find($idDocumento);
        $rd->setIddocumento($documento);
        $rd->setdocFile($doc);
        $em->persist($rd);
        $em->flush();
        die;

        //crea una riga di richiestaDocumento collegata alla richiesta e al documento
        //mette il pathname nel campo filePath
        //persste
        //redirect verso documentoController.byCategoriaRichiesta
    }
}

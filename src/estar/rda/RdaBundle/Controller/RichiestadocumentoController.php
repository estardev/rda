<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Entity\Valorizzazionecampodocumento;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
    public function editAction($idCategoria, $idRichiesta, $idDocumento)
    {
        //TODO vanno sistemati i parametri
        //tira su il documento

        $mode = 'crea';

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('estarRdaBundle:Richiestadocumento');

        $entity = $repository->findOneBy(
            array('iddocumento' => $idDocumento, 'idrichiesta' => $idRichiesta)

        );
        $campiValorizzati = '';
        if ($entity != null) {
            $mode = 'modifica';
            $repository = $this->getDoctrine()
                ->getRepository('estarRdaBundle:Valorizzazionecampodocumento');

            $campiValorizzati = $repository->findBy(
                array('idrichiestadocumento' => $entity->getId())
            );

        } else {
            $repository = $this->getDoctrine()
                ->getRepository('estarRdaBundle:Campodocumento');

            $campiValorizzati = $repository->findBy(
                array('iddocumento' => $idDocumento)
            );
        }

        $formbuilder = $this->createFormBuilder();


        foreach ($campiValorizzati as $campovalorizzato) {
            if ($mode == 'modifica') {
                $campo = $campovalorizzato->getIdcampodocumento();
            } else {
                $campo = $campovalorizzato;
            }

            if ($campo->getTipo() == 'radio') {
                $fieldsetName = $campo->getFieldset();
                if ($mode == 'modifica') {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'text', array(
                        'label' => $fieldsetName,
                        'data' => $campo->getDescrizione(),
                    ));
                } else {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'text', array(
                        'label' => $fieldsetName,
                    ));
                }
            } else {
                if ($mode == 'modifica') {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                        'label' => $campo->getDescrizione(),
                        'data' => $campovalorizzato->getValore(),

                    ));
                } else {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                        'label' => $campo->getDescrizione(),

                    ));
                }
            }
        }

        $formbuilder->setAction($this->generateUrl('richiestadocumento_update', array('modo' => $mode, 'idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta, 'idDocumento' => $idDocumento)));


        $form = $formbuilder->getForm();
        $form->add('submit', 'submit', array('label' => 'Salva'));


        return $this->render('estarRdaBundle:Richiestadocumento:edit.html.twig', array(
            'form' => $form->createView()
        ));
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
    public function updateAction(Request $request, $modo, $idCategoria, $idRichiesta, $idDocumento)
    {


        $em = $this->getDoctrine()->getManager();


        $campi = $request->request->all();
        if ($modo == 'modifica') {
            $rd = $em->getRepository('estarRdaBundle:Richiestadocumento')->findOneBy(
                array('iddocumento' => $idDocumento, 'idrichiesta' => $idRichiesta));
        } else {

            $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
            $documento = $em->getRepository('estarRdaBundle:Documento')->find($idDocumento);
            $rd = new Richiestadocumento();
            $rd->setIdrichiesta($richiesta);
            $rd->setIddocumento($documento);
            $em->persist($rd);
        }
        foreach ($campi['form'] as $key => $value) {
            if (!strrpos($key, "-")) {
                continue;
            }
            $a = explode('-', $key);
            $idCampo = $a[1];

            $campo = $em->getRepository('estarRdaBundle:Campodocumento')->find($idCampo);


            if ($modo == 'modifica') {
                $vcd = $em->getRepository('estarRdaBundle:Valorizzazionecampodocumento')->findBy(
                    array('idrichiestadocumento' => $rd->getId(), 'idcampodocumento' => $idCampo)

                );

                $vcd[0]->setValore($value);
            } else {

                $vcd = new Valorizzazionecampodocumento();
                $vcd->setIdcampodocumento($campo);
                $vcd->setIdrichiestadocumento($rd);
                $vcd->setValore($value);
                $em->persist($vcd);

            }
        }

        $em->flush();

        return $this->redirect($this->generateUrl("documento_byCategoria", array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta, 'idDocumento' => $idDocumento)));

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


    public function uploadAction(Request $request, $idRichiesta, $idDocumento)
    {
        $em = $this->getDoctrine()->getEntityManager();
        //tira su la richiesta e il documento

//        if ($request->getMethod() == 'POST') {
        $doc = $request->files->get('docfile');
//        }

        $rd = new Richiestadocumento();
        $repository = $em->getRepository('estarRdaBundle:Richiesta');
        $richiesta = $repository->find($idRichiesta);
        $idCategoria = $richiesta->getIdcategoria()->getId();
        $rd->setIdrichiesta($richiesta);
        $repository = $em->getRepository('estarRdaBundle:Documento');
        $documento = $repository->find($idDocumento);
        $rd->setIddocumento($documento);
        $rd->setdocFile($doc);
//        $rd->setFilepath($doc->getClientOriginalName());
        $em->persist($rd);
        $em->flush();

//        $this->container->get('vich_uploader.storage')->upload($entity);
        return $this->redirect($this->generateUrl('documento_byCategoria', array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria)));
        //crea una riga di richiestaDocumento collegata alla richiesta e al documento
        //mette il pathname nel campo filePath
        //persste
        //redirect verso documentoController.byCategoriaRichiesta
    }
}

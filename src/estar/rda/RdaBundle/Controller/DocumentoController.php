<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Entity\Richiestadocumento;
use estar\rda\RdaBundle\Entity\Richiestadocumentolibero;
use estar\rda\RdaBundle\Form\DocumentoliberoType;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\NotNull;
use estar\rda\RdaBundle\Entity\Documento;
use estar\rda\RdaBundle\Form\DocumentoType;
use Vich\UploaderBundle\Handler\UploadHandler;
use Vich\UploaderBundle\Mapping\PropertyMapping;

/**
 * Documento controller.
 *
 */
class DocumentoController extends Controller
{

    /**
     * Lists all Documento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Documento')->findAll();

        //FG modificata per andare su tutt'altro twig
        return $this->render('estarRdaBundle:Documento:indexall.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Documento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Documento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documento_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Documento:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @param string $idRichiesta
     * @param string $idCategoria
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createLiberoAction(Request $request, $idRichiesta, $idCategoria)
    {
        $entity = new Richiestadocumentolibero();
        $form = $this->createCreateFormLibero($entity, $idRichiesta, $idCategoria);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('estarRdaBundle:Richiesta');
            $richiesta = $repository->find($idRichiesta);
            $entity->setIdrichiesta($richiesta);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('documento_liberoByRichiesta', array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria)));
        }

        return $this->render('estarRdaBundle:Documento:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteLiberoAction(Request $request)
    {
        $entity = $request->request->all();
        $documentoDaEliminare = $entity['idDocumento'];
        $idCategoria = $entity['idCategoria'];
        $em = $this->getDoctrine()->getManager();
        $documento = $em->getRepository('estarRdaBundle:Richiestadocumentolibero')->find($documentoDaEliminare);
        $nomeDocumento = $documento->getFilepath();
        $idRichiesta = $documento->getIdrichiesta();
        $controllo = $documento->isDainviare();

        if (!$controllo){
            //elimino riga e documento dal file sistem
           $em->remove($documento);
            $em->flush();
        return $this->redirect($this->generateUrl('documento_liberoByRichiesta', array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria)));
        }
        else{
            //il documento è già stato inviato
            $this->get('session')->getFlashBag()->add(
                'notice',
                array(
                    'alert' => 'success',
                    'title' => 'Success!',
                    'message' => "Il documento non può essere cancellato perchè è già stato inviato"
                )
            );
            return $this->redirect($this->generateUrl('documento_liberoByRichiesta', array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria)));

        }

        //        $entity =
//        $form = $this->createCreateFormLibero($entity, $idRichiesta, $idCategoria);
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//
//            $em = $this->getDoctrine()->getManager();
//            $repository = $em->getRepository('estarRdaBundle:Richiesta');
//            $richiesta = $repository->find($idRichiesta);
//            $entity->setIdrichiesta($richiesta);
//            $em->persist($entity);
//            $em->flush();
//
//            return $this->redirect($this->generateUrl('documento_liberoByRichiesta', array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria)));
//        }

        return $this->render('estarRdaBundle:Documento:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Documento $entity)
    {
        $form = $this->createForm(new DocumentoType(), $entity, array(
            'action' => $this->generateUrl('documento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crea'));

        return $form;
    }

    /**
     * Crea una form per aggiungere un documento libero
     * @param Documento $entity
     * @param string $idRichiesta
     * @param string $idCategoria
     * @return \Symfony\Component\Form\Form
     */
    private function createCreateFormLibero(Richiestadocumentolibero $entity, $idRichiesta, $idCategoria)
    {
        $form = $this->createForm(new DocumentoliberoType(), $entity, array(
            'action' => $this->generateUrl('documento_createlibero', array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria)),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array(
            'label' => ' Aggiungi nuovo Allegato',
            'attr' => array('icon' => 'glyphicon glyphicon-open')));

        return $form;
    }

    /**
     * Displays a form to create a new Documento entity.
     *
     */
    public function newAction()
    {
        $entity = new Documento();
        $form = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Documento:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Documento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('estarRdaBundle:Documento')->find($id);
        if (!is_null($entity->getPath())) {
            $request = $this->get('request');
            $path = $this->get('kernel')->getRootDir(). "/../web/prestampati/";
            $filename = $entity->getPath();
            $content = file_get_contents($path.$filename);

            $response = new Response();

            //set headers
            $response->headers->set('Content-Type', 'mime/type');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename);

            $response->setContent($content);
            return $response;
        } else {
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Documento entity.');
            }

            $deleteForm = $this->createDeleteForm($id);

            return $this->render('estarRdaBundle:Documento:show.html.twig', array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            ));
        }
    }

    /**
     * Displays a form to edit an existing Documento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Documento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Documento:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Documento entity.
     *
     * @param Documento $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Documento $entity)
    {
        $form = $this->createForm(new DocumentoType(), $entity, array(
            'action' => $this->generateUrl('documento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Documento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Documento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Documento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('documento_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Documento:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Documento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Documento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Documento entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('documento'));
    }

    /**
     * Creates a form to delete a Documento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Elimina'))
            ->getForm();
    }

    /**
     * Lists all Documento entities.
     *
     */
    public function indexByCategoriaRichiestaAction($idCategoria, $idRichiesta)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('estarRdaBundle:Categoriadocumento');
        $userCheck = $this->get("usercheck.notify");
        $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtente(); //array di oggetti DirittiRichiesta

        $richiestaRep = $em->getRepository('estarRdaBundle:Richiesta');
        $richiesta = $richiestaRep->find($idRichiesta);
        $statorichiesta = $richiesta->getStatus();
        $valida = false;
        foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
            if ($dirittoSingolo->getIsAI() AND $statorichiesta == 'bozza') {
                $valida = true;
            }
            if ($dirittoSingolo->getIsVt() AND $statorichiesta == 'attesa_val_tec') {
                $valida = true;
            }
            if ($dirittoSingolo->getIsVa() AND ($statorichiesta == 'attesa_val_amm' or $statorichiesta == 'da_inviare_ESTAR')) {
                $valida = true;
            }
        }

        $entities = $repository->findBy(
            array('idcategoria' => $idCategoria)
        );

        $documenti = array();
        foreach ($entities as $entity) {
            $documento = $entity->getIddocumento();

//            array_push($documenti, $documento);
            $documenti[$documento->getId()] = array(
                'documento' => $documento
            );

            //Per ogni riga di documento passare alla view:
            // - id di categoria_documento                                                  v
            // - nome e descrizione del documento                                           v


            $repo = $em->getRepository('estarRdaBundle:Campodocumento');

            $qb = $repo->createQueryBuilder('cd');
            $qb->select('COUNT(cd)');
            $qb->where('cd.iddocumento = :idDocumento');
            $qb->setParameter('idDocumento', $entity->getIddocumento()->getId());

            $count = $qb->getQuery()->getSingleScalarResult();

            $upload = ($count != 0) ? false : true;
            $documenti[$documento->getId()]['upload'] = $upload;
            // - se il documento HA righe di campidocumento, un pulsante "edit"

            // - se il documento NON HA righe di campidocumento, un pulsante "upload"

            $repo = $em->getRepository('estarRdaBundle:Richiestadocumento');

            $qb = $repo->createQueryBuilder('rd');
            $qb->select('COUNT(rd)');
            $qb->where('rd.iddocumento = :idDocumento');
            $qb->andWhere('rd.idrichiesta = :idRichiesta');
            $qb->setParameter('idDocumento', $entity->getIddocumento()->getId());
            $qb->setParameter('idRichiesta', $idRichiesta);
            $count = $qb->getQuery()->getSingleScalarResult();
            $rd = $repo->findOneBy(array('iddocumento' => $entity->getIddocumento()->getId(), 'idrichiesta' => $idRichiesta));
            if ($rd) {
                $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');
                $path = $helper->asset($rd, 'docFile');
                $documenti[$documento->getId()]['rd'] = ($count != 0) ? $rd : '';
            }
            // - se il documento NON ha righe di richiestadocumento un alert che il documento è mancante
            $alert = ($count != 0) ? false : true;
            $documenti[$documento->getId()]['alert'] = $alert;

        }
        foreach ($documenti as $documento) {
            //if (primocaso) metti pulsante upload che transiziona verso richiestadocumentocontroller.uploadform
            //if (secondocaso) metti pulsante edit che transiziona verso richiestadocumentocontroller.editaction
            //if (terzocaso) c'è da studiare qualcosa
        }
        //$file = $rd->getdocFile();


        return $this->render('estarRdaBundle:Documento:index.html.twig', array(
            'entities' => $documenti,
            'idRichiesta' => $idRichiesta,
            'idCategoria' => $idCategoria,
            'valida' => $valida
//            'rd' => $rd
        ));
    }


    /**
     * Mostra tutti i documenti "liberi" aggiunti alla richiesta
     * @param String $idRichiesta
     * @param string $idCategoria
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function liberoByRichiestaAction($idRichiesta, $idCategoria)
    {

        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository('estarRdaBundle:Richiesta');
        $richiesta = $repository->find($idRichiesta);

        $repository = $em->getRepository('estarRdaBundle:Richiestadocumentolibero');

        $userCheck = $this->get("usercheck.notify");
        $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtente(); //array di oggetti DirittiRichiesta

        $statorichiesta = $richiesta->getStatus();
        $valida = false;
        foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
            if ($dirittoSingolo->getIsAI() AND $statorichiesta == 'bozza') {
                $valida = true;
            }
            if ($dirittoSingolo->getIsVt() AND $statorichiesta == 'attesa_val_tec') {
                $valida = true;
            }
            if ($dirittoSingolo->getIsVa() AND ($statorichiesta == 'attesa_val_amm' or $statorichiesta == 'da_inviare_ESTAR')) {
                $valida = true;
            }
        }

        $entities = $repository->findBy(
            array('idrichiesta' => $idRichiesta)
        );

        $documenti = array();
        foreach ($entities as $entity) {
            $documento = $entity->getId();

//            array_push($documenti, $documento);
            $documenti[$documento] = array(
                'documento' => $documento
            );

            //Per ogni riga di documento passare alla view:
            // - id di categoria_documento                                                  v
            // - nome e descrizione del documento                                           v

            //FG 20160307 il documento è sempre "riuploadabile"
            $documenti[$documento]['upload'] = true;
            //FG 20160307 non è mai "mancante".
            $documenti[$documento]['alert'] = false;
            //$documenti[$documento->getId()]['path'] = $path;
        }
        foreach ($documenti as $documento) {
            //if (primocaso) metti pulsante upload che transiziona verso richiestadocumentocontroller.uploadform
            //if (secondocaso) metti pulsante edit che transiziona verso richiestadocumentocontroller.editaction
            //if (terzocaso) c'è da studiare qualcosa
        }
        //Ne aggiungiamo sempre uno in più
        $rdl = new Richiestadocumentolibero();
        $rdl->setIdrichiesta($richiesta);
        $form = $this->createCreateFormLibero($rdl, $idRichiesta, $idCategoria);
        //$file = $rd->getdocFile();
        return $this->render('estarRdaBundle:Documento:indexlibero.html.twig', array(
            'entities' => $entities,
            'idRichiesta' => $idRichiesta,
            'idCategoria' => $idCategoria,
            'create_form' => $form->createView(),
            'valida' => $valida,
            'rdl' => $rdl
        ));
    }

}

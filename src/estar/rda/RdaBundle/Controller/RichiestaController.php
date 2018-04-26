<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Form\RichiestaType;
use estar\rda\RdaBundle\Model\DirittiRichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Richiesta controller.
 *
 */
class RichiestaController extends Controller
{

    /**
     * Lists all Richiesta entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
        //TODO: creare pulsanti per l'edit, la gestione dei documenti e la stampa in PDF
        //Sono tutti pulsanti che puntano a FormTemplateController
        return $this->render('estarRdaBundle:Richiesta:indexAll.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function viewAllAction($all)
    {

        $em = $this->getDoctrine()->getManager();
        $utente = $this->get('usercheck.notify')->getIdUtente();

        $query1 = $em->createQuery("SELECT r
                                     FROM estarRdaBundle:Richiesta r, estarRdaBundle:Iter i
                                     WHERE  i.idutente=$utente
                                     AND r.id = i.idrichiesta
                                     AND r.proid is null
                                     ");
        $entities = $query1->getResult();

        //TODO: creare pulsanti per l'edit, la gestione dei documenti e la stampa in PDF
        //Sono tutti pulsanti che puntano a FormTemplateController
        return $this->render('estarRdaBundle:Richiesta:indexViewAll.html.twig', array(
            'entities' => $entities,
        ));
    }

    public function aggregateAction($all)
    {

        $em = $this->getDoctrine()->getManager();
        $utente = $this->get('usercheck.notify')->getUtente();
        $aziendaUtente = $utente->getIdAzienda();

        $query1 = $em->createQuery("SELECT r
                                     FROM estarRdaBundle:Richiesta r, estarRdaBundle:Iter i, estarRdaBundle:Richiestaaggregazione ra
                                     WHERE r.id = i.idrichiesta
                                     AND r.id = ra.idrichiesta
                                     AND ra.idazienda = $aziendaUtente
                                     AND r.status != 'bozza'
                                     ");
        $entities = $query1->getResult();

        //TODO: creare pulsanti per l'edit, la gestione dei documenti e la stampa in PDF
        //Sono tutti pulsanti che puntano a FormTemplateController
        return $this->render('estarRdaBundle:Richiesta:aggregateAll.html.twig', array(
            'entities' => $entities,
            'azienda' => $aziendaUtente
        ));
    }

    public function globaleAction($all)
    {
        $utenteSessione = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $richieste = new ArrayCollection(); //= $em->getRepository('estarRdaBundle:Richiesta')->findAll();

        $user = $this->getUser();
        $idUtenteSessione = $user->getId();
        $aziendaUtente = trim($user->getIdazienda()->getNome());
        $idAziendaUtente = $user->getIdazienda()->getId();
        $userCheck = $this->get("usercheck.notify");

        /*
         * mi viene restituita per ogni categoria che l'utente è abilitato a vedere le sue abilitazioni
         * di AI - inseritore
         * di VA - validatore Amministrativo
         * di VT - validatore Tecnico
         *
         * in base a queste devo prendere le richieste.
         */

        $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtente();
        //dump($dirittiTotaliRadicaliGlobbali);//array di oggetti DirittiRichiesta
        /* @var $dirittoSingolo DirittiRichiesta */
        foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
            $idCategoria = $dirittoSingolo->getCategoria()->getId();
            if ($dirittoSingolo->getIsAI()) {
                //Abilitato all'inserimento. Se ESTAR, le vede tutte. Se non è ESTAR, vede solo quelle della sua azienda
                //filtrare in base al tipo di azienda
                if ($aziendaUtente == 'ESTAR') {
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE   r.status='bozza' 
                                    AND r.idutente=$utenteSessione 
                                    AND r.idcategoria=$idCategoria
                                    AND r.proid is null
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue

                } else{
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  r.idutente=$utenteSessione 
                                    AND r.status='bozza' 
                                    AND r.idcategoria = $idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    AND r.proid is null
                                    ");
                }

                foreach ($query->getResult() as $richiesta) {
                    $richieste->add(array($richiesta,'AI'));
                }

            }
            if ($dirittoSingolo->getIsVt()) {
                //Validatore tecnico. Se è ESTAR, vede tutte quelle in attesa di validazione tecnica. Se non è ESTAR, vede solo quelle della sua azienda
                if ($aziendaUtente == 'ESTAR')
                    $query1 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  r.status='attesa_val_tec' 
                                    AND r.idcategoria=$idCategoria
                                    AND r.proid is null
                                    ");
                else
                    $query1 = $em->createQuery("SELECT r
                                     FROM estarRdaBundle:Richiesta r
                                     WHERE  r.status='attesa_val_tec' 
                                     AND r.idcategoria=$idCategoria 
                                     AND r.idazienda=$idAziendaUtente
                                     AND r.proid is null
                                     ");
                foreach ($query1->getResult() as $richiesta1) {
                    $richieste->add(array($richiesta1,'VT'));
                }

            }
            if ($dirittoSingolo->getIsVa()) {
                //Validatore amministrativo. Estar = vede tutte quelle in attesa. Altro utente? vede solo le sue.
                if ($aziendaUtente == 'ESTAR')
                    $query2 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  (r.status='attesa_val_amm' 
                                    OR r.status='da_inviare_ESTAR' 
                                    OR r.status='inviata_ESTAR') 
                                    AND r.idcategoria=$idCategoria
                                    AND r.proid is null
                                    ");
                else
                    $query2 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  (r.status='attesa_val_amm'
                                    OR r.status='da_inviare_ESTAR' 
                                    OR r.status='inviata_ESTAR') 
                                    AND r.idcategoria=$idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    AND r.proid is null
                                    ");
                foreach ($query2->getResult() as $richiesta2) {
                    $richieste->add(array($richiesta2,'VA'));
                }

            }
            if ($dirittoSingolo->isRead()) {
                //Abilitato alla lettura. Se ESTAR, le vede tutte. Se non è ESTAR, vede solo quelle della sua azienda
                //filtrare in base al tipo di azienda
                if ($aziendaUtente == 'ESTAR') {
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  r.idcategoria=$idCategoria
                                    AND r.proid is null
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue

                } else {
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE r.idcategoria = $idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    AND r.proid is null
                                    ");
                }

                foreach ($query->getResult() as $richiesta3) {
                    $richieste->add(array($richiesta3,'READ'));
                }

            }

            if ($aziendaUtente == 'ESTAR'){
                //prendo anche quelle chiuse per categoria che posso vedere
                $query3 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE   (r.status = 'chiusa_ESTAR'
                                    OR r.status = 'annullata')
                                    AND r.proid is null
                                    AND r.idcategoria=$idCategoria");
            }
            else{
                //prendo anche quelle chiuse per categoria che posso vedere
                $query3 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE   (r.status = 'chiusa_ESTAR'
                                    OR r.status = 'annullata')
                                    AND r.idcategoria=$idCategoria
                                    AND r.proid is null
                                    AND r.idazienda=$idAziendaUtente");
            }
            foreach ($query3->getResult() as $richiesta4) {
                $richieste->add(array($richiesta4,''));
            }

        }

//        var_dump($richieste);

        return $this->render('estarRdaBundle:HomePage:indexAll.html.twig', array(
            'entities' => $richieste));


    }

    /**
     *
     * Trova tutte le richieste filtrando per categoria (e utente da sessione)
     *
     * @author Francesco Galli - francesco01.galli@star.toscana.it
     * @param $idCategoria
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexByCategoriaAction($idCategoria)
    {
        $em = $this->getDoctrine()->getManager();
        $logger = $this->get('accessi_logger');
        $logger->log('Utente '.$this->getUser()->getId().' richiede le richieste per la categoria '.$idCategoria);
        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);

        //$entities = $em->getRepository('estarRdaBundle:Richiesta')->findBy(array('idcategoria' => $idCategoria));
        $richieste = $this->get('model.richiesta')->getRichiesteByUser($idCategoria, $diritti);
        //TODO: fare un filtro sui permessi dell'utente appena pronti
        //TODO: fare un filtro sui permessi dell'utente relativi agli stati
        //Sono tutti pulsanti che puntano a FormTemplateController
        return $this->render('estarRdaBundle:Richiesta:index.html.twig', array(
            'entities' => $richieste,
            'diritti' => $diritti
        ));
    }

    /**
     * Creates a new Richiesta entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Richiesta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('richiesta_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Richiesta:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Richiesta entity.
     *
     * @param Richiesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Richiesta $entity)
    {
        $form = $this->createForm(new RichiestaType(), $entity, array(
            'action' => $this->generateUrl('richiesta_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Richiesta entity.
     *
     */
    public function newAction()
    {
        $entity = new Richiesta();
        $form = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Richiesta:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Richiesta entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Richiesta:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Richiesta entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Richiesta:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Creates a form to edit a Richiesta entity.
     *
     * @param Richiesta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Richiesta $entity)
    {
        $form = $this->createForm(new RichiestaType(), $entity, array(
            'action' => $this->generateUrl('richiesta_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Richiesta entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('richiesta_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Richiesta:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Richiesta entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

//        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);
        $idCa = $entity->getIdcategoria()->getId();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }
        //FGDO 20160310 modifica per cancellazione logica

        $factory = $this->container->get('sm.factory');
        $articleSM = $factory->get($entity, 'rda');

        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataIter = $dateTime->format(\DateTime::ATOM);

        $iter = new Iter();
        $iter->setDastato($articleSM->getState());
        $articleSM->apply('cancellazione');
        $iter->setAstato($articleSM->getState());
        $iter->setDastatogestav($entity->getStatusgestav());
        $iter->setAstatogestav($entity->getStatusgestav());
        $iter->setIdrichiesta($entity);
        $iter->setMotivazione('richiesta cancellata');
        $iter->setDataora(new \DateTime('now'));
        $iter->setIdutente($this->getUser());
        $iter->setDatafornita(false);
        $em->persist($iter);
        $em->flush();
//        }

        return $this->redirect($this->generateUrl('richiesta_bycategoria', array('idCategoria' => $idCa)));
    }


    //TODO Parte integrata nel caso di "Annullamento" della richiesta tramite invocazione di webservice

    /**
     * Annulla una richiesta
     * @param Request $request
     * @param string $id idrichiesta
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \SM\SMException
     */
    public function annullaAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

//        if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Richiesta entity.');
        }
        //FGDO 20160310 modifica per cancellazione logica

        $factory = $this->container->get('sm.factory');
        $articleSM = $factory->get($entity, 'rda');

        $iter = new Iter();
        $iter->setDastato($articleSM->getState());
        $articleSM->apply('annullamento');
        $iter->setAstato($articleSM->getState());
        $iter->setDastatogestav($entity->getStatusgestav());
        $iter->setAstatogestav($entity->getStatusgestav());
        $iter->setIdrichiesta($entity);
        $iter->setMotivazione('richiesta cancellata');
        $iter->setDataora(new \DateTime('now'));
        $iter->setIdutente($this->getUser());
        $iter->setDatafornita(false);
        $em->persist($iter);
        $em->flush();

        //TODO inserire il codice per l'invocazione al webservice di annullamento -

        return $this->redirect($this->generateUrl('richiesta'));
    }

    /**
     * Creates a form to delete a Richiesta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('richiesta_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }


    /**
     * Valida una richiesta in base al ruolo dell'utente
     *
     * @param String $id Id della richiesta
     * @param String $transizione la transizione
     * @param Request $request la request su cui si lavora
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function validaAction($id, $transizione, Request $request)
    {

        $campi = $request->request->all();
        $messaggio = $campi['form']['messaggio'];

        $em = $this->getDoctrine()->getManager();

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($id);
        $idcategoria = $richiesta->getIdcategoria();

        // Get the factory
        $factory = $this->get('sm.factory');

        // Get the state machine for this object, and graph called "simple"
        $articleSM = $factory->get($richiesta, 'rda');
        $utente = $this->get('usercheck.notify')->getUtente();
        $iter = new Iter();

        /**    switch($transizione)
         * {
         * case 'presentata': $pre=1; break;
         * case 'rifiutata_tec': $pre=2; break;
         * case 'validazione_tec': $pre=3; break;
         * case 'rifiutata_amm': $pre=4; break;
         * case 'validazione_amm': $pre=5; break;
         * case 'inviato_ESTAR': $pre=6; break;
         * case 'cancellazione': $pre=7; break;
         * case 'annullamento': $pre=8; break;
         * case 'rifiutata_amm_ESTAR': $pre=9; break;
         * case 'rifiutata_tec_ESTAR': $pre=10; break;
         * case 'rigettata_ESTAR': $pre=11; break;
         * case 'chiusura_ESTAR': $pre=12; break;
         * case 'attesa_doc_aggiuntiva': $pre=14; break;
         * case 'attesa_doc_aggiuntiva_RUP': $pre=15; break;
         * case 'assegnata_programmazione': $pre=16; break;
         * case 'istruttoria': $pre=17; break;
         * case 'indizione': $pre=18; break;
         * case 'valutazione': $pre=19; break;
         * case 'aggiudicazione': $pre=20; break;
         * case 'annullamento_ESTAR': $pre=21; break;
         * default: $pre=99; break;
         * }
         **/
        //        TODO recupero ruolo utente


        if ($articleSM->can($transizione)) {
            $iter->setDastato($articleSM->getState());
            $articleSM->apply($transizione);
            $iter->setAstato($articleSM->getState());
            $iter->setIdrichiesta($richiesta);
            $iter->setIdutente($utente);
            $iter->setMotivazione($messaggio);
            $iter->setDataora(new \DateTime('now'));
            $iter->setDatafornita(true);
            $em->persist($iter);
        }

        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'notice',
            array(
                'alert' => 'info',
                'title' => 'Informazione!',
                'message' => 'Passato nello stato ' . $richiesta->getStatus() . ' con la motivazione: "' . $messaggio . '".'
            )
        );


        return $this->redirect($this->generateUrl("richiesta_bycategoria", array('idCategoria' => $idcategoria)));
    }


}

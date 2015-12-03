<?php
/**
 * Created by PhpStorm.
 * User: francesco.galli
 * Date: 25/11/2015
 * Time: 16.04
 */

namespace estar\rda\RdaBundle\Controller;


use estar\rda\RdaBundle\Entity\Utentegruppoutente;
use FOS\UserBundle\Tests\Form\Type\ProfileFormTypeTest;
use Proxies\__CG__\estar\rda\RdaBundle\Entity\Gruppoutente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Utente;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as RegistrationParentController;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Controller\ProfileController;

class ProfileExtendedController extends ProfileController
{

    /**
     * Sovrascrittura della edit action del controller
     * @param Request $request
     * @return null|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');
        $campiRequest = $request->request->all();
        //FG qui
        $user = $userManager->createUser();
        //FG mi pesco l'utente vero e proprio
        $em = $this->getDoctrine()->getManager();
        $utente = $em->getRepository('estar\rda\RdaBundle\Entity\Utente')->find($campiRequest['fos_user_profile_edit']['idUtente']);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        // 1) build the form
        $form = $formFactory->createForm();
        $form->setData($utente);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

            //FG qui
            $userManager->updateUser($user);

            //** Parte aggiunta INIT */

            $em = $this->getDoctrine()->getManager();

            $fosuserid = $user->getId();
            $fosuser = $em->getRepository('estarRdaBundle:FosUser')->find($fosuserid);

            $utente = new Utente();
            $utente->setIdazienda($user->getIdazienda());
            $utente->setIdfosuser($fosuser);
            $utente->setNomecognome($user->getNomecognome());
            $utente->setUtentecartaoperatore($user->getCodicefiscale());
            $em->persist($utente);

            //FG 20151202 dichiarazione di campirequest spostata pi� in su

            $gruppiutenteRequest = $campiRequest['fos_user_profile_edit']['gruppiutente'];
            $amministratoriRequest = $campiRequest['amministratoriCheckboxInput'];

            foreach ($gruppiutenteRequest as $gruppoutenteRequest){
                $utentegruppoutente = new Utentegruppoutente();
                $utentegruppoutente->setIdutente($utente);
                $utentegruppoutenteEntity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($gruppoutenteRequest);
                $utentegruppoutente->setIdgruppoutente($utentegruppoutenteEntity);
                if ($amministratoriRequest){
                    foreach ($amministratoriRequest as $amministratoreRequest){
                        if ($amministratoreRequest == $gruppoutenteRequest){
                            $utentegruppoutente->setAmministratore(true);
                        }
                    }
                }
                $em->persist($utentegruppoutente);
            }


            //** Parte aggiunta END */

            if (null === $response = $event->getResponse()) {
                //** Parte aggiunta INIT */
                $em->flush();
                //** Parte aggiunta END */
                $url = $this->generateUrl('fos_user_registration_confirmed');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Sovrascrittura della edit action del controller
     * @param Request $request
     * @return null|\Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editUserAction(Request $request, $idUtente)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        //FG qui
        $user = $userManager->createUser();
        //FG mi pesco l'utente vero e proprio
        $em = $this->getDoctrine()->getManager();
        $utente = $em->getRepository('estar\rda\RdaBundle\Entity\Utente')->find($idUtente);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        // 1) build the form
        //$form = $formFactory->createForm();
        //FG non c'� verso di farlo funzionare con la form estesa per un motivo: non abbiamo esteso la classe
        //di fos user con la nostra ma siamo andati in affiancamento. Questo mi rende impossibile usare il meccanismo
        //di base per cui riscrivo tutto.
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add("nomecognome", "text", array(
            'label' => "Nome e Cognome",
            'data' => $utente->getNomecognome()
        ));
        $formBuilder->add("utentecartaoperatore", "text", array(
            'label' => "Codice fiscale carta operatore",
            'data' => $utente->getUtentecartaoperatore()
        ));

        $formBuilder->add('idazienda', 'entity', array(
            'class' => 'estar\rda\RdaBundle\Entity\Azienda',
            'choice_label' => 'nome',
            'label' => 'Azienda',
            'data' => $utente->getIdazienda()
        ));

        // Creiamo l'array di gruppi a cui � collegato l'utente
        $gruppi = $em->getRepository('estar\rda\RdaBundle\Entity\Utentegruppoutente')->findBy(array('idutente' => $utente->getId()));
        $dati = array();
        foreach ($gruppi as $gruppo) array_push($dati, $gruppo->getIdgruppoutente());
        $formBuilder->add('gruppiutente', 'entity', array(
            'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
            'property' => 'nome',
            'multiple' => true,
            'expanded' => true,
            'attr' => array('class'=>'gruppiutenteCheckbox'),
            'label' => 'Gruppi Utente',
            'data' => $dati
        ));
        $formBuilder->setAction($this->generateUrl('updateUser', array('idUtente' => $idUtente)));
        $formBuilder->add('submit', 'submit', array('label' => 'Aggiorna'));
        $edit_form = $formBuilder->getForm();

        //$form->setData($utente);

        // 2) handle the submit (will only happen on POST)
        //FG ho dovuto commentare
        //$form->handleRequest($request);
        return $this->render('FOSUserBundle:Profile:editother.html.twig', array(
            'editform' => $edit_form->createView()
        ));

   }


    public function updateUserAction(Request $request, $idUtente) {

        //Ci peschiamo l'utente
        $em = $this->getDoctrine()->getManager();
        $utente = $em->getRepository('estar\rda\RdaBundle\Entity\Utente')->find($idUtente);

        //Vediamo che c'� arrivato
        $campiRequest = $request->request->all();
        $utente->setNomecognome($campiRequest['form']['nomecognome']);
        $utente->setUtentecartaoperatore($campiRequest['form']['utentecartaoperatore']);
        $utente->setIdazienda($em->getRepository('estarRdaBundle:Azienda')->find($campiRequest['form']['idazienda']));

        //$gruppiutenteRequest = $campiRequest['form']['gruppiutente'];
        //$amministratoriRequest = $campiRequest['amministratoriCheckboxInput'];
        $gruppiutenteRequest = null;
        $amministratoriRequest = null;
        if (false) {
            foreach ($gruppiutenteRequest as $gruppoutenteRequest) {
                $utentegruppoutente = new Utentegruppoutente();
                $utentegruppoutente->setIdutente($utente);
                $utentegruppoutenteEntity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($gruppoutenteRequest);
                $utentegruppoutente->setIdgruppoutente($utentegruppoutenteEntity);
                if ($amministratoriRequest) {
                    foreach ($amministratoriRequest as $amministratoreRequest) {
                        if ($amministratoreRequest == $gruppoutenteRequest) {
                            $utentegruppoutente->setAmministratore(true);
                        }
                    }
                }
                $em->persist($utentegruppoutente);
            }
        }

            //** Parte aggiunta END */
            $em->flush();
            $url = $this->generateUrl('utente');
            return $this->redirect($url);



    }
}
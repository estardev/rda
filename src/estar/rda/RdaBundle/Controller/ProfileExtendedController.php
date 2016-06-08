<?php
/**
 * Created by PhpStorm.
 * User: francesco.galli
 * Date: 25/11/2015
 * Time: 16.04
 */

namespace estar\rda\RdaBundle\Controller;


use estar\rda\RdaBundle\Entity\Utentegruppoutente;
use estar\rda\RdaBundle\Form\UtenteType;
use FOS\UserBundle\Tests\Form\Type\ProfileFormTypeTest;
use Proxies\__CG__\estar\rda\RdaBundle\Entity\Gruppoutente;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
use estar\rda\RdaBundle\Form\ProfileType;


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

//    public function editUserAction(Request $request, $idUtente)
//    {
//        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
//        $formFactory = $this->get('fos_user.registration.form.factory');
//        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
//        $userManager = $this->get('fos_user.user_manager');
//        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
//        $dispatcher = $this->get('event_dispatcher');
//
//        $em = $this->getDoctrine()->getManager();
//        $user = $em->getRepository('estar\rda\RdaBundle\Entity\Utente')->find($idUtente);
//        $gruppoutente = $em->getRepository('estar\rda\RdaBundle\Entity\Utentegruppoutente')->findBy(array('idutente' => $idUtente));
//        //$user = $userManager->createUser()
//        $user->setEnabled(true);
//
//        $event = new GetResponseUserEvent($user, $request);
//        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);
//
//        if (null !== $event->getResponse()) {
//            return $event->getResponse();
//        }
//        // 1) build the form
//        $form = $formFactory->createForm();
//        $form->setData($user);
//        //$form->add('submit', 'submit', array('label' => 'Aggiorna'));
//
//        // 2) handle the submit (will only happen on POST)
//        $form->handleRequest($request);
//
//        if ($form->isValid()) {
//            $event = new FormEvent($form, $request);
//            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
//
//            $userManager->updateUser($user);
//
//            //** Parte aggiunta INIT */
//
//            $em = $this->getDoctrine()->getManager();
//
//            // FG 20160202 commentata grazie al refactoring
//            /*
//            $fosuserid = $user->getId();
//            $fosuser = $em->getRepository('estarRdaBundle:FosUser')->find($fosuserid);
//
//            $utente = new Utente();
//            $utente->setIdazienda($user->getIdazienda());
//            $utente->setIdfosuser($fosuser);
//            $utente->setNomecognome($user->getNomecognome());
//            $utente->setUtentecartaoperatore($user->getCodicefiscale());
//            $em->persist($utente);
//*/
//            $campiRequest = $request->request->all();
//            if (array_key_exists('gruppiutente', $campiRequest['fos_user_registration_form'])) {
//                $gruppiutenteRequest = $campiRequest['fos_user_registration_form']['gruppiutente'];
//                //DEM 20160218 Risolto bug per registrazione utente
//                foreach ($gruppiutenteRequest as $gruppoutenteRequest) {
//                    $utentegruppoutente = new Utentegruppoutente();
//                    $utentegruppoutente->setIdutente($user); //FG 20160202 modificato causa refactoring
//                    $utentegruppoutenteEntity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($gruppoutenteRequest);
//                    $utentegruppoutente->setIdgruppoutente($utentegruppoutenteEntity);
//                    if (array_key_exists('amministratoriCheckboxInput', $campiRequest)) {
//                        $amministratoriRequest = $campiRequest['amministratoriCheckboxInput'];
//                        if ($amministratoriRequest) {
//                            foreach ($amministratoriRequest as $amministratoreRequest) {
//                                if ($amministratoreRequest == $gruppoutenteRequest) {
//                                    $utentegruppoutente->setAmministratore(true);
//                                }
//                            }
//                        }
//
//                    }
//                    $em->persist($utentegruppoutente);
//                }
//
//            }
//
//
//            //** Parte aggiunta END */
//
//            if (null === $response = $event->getResponse()) {
//                //** Parte aggiunta INIT */
//                $em->flush();
//                //** Parte aggiunta END */
//                $url = $this->generateUrl('utente');
//                $response = new RedirectResponse($url);
//            }
//
//            //$dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));
//
//            return $response;
//        }
//
//        return $this->render('FOSUserBundle:Profile:editother.html.twig', array(
//            'editform' => $form->createView(),
//            'idUtente' => $idUtente
//        ));
//    }

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
        //var_dump($utente);
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        // 1) build the form
        $form = $formFactory->createForm();
//        $form->setData($utente);
        //FG non c'? verso di farlo funzionare con la form estesa per un motivo: non abbiamo esteso la classe
        //di fos user con la nostra ma siamo andati in affiancamento. Questo mi rende impossibile usare il meccanismo
        //di base per cui riscrivo tutto.

        $formBuilder = $this->createFormBuilder();
        $formBuilder->add("email", "text", array(
            'label' => "Indirizzo Email",
            'data' => $utente->getEmail()
        ));
        $formBuilder->add("username", "text", array(
            'label' => "Username",
            'data' => $utente->getUsername()
        ));
        $formBuilder->add("nomecognome", "text", array(
            'label' => "Nome e Cognome",
            'data' => $utente->getNomecognome()
        ));
        $formBuilder->add("utentecartaoperatore", "text", array(
            'label' => "Codice fiscale carta operatore",
            'required' => false,
            'data' => $utente->getUtentecartaoperatore()
        ));

        $formBuilder->add('idazienda', 'entity', array(
            'class' => 'estar\rda\RdaBundle\Entity\Azienda',
            'choice_label' => 'nome',
            'label' => 'Azienda',
            'data' => $utente->getIdazienda()
        ));

        // Creiamo l'array di gruppi a cui ? collegato l'utente
        $gruppi = $em->getRepository('estar\rda\RdaBundle\Entity\Utentegruppoutente')->findBy(array('idutente' => $utente->getId()));
        //FG ci peschiamo i gruppi
        $gruppi = $em->getRepository('estar\rda\RdaBundle\Entity\Utentegruppoutente')->findBy(array('idutente' => $idUtente, 'amministratore' => '1'));
        $stringaGruppo = "";

        foreach ($gruppi as $gruppo) {
            $stringaGruppo.=$gruppo->getIdgruppoutente()->getId();
            $stringaGruppo.="-";
        }
        $stringaGruppo=substr($stringaGruppo, 0, strlen($stringaGruppo)-1);

        $hiddenFormBuilder = $this->createFormBuilder();

        $hiddenFormBuilder->add('gruppiAmministrati', 'hidden', array(
            'data' => $stringaGruppo
        ));
//        $formBuilder->add('gruppiutente', 'entity', array(
//            'class' => 'estar\rda\RdaBundle\Entity\Utentegruppoutente',
//            'label' => 'Gestione Gruppi di Appartenenza',
//            'choice_label' => 'idgruppoutente.getDescrizione',
//            'multiple' => 'true',
//            'expanded' => 'true',
//            'data' => $gruppi
//        ));

        $formBuilder->add('gruppiutente', 'entity', array(
            'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
            'property' => 'nome',
            'multiple' => 'true',
            'expanded' => 'true',
            'attr' => array('class'=>'gruppiutenteCheckbox'),
            'label' => 'Gruppi Utente',
            'data' => $utente->getGruppiutente()
        ));
//        $formBuilder->add('gruppiutente', 'collection', array(
//           'entry_type', 'estar\rda\RdaBundle\Form\UtentegruppoutenteType'
//        ));
//        var_dump($amm);
//        var_dump($dati);
//       $formBuilder->add('amministratoriCheckboxInput', 'entity', array(
//           'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
//           'property' => 'nome',
//           'multiple' => true,
//           'expanded' => true,
//           'attr' => array('class'=>'amministratoriCheckbox'),
//           'label' => 'Gruppi Utente',
//           'data' => $amm
//       ));
        $formBuilder->setAction($this->generateUrl('updateUser', array('idUtente' => $idUtente)));
        $formBuilder->add('submit', 'submit', array('label' => 'Aggiorna'));
        //$edit_form = $formBuilder->getForm();

        //$form->setData($utente);

        // 2) handle the submit (will only happen on POST)
        //FG ho dovuto commentare
        //$form->handleRequest($request);
        return $this->render('FOSUserBundle:Profile:editother.html.twig', array(
            'editform' => $formBuilder->getForm()->createView(),
            'hiddenform' => $hiddenFormBuilder->getForm()->createView(),
            'idUtente' => $idUtente
        ));

    }

    public function updateUserAction(Request $request, $idUtente) {

        //Ci peschiamo l'utente
        $em = $this->getDoctrine()->getManager();
        $utente = $em->getRepository('estar\rda\RdaBundle\Entity\Utente')->find($idUtente);

        //Cancelliamo i gruppi utenti esistenti
        $uguEsistenti = $em->createQuery('delete from estarRdaBundle:Utentegruppoutente ugu where ugu.idutente = '.$utente->getId());
        $cancellati = $uguEsistenti->execute();
        $em->flush();



//        //Vediamo che c'? arrivato
//        $campiRequest = $request->request->all();
//        $utente->setNomecognome($campiRequest['form']['nomecognome']);
//        $utente->setUtentecartaoperatore($campiRequest['form']['utentecartaoperatore']);
//        $utente->setIdazienda($em->getRepository('estarRdaBundle:Azienda')->find($campiRequest['form']['idazienda']));
//        if (array_key_exists('gruppiutente', $campiRequest['form'])) {
//            //Gruppi utente a cui l'utente è collegato detti dalla form
//            $gruppiutenteRequest = $campiRequest['form']['gruppiutente'];
//            //Gruppi di cui l'utente è amministratore detti dalla form
//            if (array_key_exists('amministratoriCheckboxInput', $campiRequest)) {
//            $amministratoriRequest = $campiRequest['amministratoriCheckboxInput'];
//           // dump($gruppiutenteRequest);
//            foreach ($gruppiutenteRequest as $gruppoutenteRequest) {
//                $utentegruppoutente = new Utentegruppoutente();
//                $utentegruppoutente->setIdutente($utente);
//                $utentegruppoutenteEntity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($gruppoutenteRequest);
//                $utentegruppoutente->setIdgruppoutente($utentegruppoutenteEntity);
//                if (in_array($utentegruppoutenteEntity->getId(), $amministratoriRequest))
//                    $utentegruppoutente->setAmministratore(true);
//                $em->persist($utentegruppoutente);
//            }
//        }
//        }

        $campiRequest = $request->request->all();
        $utente->setNomecognome($campiRequest['form']['nomecognome']);
        $utente->setEmail($campiRequest['form']['email']);
        $utente->setUsername($campiRequest['form']['username']);
        $utente->setUtentecartaoperatore($campiRequest['form']['utentecartaoperatore']);
        $utente->setIdazienda($em->getRepository('estarRdaBundle:Azienda')->find($campiRequest['form']['idazienda']));
        if (array_key_exists('gruppiutente', $campiRequest['form'])) {
            $gruppiutenteRequest = $campiRequest['form']['gruppiutente'];
            //DEM 20160218 Risolto bug per registrazione utente
            foreach ($gruppiutenteRequest as $gruppoutenteRequest) {
                $utentegruppoutente = new Utentegruppoutente();
                $utentegruppoutente->setIdutente($utente); //FG 20160202 modificato causa refactoring
                $utentegruppoutenteEntity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($gruppoutenteRequest);
                $utentegruppoutente->setIdgruppoutente($utentegruppoutenteEntity);
                if (array_key_exists('amministratoriCheckboxInput', $campiRequest)) {
                    $amministratoriRequest = $campiRequest['amministratoriCheckboxInput'];
                    if ($amministratoriRequest) {
                        foreach ($amministratoriRequest as $amministratoreRequest) {
                            if ($amministratoreRequest == $gruppoutenteRequest) {
                                $utentegruppoutente->setAmministratore(true);
                            }
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


    public function editUserActionNew(Request $request, $idUtente)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('estarRdaBundle:Utente')->find($idUtente);

        if (!is_object($user)) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
        //FG ci peschiamo i gruppi
        $gruppi = $em->getRepository('estar\rda\RdaBundle\Entity\Utentegruppoutente')->findBy(array('idutente' => $idUtente, 'amministratore' => '1'));
        $stringaGruppo = "";

        foreach ($gruppi as $gruppo) {
            $stringaGruppo.=$gruppo->getIdgruppoutente()->getId();
            $stringaGruppo.="-";
        }
        $stringaGruppo=substr($stringaGruppo, 0, strlen($stringaGruppo)-1);

        $hiddenFormBuilder = $this->createFormBuilder();

        $hiddenFormBuilder->add('gruppiAmministrati', 'hidden', array(
            'data' => $stringaGruppo
        ));
        $form = $formFactory->createForm();
        //$form = $this->createForm(new ProfileType($user), $gruppi);
        $form->setData($user);

        $form->handleRequest($request);
        $form->add('submit', 'submit', array('label' => 'Aggiorna'));

        if ($form->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
            //FG intervenire qui per settare i gruppi
            $url = $this->generateUrl('utente');
            $response = new RedirectResponse($url);

        }

        return $this->render('FOSUserBundle:Profile:editother.html.twig', array(
            'editform' => $form->createView(),
            'hiddenform' => $hiddenFormBuilder->getForm()->createView()
        ));
    }


    public function changePasswordFixedAction (Request $request, $idUtente) {
        //Ci peschiamo l'utente
//        $em = $this->getDoctrine()->getManager();
//        $utente = $em->getRepository('estar\rda\RdaBundle\Entity\Utente')->find($idUtente);


        //TODO vedere documentazione ufficiale http://symfony.com/doc/current/bundles/FOSUserBundle/user_manager.html
        $userManager = $this->container->get('fos_user.user_manager');

        $user= $userManager->findUserBy(array('id'=>$idUtente));

        $user->setPlainPassword('12345678');
        $user->setEnabled(true);
        $userManager->updateUser($user, true);

        $this->get('session')->getFlashBag()->add(
            'notice',
            array(
                'alert' => 'success',
                'title' => 'Success!',
                'message' => 'Password Reimpostata da 1 a 8!'
            )
        );

        $url = $this->generateUrl('utente');
        return $this->redirect($url);

    }


}
<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Entity\Utentegruppoutente;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Utente;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as RegistrationParentController;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;


class RegistrationExtendedController extends RegistrationParentController
{

    public function registerAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $user = $userManager->createUser();
        $user->setEnabled(true);

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        // 1) build the form
        $form = $formFactory->createForm();
        $form->setData($user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isValid()) {
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

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

            $campiRequest = $request->request->all();
            $gruppiutenteRequest = $campiRequest['fos_user_registration_form']['gruppiutente'];

            foreach ($gruppiutenteRequest as $gruppoutenteRequest){
                $utentegruppoutente = new Utentegruppoutente();
                $utentegruppoutente->setIdutente($utente);
                $utentegruppoutenteEntity = $em->getRepository('estarRdaBundle:Gruppoutente')->find($gruppoutenteRequest);
                $utentegruppoutente->setIdgruppoutente($utentegruppoutenteEntity);
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


}

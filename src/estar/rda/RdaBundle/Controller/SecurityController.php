<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Debug\Exception\FatalErrorException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use FOS\UserBundle\Doctrine\UserManager;
use Symfony\Component\Security\Core\Authentication\Token\AbstractToken;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;






class SecurityController extends BaseController
{
    public function loginAction(Request $request)
    {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */

        $session = $request->getSession();

        // chiamata del metodo di verifica stringa carta operatore


        $uid = $this->checkSmartCardString($request);

        // se $uid contiene false c'� stato un errore, altrimenti $uid contiene il CF

        if ($uid!=false){

            // si recupera l'id utente a seguito della query per CF

                $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Utente');
               $utente = $repository->findOneBy(array(
                        'utentecartaoperatore'=>$uid)
                );


                if ($utente){
                    $username = $utente->getUsername();

                    $userManager = $this->get('fos_user.user_manager');
                    $user = $userManager->findUserByUsername($username);

                    // metodo per bypassare l'autenticazione nativa di symfony

                    $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                    $this->get('security.token_storage')->setToken($token);

                    return $this->render('estarRdaBundle:HomePage:index.html.twig', array('utente' => $user));
                }else{
                    //throw new BadCredentialsException();

                }



      }

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }


        // parametri per il redirect di ritorno da parte del server di autenticazione, nel caso ok o ko dalla verifica
        // della carta operatore

        $urlok = $request->getUri();
        $urlko = $request->getUri();
        $urlok = base64_encode($urlok);
        $urlko = base64_encode($urlko);

        return $this->renderLogin(array(
            'last_username' => $lastUsername,

            'error' => $error,
            'csrf_token' => $csrfToken,

            'urlok'=>$urlok,
            'urlko'=>$urlko,
        ));

    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {

        return $this->render('FOSUserBundle:Security:login.html.twig', $data);


    }

    public function checkAction()
    {

        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

    /**
     * @param Request $request
     * @return bool|mixed|string
     *
     * Metodo per la verifica della stringa ritornata dal server di autenticazione centralizzato, dopo verifica della carta operatore
     *
     *
     */
    public function checkSmartCardString(Request $request){

        $uid = (!empty($request->get('uid')))?$request->get('uid'):"";
        $time = (!empty($request->get('time')))?$request->get('time'):"";
        $hash = (!empty($request->get('hash')))?$request->get('hash'):"";

     if ($uid == ""||$time==""||$hash=="") return false;

        //$time = 1344334037;
         $timeattuale = time();

         $differenzatempo = $timeattuale - $time;

        if (($differenzatempo/60)>5){
            // � passato troppo tempo (5 minuti) dall'ultima richiesta con questa stringa
            return false;
        }

         //$hash = '841a734135823022f5555e083c2ab3af674f8388';
        $dacodificare = $uid.$time.'WHR_auth';
        $codificato = sha1($dacodificare);

        if (sha1($dacodificare) == $hash){
            // ok autenticazione valida
           return $uid;
        }
        else{
            // ko autenticazione errata
            return false;
        }


    }

}

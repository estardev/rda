<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
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
        $nBozza=new ArrayCollection();
        $nDainv= new ArrayCollection();
        $nValAmm=new ArrayCollection();
        $nValtec= new ArrayCollection();
        // chiamata del metodo di verifica stringa carta operatore


        $uid = $this->checkSmartCardString($request);

        // se $uid contiene false c'� stato un errore, altrimenti $uid contiene il CF

        if ($uid!=false){

            // si recupera l'id utente a seguito della query per CF

            $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Utente');
            $utente = $repository->findOneBy(array('utentecartaoperatore'=>$uid));

            if ($utente){
                $idUtenteSessione =         $utente->getId();
                $aziendaUtente = trim($utente->getIdazienda()->getNome());
                $idAziendaUtente = $utente->getIdazienda()->getId();

                $username = $utente->getUsername();

                $userManager = $this->get('fos_user.user_manager');
                $user = $userManager->findUserByUsername($username);

                $em = $this->getDoctrine()->getManager();
                $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
                $categoria = $em->getRepository('estarRdaBundle:Categoria')->findAll();
                $userCheck = $this->get("usercheck.notify");
                $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtenteCartaOperatore($utente); //array di oggetti DirittiRichiesta
                foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
                    $idCategoria = $dirittoSingolo->getCategoria()->getId();
                    if ($dirittoSingolo->getIsAI()) {
                        //Abilitato all'inserimento. Se ESTAR, le vede tutte. Se non è ESTAR, vede solo quelle della sua azienda
                        //filtrare in base al tipo di azienda
                        if ($aziendaUtente == 'ESTAR')
                            $query = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$user AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue
                        else
                            $query = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$user AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente
                                    ");
                        $nBozza->add($query->getResult());

                    }
                    if ($dirittoSingolo->getIsVt()) {
                        //Validatore tecnico. Se è ESTAR, vede tutte quelle in attesa di validazione tecnica. Se non è ESTAR, vede solo quelle della sua azienda
                        if ($aziendaUtente == 'ESTAR')
                            $query1 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$user AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria
                                    ");
                        else
                            $query1 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                     FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                     WHERE  r.status='attesa_val_tec' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                     AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente
                                     ");
                        $nValtec->add($query1->getResult());

                    }
                    if ($dirittoSingolo->getIsVa()) {
                        //Validatore amministrativo. Estar = vede tutte quelle in attesa. Altro utente? vede solo le sue.
                        if ($aziendaUtente == 'ESTAR')
                            $query2 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='attesa_val_amm' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria
                                    ");
                        else
                            $query2 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='attesa_val_amm' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente
                                    ");
                        $nValAmm->add($query2->getResult());
                        if ($aziendaUtente == 'ESTAR')
                            $query3 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='da_inviare_ESTAR' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria
                                    ");
                        else
                            $query3 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='da_inviare_ESTAR' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente
                                    ");
                        $nDainv->add($query3->getResult());
                    }
                }
                // metodo per bypassare l'autenticazione nativa di symfony

                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->get('security.token_storage')->setToken($token);
                $idCategoria = $this->get('session')->get('homepageSelectCategoria');

                return $this->render('estarRdaBundle:HomePage:index.html.twig', array(
                    'utente' => $utente,
                    'richiesta' => $richiesta,
                    'categoria'=> $categoria,
                    'nbozza' => $nBozza,
                    'nvaltec' => $nValtec,
                    'nvalamm' => $nValAmm,
                    'ndainvABS' => $nDainv));

            }else{
                //throw new BadCredentialsException();
                $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
                $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
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

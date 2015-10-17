<?php
/**
 * Created by PhpStorm.
 * User: Nadia
 * Date: 16/10/2015
 * Time: 14.08
 */
namespace estar\rda\RdaBundle\Twig;

use estar\rda\RdaBundle\Entity\GenericDoctrine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavbarExtension extends \Twig_Extension
{

    protected $em;

    public function __construct($em, $user, $session)
    {
        $this->em = $em;
        $this->user = $user;
        $this->session = $session;
    }

           public function getFunctions()
    {
        return array(
            'navbar' => new \Twig_Function_Method($this, 'renderNavbar', array('is_safe' => array('html'),
                'needs_environment' => true))
        );

    }

    public function renderNavbar(\Twig_Environment $twig)
    {

        $utenteSessione= $this->user->getToken()->getUser();

        $categoria = $this->em->getRepository('estarRdaBundle:Categoria')->findAll();
        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')->findAll();

        $categoriaSelezionata = $this->session->get('homepageSelectCategoria');

        return $twig->render('estarRdaBundle::navbar.html.twig', array(
            'richiesta' => $richiesta,
            'categoria'=> $categoria,
            'utente' => ucfirst($utenteSessione),
            'categoriaSelezionata' => $categoriaSelezionata
        ));
    }

    public function getName()
    {
        return 'navbar_extension';
    }

}
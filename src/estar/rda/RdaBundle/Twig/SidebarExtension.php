<?php
/**
 * Created by PhpStorm.
 * User: Nadia
 * Date: 16/10/2015
 * Time: 14.08
 */
namespace estar\rda\RdaBundle\Twig;


class SidebarExtension extends \Twig_Extension
{

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getFunctions()
    {
        return array(
            'sidebar' => new \Twig_Function_Method($this, 'renderSidebar', array('is_safe' => array('html'),
                'needs_environment' => true))
        );

    }

    public function renderSidebar(\Twig_Environment $twig)
    {

        $utenteSessione= $this->user->getToken()->getUser();

        return $twig->render('estarRdaBundle::sidebar.html.twig', array(
            'utente' => ucfirst($utenteSessione)
        ));
    }

    public function getName()
    {
        return 'sidebar_extension';
    }

}
<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    public function indexAction()
    {
        //$mySESSION= var_dump($_SESSION['_sf2_attributes']['_security_main']);
        //$myBoolean = $this->authorizationChecker->isGranted('ROLE_NEWSLETTER_ADMIN');
        //file_put_contents("ciao.txt", print_r($_SESSION['_sf2_attributes']['_security_main'], true));
        //file_put_contents("ciao.txt", print_r($myBoolean, true));
        return $this->render('estarRdaBundle:HomePage:index.html.twig'/*,array('sessione'=>$mySESSION)*/);
    }
}

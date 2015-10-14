<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    public function indexAction()
    {
        $utente= $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->findAll();

        return $this->render('estarRdaBundle:HomePage:index.html.twig', array(
            'richiesta' => $richiesta,
            'categoria'=> $categoria,
            'utente' => $utente,
        ));

        //$mySESSION= var_dump($_SESSION['_sf2_attributes']['_security_main']);
        //$myBoolean = $this->authorizationChecker->isGranted('ROLE_NEWSLETTER_ADMIN');
        //file_put_contents("ciao.txt", print_r($_SESSION['_sf2_attributes']['_security_main'], true));
        //file_put_contents("ciao.txt", print_r($myBoolean, true));
        //return $this->render('estarRdaBundle:HomePage:index.html.twig'/*,array('sessione'=>$mySESSION)*/);
    }

}

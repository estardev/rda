<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomePageController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //$container->get("starRdaBundle.UserCheck")->someMethodCall();
        //$notify = $this->get("estarrdabundle.usercheck");
        //$utente = $notify->getSessionName(); //non funziona

       $utenteSessione= $this->get('security.context')->getToken()->getUser();
       //$idutenteSessione = $utenteSessione->getId();
       // $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Utente');
       // $utente = $repository->findOneBy(array(
       //     'idfosuser'=>$idutenteSessione)
       // );
       // $idutente = $utente->getId();
       // $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Utentegruppoutente');
       // $utentegruppo = $repository->findOneBy(array(
       //         'idutente'=>$idutente)
       // );
       // $idutentegruppo = $utentegruppo->getIdgruppoutente()->getId();
       // $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Categoriagruppo');
       // $campogruppo = $repository->findOneBy(array(
       //         'idgruppoutente'=>$idutentegruppo)
       // );
       // $abilitatoinserimentorichieste = $campogruppo->getAbilitatoinserimentorichieste();
       // $validatoretecnico = $campogruppo->getValidatoretecnico();
       // $validatoreAmministrativo = $campogruppo->getValidatoreamministrativo();
        //dump($campogruppo);
        //dump($utente);

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->findAll();

        return $this->render('estarRdaBundle:HomePage:index.html.twig', array(
            'richiesta' => $richiesta,
            'categoria'=> $categoria,
            'utente' => ucfirst($utenteSessione),

        ));

    }


}

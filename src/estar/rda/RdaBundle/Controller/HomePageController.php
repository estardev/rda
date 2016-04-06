<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomePageController extends Controller
{
    public function indexAction()
    {
        $utenteSessione= $this->getUser();
       //$idutenteSessione = $utenteSessione->getId();
       //
        $em = $this->getDoctrine()->getManager();
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
       // dump($campogruppo);
       //
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->findAll();

        $nValtec=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='attesa_val_tec'")->getSingleScalarResult();

        $nBozza=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='bozza'")->getSingleScalarResult();

        $nValAmm=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='attesa_val_amm'")->getSingleScalarResult();

        $nDainv=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='da_inviare_ABS'")->getSingleScalarResult();




        //David_20151029: Aggiunto il redirect sulla lista richieste per categoria impostata in sessione

        $idCategoria = $this->get('session')->get('homepageSelectCategoria');

        if (!empty($idCategoria)){
            return $this->redirect($this->generateUrl('richiesta_bycategoria',array('idCategoria'=>$idCategoria)));
        }
        else

        // fine:David_20151029

        return $this->render('estarRdaBundle:HomePage:index.html.twig', array(
            'richiesta' => $richiesta,
            'categoria'=> $categoria,
            'utente' => ucfirst($utenteSessione),
            'nbozza' => $nBozza,
            'nvaltec' => $nValtec,
            'nvalamm' => $nValAmm,
            'ndainvABS' => $nDainv,

        ));

    }

}

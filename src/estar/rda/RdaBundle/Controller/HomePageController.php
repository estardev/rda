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

        $nValtec=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='attesa_val_tec' ")->getSingleScalarResult();

        $nBozza=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='bozza'")->getSingleScalarResult();

        $nValAmm=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='attesa_val_amm'")->getSingleScalarResult();

        $nDainv=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='da_inviare_ABS'")->getSingleScalarResult();

        //David_20151029: Aggiunto il redirect sulla lista richieste per categoria impostata in sessione
        //modificato da Demetrio_20160406:
        // se ci sono operazioni da fare torna alla homepage di riepilogo,
        // se non ci sono operazioni da fare ed è settata la categoria torna nella categoria

        $idCategoria = $this->get('session')->get('homepageSelectCategoria');

        if(!empty($nValAmm) or !empty($nDainv) or !empty($nBozza) or !empty($nValtec)){
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
        else if (!empty($idCategoria)){
            return $this->redirect($this->generateUrl('richiesta_bycategoria',array('idCategoria'=>$idCategoria)));
        }
        else{
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

        // fine:David_20151029



    }

}

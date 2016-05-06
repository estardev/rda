<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomePageController extends Controller
{
    public function indexAction()
    {
        $nBozza="";
        $nDainv= "";
        $nValAmm="";
        $nValtec=   "";
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

        //fg 20160503 bozza di codice "nuovo"
        $userCheck = $this->get("usercheck.notify");
        $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtente(); //array di oggetti DirittiRichiesta

      foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
          $idCategoria = $dirittoSingolo->getCategoria()->getId();
          if ($dirittoSingolo->getIsAI()) {
              //Abilitato all'inserimento
              $query = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$utenteSessione AND r.status='bozza' AND c.id=r.idcategoria
                                    ");
              $nBozza = $query->getResult();

          }
          if ($dirittoSingolo->getIsVt()) {
              $query1 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                     FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                     WHERE  r.status='attesa_val_tec' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                     ");
              $nValtec = $query1->getResult();

          }
          if ($dirittoSingolo->getIsVa()) {
              $query2 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='attesa_val_amm' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    ");
              $nValAmm = $query2->getResult();

              $query3 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='da_inviare_ABS' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    ");
              $nDainv = $query3->getResult();
            }
        }
        //$nValtec=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='attesa_val_tec' ")->getSingleScalarResult();

        //$nBozza=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='bozza'")->getSingleScalarResult();

        //$nValAmm=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='attesa_val_amm'")->getSingleScalarResult();

        //$nDainv=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='da_inviare_ABS'")->getSingleScalarResult();





       // $query1 = $em->createQuery("SELECT COUNT(r) as numero, r.idcategoria as idcat, c.descrizione as descrizionecategoria
       //                             FROM estarRdaBundle:Richiesta r, estarRdaBundle:Utentegruppoutente ug, estarRdaBundle:Utente u, estarRdaBundle:Categoriagruppo cg, estarRdaBundle:Categoria c
       //                             WHERE r.idcategoria=c.id
       //                             AND r.idutente=u.id
       //                             AND ug.idutente=u.id
       //                             AND cg.idgruppoutente=ug.id
       //                             AND r.status='attesa_val_tec'
       //                             AND cg.validatoretecnico=1");
       // $nValtec = $query1->getResult();



        //David_20151029: Aggiunto il redirect sulla lista richieste per categoria impostata in sessione
        //modificato da Demetrio_20160406:
        // se ci sono operazioni da fare torna alla homepage di riepilogo,
        // se non ci sono operazioni da fare ed è settata la categoria torna nella categoria

       // $usercheck = $this->get("usercheck.notify");
       // $categoriaabilitato = $usercheck->dirittiUtente();
       // dump($categoriaabilitato);
//
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

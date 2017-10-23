<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class HomePageController extends Controller
{

    public function indexActionAll()
    {
        $utenteSessione = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $richieste = new ArrayCollection(); //= $em->getRepository('estarRdaBundle:Richiesta')->findAll();

        $user = $this->getUser();
        $idUtenteSessione = $user->getId();
        $aziendaUtente = trim($user->getIdazienda()->getNome());
        $idAziendaUtente = $user->getIdazienda()->getId();

        $userCheck = $this->get("usercheck.notify");

        /*
         * mi viene restituita per ogni categoria che l'utente è abilitato a vedere le sue abilitazioni
         * di AI - inseritore
         * di VA - validatore Amministrativo
         * di VT - validatore Tecnico
         *
         * in base a queste devo prendere le richieste.
         */

        $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtente();
        //dump($dirittiTotaliRadicaliGlobbali);//array di oggetti DirittiRichiesta
        foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
            $idCategoria = $dirittoSingolo->getCategoria()->getId();
            if ($dirittoSingolo->getIsAI()) {
                //Abilitato all'inserimento. Se ESTAR, le vede tutte. Se non è ESTAR, vede solo quelle della sua azienda
                //filtrare in base al tipo di azienda
                if ($aziendaUtente == 'ESTAR')
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE   r.status='bozza' 
                                    AND r.idutente=$utenteSessione 
                                    AND r.idcategoria=$idCategoria
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue
                else
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  r.idutente=$utenteSessione 
                                    AND r.status='bozza' 
                                    AND r.idcategoria = $idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    ");
                foreach ($query->getResult() as $richiesta) {
                    $richieste->add($richiesta);
                }

            }
            if ($dirittoSingolo->getIsVt()) {
                //Validatore tecnico. Se è ESTAR, vede tutte quelle in attesa di validazione tecnica. Se non è ESTAR, vede solo quelle della sua azienda
                if ($aziendaUtente == 'ESTAR')
                    $query1 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  r.status='attesa_val_tec' 
                                    AND r.idcategoria=$idCategoria
                                    ");
                else
                    $query1 = $em->createQuery("SELECT r
                                     FROM estarRdaBundle:Richiesta r
                                     WHERE  r.status='attesa_val_tec' 
                                     AND r.idcategoria=$idCategoria 
                                     AND r.idazienda=$idAziendaUtente
                                     ");
                foreach ($query1->getResult() as $richiesta1) {
                    $richieste->add($richiesta1);
                }

            }
            if ($dirittoSingolo->getIsVa()) {
                //Validatore amministrativo. Estar = vede tutte quelle in attesa. Altro utente? vede solo le sue.
                if ($aziendaUtente == 'ESTAR')
                    $query2 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  (r.status='attesa_val_amm' 
                                    OR r.status='da_inviare_ESTAR' 
                                    OR r.status='inviata_ESTAR') 
                                    AND r.idcategoria=$idCategoria
                                    ");
                else
                    $query2 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  (r.status='attesa_val_amm'
                                    OR r.status='da_inviare_ESTAR' 
                                    OR r.status='inviata_ESTAR') 
                                    AND r.idcategoria=$idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    ");
                foreach ($query2->getResult() as $richiesta2) {
                    $richieste->add($richiesta2);
                }

            }
        }

        return $this->render('estarRdaBundle:HomePage:indexAll.html.twig', array(
            'entities' => $richieste));


    }

    public function indexAction()
{
    $nBozza=new ArrayCollection();
    $nDainv= new ArrayCollection();
    $nValAmm=new ArrayCollection();
    $nValtec= new ArrayCollection();
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

    //todo prendo l'id dell'azienda per filtrare le richieste
    //$user = $this->container->get('security.context')->getToken()->getUser();
    $user = $this->getUser();
    $idUtenteSessione =         $user->getId();
    $aziendaUtente = trim($user->getIdazienda()->getNome());
    $idAziendaUtente = $user->getIdazienda()->getId();
//        $utenteSessione = $em->getRepository('estarRdaBundle:Utente')->find($idUtenteSessione)->getIdazienda();

    //$idGruppoUtente = $em->getRepository('estarRdaBundle:Utentegruppoutente')->find($idUtenteSessione);
    //var_dump($idGruppoUtente);
    //$gruppoUtente = $em->getRepository('estarRdaBundle:Categoriagruppo')->find($idGruppoUtente)->getReferenteabs();
    //var_dump($gruppoUtente);


    //fg 20160503 bozza di codice "nuovo"
    $userCheck = $this->get("usercheck.notify");
    $dirittiTotaliRadicaliGlobbali = $userCheck->dirittiByUtente(); //array di oggetti DirittiRichiesta
    foreach ($dirittiTotaliRadicaliGlobbali as $dirittoSingolo) {
        $idCategoria = $dirittoSingolo->getCategoria()->getId();
        if ($dirittoSingolo->getIsAI()) {
            //Abilitato all'inserimento. Se ESTAR, le vede tutte. Se non è ESTAR, vede solo quelle della sua azienda
            //filtrare in base al tipo di azienda
            if ($aziendaUtente == 'ESTAR')
                $query = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$utenteSessione AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue
            else
                $query = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$utenteSessione AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente
                                    ");
            $nBozza->add($query->getResult());

        }
        if ($dirittoSingolo->getIsVt()) {
            //Validatore tecnico. Se è ESTAR, vede tutte quelle in attesa di validazione tecnica. Se non è ESTAR, vede solo quelle della sua azienda
            if ($aziendaUtente == 'ESTAR')
                $query1 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$utenteSessione AND r.status='bozza' AND c.id=r.idcategoria
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
    //$nValtec=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='attesa_val_tec' ")->getSingleScalarResult();

    //$nBozza=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.idutente=$utenteSessione AND r.status='bozza'")->getSingleScalarResult();

    //$nValAmm=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='attesa_val_amm'")->getSingleScalarResult();

    //$nDainv=$em->createQuery("SELECT COUNT(r) FROM estarRdaBundle:Richiesta r WHERE r.status='da_inviare_ESTAR'")->getSingleScalarResult();





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

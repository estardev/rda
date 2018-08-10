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
                                    AND r.proid is null
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue
                else
                    $query = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  r.idutente=$utenteSessione 
                                    AND r.status='bozza' 
                                    AND r.idcategoria = $idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    AND r.proid is null
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
                                    AND r.proid is null
                                    ");
                else
                    $query1 = $em->createQuery("SELECT r
                                     FROM estarRdaBundle:Richiesta r
                                     WHERE  r.status='attesa_val_tec' 
                                     AND r.idcategoria=$idCategoria 
                                     AND r.idazienda=$idAziendaUtente
                                     AND r.proid is null
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
                                    AND r.proid is null
                                    ");
                else
                    $query2 = $em->createQuery("SELECT r
                                    FROM estarRdaBundle:Richiesta r
                                    WHERE  (r.status='attesa_val_amm'
                                    OR r.status='da_inviare_ESTAR' 
                                    OR r.status='inviata_ESTAR') 
                                    AND r.idcategoria=$idCategoria 
                                    AND r.idazienda=$idAziendaUtente
                                    AND r.proid is null
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
        $nBozza = new ArrayCollection();
        $nDainv = new ArrayCollection();
        $nValAmm = new ArrayCollection();
        $nValtec = new ArrayCollection();
        $utenteSessione = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->findAll();

        //todo prendo l'id dell'azienda per filtrare le richieste
        $user = $this->getUser();
        $idUtenteSessione = $user->getId();
        $aziendaUtente = trim($user->getIdazienda()->getNome());
        $idAziendaUtente = $user->getIdazienda()->getId();

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
                                    AND c.id=$idCategoria AND r.proid is null
                                    "); //Un utente ESTAR vede tutte le richieste, sue e non sue
                else
                    $query = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$utenteSessione AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente AND r.proid is null
                                    ");
                $nBozza->add($query->getResult());

            }
            if ($dirittoSingolo->getIsVt()) {
                //Validatore tecnico. Se è ESTAR, vede tutte quelle in attesa di validazione tecnica. Se non è ESTAR, vede solo quelle della sua azienda
                if ($aziendaUtente == 'ESTAR')
                    $query1 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.idutente=$utenteSessione AND r.status='bozza' AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.proid is null
                                    ");
                else
                    $query1 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                     FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                     WHERE  r.status='attesa_val_tec' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                     AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente AND r.proid is null
                                     ");
                $nValtec->add($query1->getResult());

            }
            if ($dirittoSingolo->getIsVa()) {
                //Validatore amministrativo. Estar = vede tutte quelle in attesa. Altro utente? vede solo le sue.
                if ($aziendaUtente == 'ESTAR')
                    $query2 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='attesa_val_amm' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.proid is null
                                    ");
                else
                    $query2 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='attesa_val_amm' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente AND r.proid is null
                                    ");
                $nValAmm->add($query2->getResult());
                
                if ($aziendaUtente == 'ESTAR')
                    $query3 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='da_inviare_ESTAR' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.proid is null
                                    ");
                else
                    $query3 = $em->createQuery("SELECT COUNT(r) as numero, c.id as idcat, c.descrizione as descrizionecategoria
                                    FROM estarRdaBundle:Richiesta r, estarRdaBundle:Categoria c
                                    WHERE  r.status='da_inviare_ESTAR' AND c.id=r.idcategoria AND c.id=r.idcategoria
                                    AND c.id=$idCategoria AND r.idazienda=$idAziendaUtente AND r.proid is null
                                    ");
                $nDainv->add($query3->getResult());
            }
        }

        $idCategoria = $this->get('session')->get('homepageSelectCategoria');

        if (!empty($nValAmm) or !empty($nDainv) or !empty($nBozza) or !empty($nValtec)) {
            return $this->render('estarRdaBundle:HomePage:index.html.twig', array(
                'richiesta' => $richiesta,
                'categoria' => $categoria,
                'utente' => ucfirst($utenteSessione),
                'nbozza' => $nBozza,
                'nvaltec' => $nValtec,
                'nvalamm' => $nValAmm,
                'ndainvABS' => $nDainv,

            ));
        } else if (!empty($idCategoria)) {
            return $this->redirect($this->generateUrl('richiesta_bycategoria', array('idCategoria' => $idCategoria)));
        } else {
            return $this->render('estarRdaBundle:HomePage:index.html.twig', array(
                'richiesta' => $richiesta,
                'categoria' => $categoria,
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

<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Entity\AbsPro;
use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Richiestaaggregazione;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

class ProgrammatoriaController extends Controller
{
    /*
     *  utente denominato SoftwareProgrammazione che serve per il servizio
     * presente con questo id in produzione ed in sviluppo locale
     */
    const IDUTENTE_SOFTWARE_PROGRAMMAZIONE = 252;


    public function getMapPriorita($pro)
    {
        //20180312 anche qui, le variabili dichiarate fuori scope non sono poi il massimo...
        $priorita = 0;
        switch ($pro) {
            case 1:
                $priorita = 3;
                break;
            case 2:
                $priorita = 2;
                break;
            case 3:
                $priorita = 3;
                break;
        }

        return $priorita;
    }

    /*
     * IMPORTANTE MAP DEI CAMBI CHE NON DOVRANNO MAI VARIARE SUL DB
     */
    public function getMapCampoByCategoria($categoria)
    {
        //FG20180302: Demetrio, se non definisci le variabili poi ha poco senso dichiararle fuori scope...
        $campo = 0;
        switch ($categoria) {
            case 1:
                $campo = 25;
                break;
            case 2:
                $campo = 189;
                break;
            case 3:
                $campo = 48;
                break;
            case 4:
                $campo = 206;
                break;
            case 5:
                $campo = 207;
                break;
            case 7:
                $campo = 208;
                break;
            case 8:
                $campo = 209;
                break;
            case 9:
                $campo = 210;
                break;
            case 11:
                $campo = 211;
                break;
            case 12:
                $campo = 212;
                break;
            case 15:
                $campo = 213;
                break;
            case 16:
                $campo = 214;
                break;
            case 19:
                $campo = 215;
                break;
            case 20:
                $campo = 216;
                break;
            case 21:
                $campo = 217;
                break;
            case 27:
                $campo = 218;
                break;
            case 30:
                $campo = 221;
                break;
            case 31:
                $campo = 408;
                break;
            case 32:
                $campo = 674;
                break;
            case 33:
                $campo = 451;
                break;
            case 34:
                $campo = 482;
                break;
            case 35:
                $campo = 513;
                break;
            case 36:
                $campo = 544;
                break;
            case 37:
                $campo = 575;
                break;
            case 38:
                $campo = 606;
                break;
            case 39:
                $campo = 637;
                break;
            case 40:
                $campo = 949;
                break;
            case 41:
                $campo = 968;
                break;
        }

        return $campo;
    }

    public function indexAction()
    {
//        $anno = date('Y');

//        $dateTime = new \DateTime();
//        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));

        $logger = $this->get('programmatoria_logger');
//        $logger->log('Inizio lavori');
        $logger->log('Invocata classe controller ProgrammatoriaController metodo index() inutilmente: il controller non è più attivo dal 13/05/2019');
//        $programmazioneDoctrine = $this->getDoctrine()->getManager('programmazione');
//        $logger->log('Recuperato Entity Manager programmazione');

//        $programs = $programmazioneDoctrine->getRepository('estarRdaBundle:AbsPro')->findBy(
//            array('pro_prontoper_rda' => 'S', 'pro_trasferito_rda' => 'N'),
//            array('pro_id' => 'ASC')
//        );
//        $logger->log('Recuperate entity da lavorare');

        /* @var $programmazione AbsPro */
//        $em = $this->getDoctrine()->getManager();
//        foreach ($programs as $programmazione) {
//            $logger->log('Inizio lavorazione '.$programmazione->getProId());
//            if ($programmazione->getProAnno() < $anno) {
//                //FG20180312: se è dell'anno precedente viene skippata. Lo salviamo comunque sulla procedura.
//                $programmazione->setProErroreRda('Saltata in quanto programmata in anno diverso da '.$anno);
//                $programmazioneDoctrine->flush();
//                continue;
//            }
//            $titolo = $programmazione->getProOggettoEsteso();
//            if (is_null($programmazione->getProNote()) or $programmazione->getProNote() == "")
//                $descrizione = $programmazione->getProOggettoEsteso();
//            else
//                $descrizione = $programmazione->getProNote();
//            if (is_null($programmazione->getCtrId()) or $programmazione->getCtrId() == '') {
//                //FG20180312: se manca la categoria la salto.
//                $programmazione->setProErroreRda('Saltata in quanto categoria nulla o vuota');
//                $programmazioneDoctrine->flush();
//                continue;
//            }
//            $id_Categoria = $em->getRepository('estarRdaBundle:Categoria')->find($programmazione->getCtrId());
//            if (is_null($id_Categoria)) {
//                //FG20180312: se manca la categoria su RDA...
//                $programmazione->setProErroreRda('Saltata in quanto la categoria richiesta ('.$programmazione->getCtrId().') non è codificata in RDA');
//                $programmazioneDoctrine->flush();
//                continue;
//
//            }
//            $status = 'da_inviare_ESTAR';
//            $azienda = $em->getRepository('estarRdaBundle:Azienda')->find(21);
//            $priorita = $this->getMapPriorita($programmazione->getLprId());
//            if ($priorita == 0) {
//                //FG20180312: se è dell'anno precedente viene skippata. Lo salviamo comunque sulla procedura.
//                $programmazione->setProErroreRda('Saltata in quanto codice priorita ('.$programmazione->getLprId().') non riconosciuto in RDA');
//                $programmazioneDoctrine->flush();
//                continue;
//
//            }
//            $id_utente = $em->getRepository('estarRdaBundle:Utente')->find(ProgrammatoriaController::IDUTENTE_SOFTWARE_PROGRAMMAZIONE);
//            if (is_null($id_utente)) {
//                //FG20180312: se manca l'utente di programmazione ho un errore di configurazione. Lo segnalo.
//                $programmazione->setProErroreRda('Errore di configurazione: Saltata per mancanza utenza RDA del software di programmazione');
//                $programmazioneDoctrine->flush();
//                continue;
//
//            }
//            //FG 20180312 spostato a monte il controllo sul mapping della categoria
//            $idCampo = $this->getMapCampoByCategoria($programmazione->getCtrId());
//            if ($idCampo == 0) {
//                //FG20180312: se manca il campo lo segnalo.
//                $programmazione->setProErroreRda('Errore di configurazione: Campo per la categoria '.$programmazione->getCtrId().' non trovato in RDA.');
//                $programmazioneDoctrine->flush();
//                continue;
//
//            }
//            $ivaesclusa = $programmazione->getProImportoComplessivoIe();
//
//            //todo campi non presenti sul DB da aggiungere
//            $cui = $programmazione->getProCui();
//            $rup = $programmazione->getRupId()->getRupDescrizione();
//            $utente_inserimento = $programmazione->getProUtenteIns();
//            $anno_programmazione = $programmazione->getProAnno();
//            $idRiferimento_programmazione = $programmazione->getProId();
//
//            //registro la richiesta programmazione
//            $richiesta_programmazione = new Richiesta();
//            $richiesta_programmazione->setTitolo($titolo);
//            $richiesta_programmazione->setDescrizione($descrizione);
//            $richiesta_programmazione->setIdcategoria($id_Categoria);
//            $richiesta_programmazione->setStatus($status);
//            $richiesta_programmazione->setIdazienda($azienda);
//            $richiesta_programmazione->setPriorita($priorita);
//            $richiesta_programmazione->setIdutente($id_utente);
//            $richiesta_programmazione->setDataora($dateTime);
//            $richiesta_programmazione->setCp(1);
//            $richiesta_programmazione->setAssenzaconflitto(1);
//            $richiesta_programmazione->setProcui($cui);
//            $richiesta_programmazione->setProrupnome($rup);
//            $richiesta_programmazione->setProutenteins($utente_inserimento);
//            $richiesta_programmazione->setProanno($anno_programmazione);
//            $richiesta_programmazione->setProid($idRiferimento_programmazione);
//            $em->persist($richiesta_programmazione);
//            $em->flush();
//            $em->refresh($richiesta_programmazione);
//            //Fatta la richiesta, la registro nell'entità padre
//            $programmazione->setProErroreRda('Creata con successo richiesta '.$richiesta_programmazione->getId());
//            $programmazioneDoctrine->flush();
//            //registro l'iter
//            $iter = new Iter();
//            $iter->setIdutente($id_utente);
//            $iter->setIdrichiesta($richiesta_programmazione);
//            $iter->setDataora($dateTime);
//            $iter->setDatafornita(1);
//            $iter->setDastato('bozza');
//            $iter->setAstato('da_inviare_ESTAR');
//            $iter->setMotivazione('nuova richiesta Programmata');
//            $em->persist($iter);
//            $em->flush();
//            //Fatto l'iter, lo registro nell'entità padre
//            $messaggio = $programmazione->getProErroreRda();
//            $messaggio = $messaggio.'; creato relativo iter';
//            $programmazione->setProErroreRda($messaggio);
//            $programmazioneDoctrine->flush();
//
//            //registro l'aggregazione delle richieste
//            $azienda = $em->getRepository('estarRdaBundle:Azienda')->findAll();
//            foreach ($azienda as $insertAzienda) {
//                $richiestaaggregazione = new Richiestaaggregazione();
//                $richiestaaggregazione->setIdrichiesta($richiesta_programmazione);
//                $richiestaaggregazione->setIdazienda($insertAzienda);
//                $em->persist($richiestaaggregazione);
//                $em->flush();
//            }
//            //Fatta l'aggregazione, lo registro nell'entità padre
//            $messaggio = $programmazione->getProErroreRda();
//            $messaggio = $messaggio.'; creata aggregazione richieste';
//            $programmazione->setProErroreRda($messaggio);
//            $programmazioneDoctrine->flush();
//
//            //registro la valorizzazione dei campi
//            $valorizzazionecamporichiesta = new Valorizzazionecamporichiesta();
//            $valorizzazionecamporichiesta->setIdrichiesta($richiesta_programmazione);
//            $valorizzazionecamporichiesta->setIdcategoria($id_Categoria);
//            $valorizzazionecamporichiesta->setIdcampo($em->getRepository('estarRdaBundle:Campo')->find($idCampo));
//            $valorizzazionecamporichiesta->setValore($ivaesclusa);
//            $em->persist($valorizzazionecamporichiesta);
//            $em->flush();
//            //Fatto l'iter, lo registro nell'entità padre
//            $em->refresh($valorizzazionecamporichiesta);
//            $messaggio = $programmazione->getProErroreRda();
//            $messaggio = $messaggio.'; creato campo di valorizzazione '.$valorizzazionecamporichiesta->getId();
//            $programmazione->setProErroreRda($messaggio);
//            $programmazioneDoctrine->flush();


//            $programmazione->setProTrasferitoRda('S');
//            $programmazione->setProDatatrasfRda($dateTime);
//            $programmazioneDoctrine->flush();

//            $sistematicaController = $this->get('sistematicaclientcontroller');
//            $esito = $this->forward('estarRdaBundle:SistematicaClient:index', array('idCategoria' => $programmazione->getCtrId(), 'idRichiesta' => $idRichiesta, 'tipologia' => "Nuova", 'programmatoria' => 1));
////            $esito = $sistematicaController->indexAction($programmazione->getCtrId(), $idRichiesta, 'Nuova',1);
//            if ($esito != "" and $esito->getStatusCode() == '200') {
//                $numprotocollo = $esito->getContent();
//                $programmazione->setProTrasferitoRda('S');
//                $programmazione->setProDatatrasfRda($dateTime);
//                $programmazione->setProProtocolloRda($numprotocollo);
//                $programmazioneDoctrine->flush();
//                $em->getConnection()->commit();
//                $em->getConnection()->close();
//            } else {
//                $em->getConnection()->rollBack();
//                $em->getConnection()->close();
//            }
//        }

//        $entitym = $this->getDoctrine()->getManager();
//        $query =  $entitym->createQuery("SELECT r
//                                    FROM estarRdaBundle:Richiesta r
//                                    WHERE   r.status='da_inviare_ESTAR'
//                                    AND r.idutente=252
//                                    AND r.idazienda=21
//                                    AND r.numeroprotocollo is null
//                                    AND r.procui is not null
//                                    AND r.prorupnome is not null
//                                    AND r.proutenteins is not null
//                                    AND r.proanno is not null
//                                    ");
//        $protocollare = $query->getResult();

//        foreach ($protocollare as $richiestaP){
//            /* @var $richiestaP Richiesta */
//            $idCategoria = $richiestaP->getIdcategoria()->getId();
//            $idR = $richiestaP->getId();
//            $idProgrammata = $richiestaP->getProid();
//            $esito = $this->forward('estarRdaBundle:SistematicaClient:index', array('idCategoria' => $idCategoria, 'idRichiesta' => $idR, 'tipologia' => "Nuova", 'programmatoria' => 1));
//            if ($esito != "" and $esito->getStatusCode() == '200') {
//                $numprotocollo = $esito->getContent();
//                $programmazione = $programmazioneDoctrine->getRepository('estarRdaBundle:AbsPro')->find($idProgrammata);
//                $programmazione->setProProtocolloRda($numprotocollo.'-'.$richiesta_programmazione->getProanno());
//                $messaggio = $programmazione->getProErroreRda();
//                $messaggio = $messaggio.'; Trasmessa correttamente ';
//                $programmazione->setProErroreRda($messaggio);
//                $programmazioneDoctrine->flush();
//            } else {
//                $programmazione = $programmazioneDoctrine->getRepository('estarRdaBundle:AbsPro')->find($idProgrammata);
//                $messaggio = $programmazione->getProErroreRda();
//                $messaggio = $messaggio.'; problema di trasmissione '.$esito;
//                $programmazione->setProErroreRda($messaggio);
//                $programmazioneDoctrine->flush();
//            }
//        }

//        $logger->log('Fine lavori');
        return new Response('funzionalità disattivata!', 200);
    }
}

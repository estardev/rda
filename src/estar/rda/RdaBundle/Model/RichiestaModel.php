<?php

namespace estar\rda\RdaBundle\Model;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Iter;
use \Doctrine\ORM\EntityManager;

/**
 * Class RichiestaModel
 * serve per esporre metodi di comodit� per il trattamento delle richieste.
 * Gestisce la macchina a stati e la validazione
 *
 * @author Francesco Galli - francesco01.galli@estar.toscana.it
 *
 * @package estar\rda\RdaBundle\Model
 */
class RichiestaModel extends Controller
{

    const STATUS_BOZZA = 'bozza';
    const STATUS_ATTESA_VAL_TEC='attesa_val_tec';
    const STATUS_ATTESA_VAL_AMM = 'attesa_val_amm';
    const STATUS_INSERITA_ABS = 'inserita_ABS';
    const STATUS_CHIUSA_ABS = "chiusa_ABS";
    const STATUS_EVASA_ABS = "evasa_ABS";

    const STATUSABS_CHIUSA = "Chiusa da ABS";
    const STATUSABS_ASSEGNATAPROGRAMMAZIONE = "In Programmazione";
    const STATUSABS_VALUTAZIONE = "In valutazione";
    const STATUSABS_ISTRUTTORIA = "In Istruttoria";
    const STATUSABS_INDIZIONE = "Gara Indetta";
    const STATUSABS_ANNULLATA = "Annullata da ABS";
    const STATUSABS_ARCHIVIATA = "Archiviata da ABS";

    private $em;

    private $user;


    /** costruttore di default. Mi serve un entity manager e l'utente corrente
     * @param $em
     * @param $user
     */
    public function __construct(EntityManager $em, $user)
    {
        $this->em = $em;
        $this->user = $user;
    }


    /** metodo che restituisce i campi da mostrare allo stato attuale
     *
     * @return array di campo
     */
    public function mostraCampi($idRichiesta) {
        //tiro su la richiesta
        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')
            ->find($idRichiesta);
        $idCategoria = $richiesta->getIdCategoria()->getId();
        //tiro su il gestore dei diritti
        $usercheck = $this->get("usercheck.notify");
        //stabiliamo i diritti per la richiesta
        $diritti = $usercheck->allRole($idCategoria);
        $isAbilitatoInserimento = $diritti[0];
        $isValidatoreTecnico = $diritti[1];
        $isValidatoreAmministrativo = $diritti[2];

        //ciclo sui campi e decido quali mostrare
        $repository = $this->em->getRepository('estarRdaBundle:Campo');
        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamento' => 'ASC')
        );
        $toReturn = array();
        foreach($campi as $campo) {
            //se posso vederlo come utente abilitato all'inserimento...
            if ($campo->getObbligatorioinserzione()>=0 && $isAbilitatoInserimento>0) {
                array_push($toReturn, $campo);
                continue;
            }
            //se non posso vederlo come utente abilitato ma come validatore tecnico si
            if ($campo->getObbligatoriovalidazionetecnica()>=0 && $isValidatoreTecnico>0) {
                array_push($toReturn, $campo);
                continue;
            }
            //se non posso vederlo come utente abilitato o come validatore tecnico ma come validatore amministrativo si
            if ($campo->getObbligatoriovalidazioneamministrativa()>=0 && $isValidatoreAmministrativo>0) {
                array_push($toReturn, $campo);
                continue;
            }

        }

        return $toReturn;




    }

    /** metodo che restituisce i campi necessari per il passaggio allo stato successivo
     *
     * @return array di campo
     */
    function campiNecessariProssimoPasso($idRichiesta) {
        //primo step mi tiro su la richiesta
        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')
            ->find($idRichiesta);
        //prendo lo status della richiesta
        $status = $richiesta->getStatus();
        //mi preparo a ciclare sui campi
        $repository = $this->em->getRepository('estarRdaBundle:Campo');
        $toReturn = array();
        if ($status == RichiestaModel::STATUS_BOZZA) {
            $toReturn = $repository->findBy(array('obbligatorioinserzione' => 1));
        }
        if ($status == RichiestaModel::STATUS_ATTESA_VAL_TEC) {
            $toReturn = $repository->findBy(array('obbligatoriovalidazionetecnica' => 1));
        }
        if ($status == RichiestaModel::STATUS_ATTESA_VAL_AMM) {
            $toReturn = $repository->findBy(array('obbligatoriovalidazioneamministrativa' => 1));
        }
        return $toReturn;
    }

    /** metodo che restituisce uno status per la richiesta
     *
     * @return una stringa con tutte le eccezioni
     */



    /** metodo che restituisce gli stati a cui la richiesta pu� transire
     *
     * @return un array con il nome dei campi cos� come definiti nella macchina a stati
     */


    /** METODONE che ci dice se una richiesta pu� o non pu� avanzare allo stato indicato
     *
     * @return true or false
     */
    public function puoAvanzare($idRichiesta, $nuovostatus) {
        //tiro su la richiesta
        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')
            ->find($idRichiesta);
        //prendo lo status della richiesta
        $vecchiostatus = $richiesta->getStatus();

        //punto primo: una richiesta pu� sempre andare indietro.
        if ($nuovostatus == RichiestaModel::STATUS_BOZZA) return true;
        if ($nuovostatus == RichiestaModel::STATUS_ATTESA_VAL_TEC && $vecchiostatus==RichiestaModel::STATUS_ATTESA_VAL_AMM) return true;;
        //TODO da finire!
    }


    /** Avanza una richiesta allo stato indicato
     *
     */


    /**
     * ritorna un elenco di categorie che l'utente pu� accedere
     *
     * @return array(Categoria) un array di categorie
     */
    public function getCategorieByUser() {
        $usercheck = $this->get("usercheck.notify");

        $utente = $usercheck->getUtente();
        $toReturn = array();

        //Se l'utente non � loggato (caso che non dovrebbe mai succedere) ritorno l'array vuoto
        //metto la return qui per evitare successive bizze di NPE.
        if ($utente == null) return $toReturn;

        // check: se l'utente � amministratore di sistema, vede tutto.
        $utenteFos = $utente->getIdFosUser();

        if ($utenteFos->is_granted('ROLE_ADMIN')|| $utenteFos->is_granted('ROLE_SUPERADMIN')) {
            $query = $this->em->createQuery('select c.id, c.descrizione, a.nome as area from estarRdaBundle:Categoria c join c.idarea a where c.idarea = a.id');
            $categoria = $query->getResult();

        } else {
            //Altrimenti dobbiamo mostrare solo le categorie a cui ha accesso

            //FG20151211 messa la vista.
            $query = $this->em->
            createQuery('select v.idcategoria as id, v.descrizionecategoria as descrizione, v.nomearea as area from
                          estarRdaBundle:Vcategoriadirittiutente v where v.idutente= :utente')
                ->setParameter('utente', $utente->getId());
            $categoria=$query->getResult();

//            $query = $this->em->
//                createQuery('select c.id, c.descrizione, a.nome as area from estarRdaBundle:Categoria c join c.idarea a
//                  join estarRdaBundle:Categoriagruppo cg join estarRdaBundle:Utentegruppoutente ugu
//                  where c.idarea = a.id
//                  and c.id = cg.idcategoria
//                  and cg.idgruppoutente = ugu.idgruppoutente
//                  and ugu.idutente = :idutente');
//            $query->setParameter('idutente', $utente->getId());
//            $categoria = $query->getResult();

        }
        return $categoria;
    }


    /**
     * Processa la chiamata ricevuta da Sistematica
     * @param Utente $utente
     * @param DateTime $data
     * @param string $note
     * @param string $idpratica
     * @param string $codicestato
     * @return RispostaPerSistematica
     */
    public function getPratica($utente, $data, $note, $idpratica, $codicestato) {
        // Ci costruiamo l'oggetto risposta

        $risposta = new RispostaPerSistematica();
        //Ci prendiamo la data
        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataIter = new DateTime();
        $dataFornita = false;
        if (is_null($data)) {
            $dataIter = $dateTime->format(\DateTime::W3C);
            $dataFornita = false;
        } else {
            $dataIter = $data;
            $dataFornita = true;
        }



        //Prendiamo la richiesta

        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')->findOneBy(array('idpratica' => $idpratica));

        //Se la richiesta non è trovata, ritorniamo un messaggio di errore
        if (is_null($richiesta)) {
            $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
            $risposta->setCodiceErrore(RispostaPerSistematica::codiceErrorePraticaNonTrovata);
            $risposta->setDescrizioneErrore("Non è stata trovata alcuna pratica con id ".$idpratica);
            return $risposta;
        }

        //Passiamo a gestire i vari caso

        switch($codicestato){
            case '010':
                //valutazione tecnica
                //La richiesta passa in stato di valutazione tecnica
                //Tiriamo su la macchina a stati
                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('rifiutata_tec_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_tec_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;
            case '020':
                //valutazione amministrativa
                //La richiesta passa in stato di valutazione amministrativa
                //Tiriamo su la macchina a stati
                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('rifiutata_amm_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_amm_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;

            case '030':
                //attesa documentazione aggiuntiva

                //La richiesta passa in stato di valutazione amministrativa
                //Tiriamo su la macchina a stati
                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('rifiutata_amm_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_amm_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $risposta->setDataRisposta($dataIter);
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                    $risposta->setDataRisposta($dataIter);
                }
                //TODO: ricordiamoci di mettere un avviso via mail
                return $risposta;

            case '040':
                //rigetto pratica
                //La richiesta passa in stato di rifiutata ABS
                //Tiriamo su la macchina a stati
                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('chiusura_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('chiusura_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $risposta->setDataRisposta($dataIter);
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_CHIUSA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                    $risposta->setDataRisposta($dataIter);
                }
                return $risposta;

            case '050':
                //Assegnata programmazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INSERITA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ASSEGNATAPROGRAMMAZIONE);
                    $richiesta->setAnnoprogrammazione($note);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;
            case '060':
                //Istruttoria
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INSERITA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ISTRUTTORIA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;
            case '070':
                //Indizione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INSERITA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_INDIZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;

            case '080':
                //Valutazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INSERITA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_VALUTAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;

            case '090':
                //Aggiudicazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INSERITA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_VALUTAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataIter);
                return $risposta;

            case '100':
                //Chiusura (iter terminato)
                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('chiusura_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('evasione_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $risposta->setDataRisposta($dataIter);
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_CHIUSA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                    $risposta->setDataRisposta($dataIter);
                }
                return $risposta;

            case '110':
                //Annullato ABS
                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('annullamento_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('annullamento_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $risposta->setDataRisposta($dataIter);
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ANNULLATO);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                    $risposta->setDataRisposta($dataIter);
                }
                return $risposta;

            case '120':
                //Archiviato ABS

                $factory = $this->get('sm.factory');
                $articleSM = $factory->get($richiesta, 'rda');
                if ($articleSM->can('chiusura_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('evasione_ABS');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $risposta->setDataRisposta($dataIter);
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ARCHIVIATA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dataIter);
                    $iter->setDatafornita($dataFornita);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                    $risposta->setDataRisposta($dataIter);
                }
                return $risposta;

            default:
                //Codice non gestito. Ritorniamo errore.
                $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                $risposta->setDataRisposta($dataIter);
                return $risposta;
        }
    }
}

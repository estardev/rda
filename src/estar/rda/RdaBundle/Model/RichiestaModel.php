<?php

namespace estar\rda\RdaBundle\Model;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Iter;
use \Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use estar\rda\RdaBundle\Entity\Utente;


/**
 * Class RichiestaModel
 * serve per esporre metodi di comodit� per il trattamento delle richieste.
 * Gestisce la macchina a stati e la validazione
 *
 * @author Francesco Galli - francesco01.galli@estar.toscana.it
 *
 * @package estar\rda\RdaBundle\Model
 */
class RichiestaModel
{

    const STATUS_BOZZA = 'bozza';
    const STATUS_ATTESA_VAL_TEC='attesa_val_tec';
    const STATUS_ATTESA_VAL_AMM = 'attesa_val_amm';
    const STATUS_da_inviare_ABS = 'da_inviare_ABS';
    const STATUS_CHIUSA_ABS = "chiusa_ABS";
    const STATUS_EVASA_ABS = "evasa_ABS";

    const STATUSABS_CHIUSA = "Chiusa da ABS";
    const STATUSABS_ASSEGNATAPROGRAMMAZIONE = "In Programmazione";
    const STATUSABS_VALUTAZIONE = "In valutazione";
    const STATUSABS_ISTRUTTORIA = "In Istruttoria";
    const STATUSABS_INDIZIONE = "Gara Indetta";
    const STATUSABS_ANNULLATA = "Annullata da ABS";
    const STATUSABS_ARCHIVIATA = "Archiviata da ABS";

    protected $em;

    protected $user;

    protected $container;


    /** costruttore di default. Mi serve un entity manager e l'utente corrente
     * 20160223: aggiunti anche il service container e la session
     * @param EntityManager $em
     * @param Utente $user
     * @param ContainerInterface containerInterface
     */
    public function __construct(EntityManager $em, $user, ContainerInterface $containerInterface)
    {
        $this->em = $em;
        $this->user = $user;
        $this->container = $containerInterface;
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
        $usercheck = $this->container->get("usercheck.notify");
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
     * Ritorna tutte le richieste che un utente può vedere a seconda delle categorie.
     * @param $idCategoria
     * @param $dirittiRichiesta
     * @return array(Richiesta)
     */
    public function getRichiesteByUser($idCategoria, DirittiRichiesta $dirittiRichiesta) {

        //Primo passo: ci troviamo tutte le richieste della categoria.
        $entities = $this->em->getRepository('estarRdaBundle:Richiesta')->findBy(array('idcategoria' => $idCategoria));
        $utente = $dirittiRichiesta->getUser();
        $toReturn = array();
        //Se l'utente è validatore amministrativo
        if ($dirittiRichiesta->getIsVA()) {
            foreach($entities as $entity) {
                //Vede tutte quelle in attesa di validazione amministrativa
                if ($entity->getStatus() == RichiestaModel::STATUS_ATTESA_VAL_AMM) {
                    array_push($toReturn, $entity);
                    continue;
                }
                //Vede tutte quelle che ha inserito
                $iter = $this->em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idutente' => $utente->getId(),
                    'idrichiesta'=>$entity->getId()));
                if ($iter)
                    array_push($toReturn, $entity);
            }

        }

        //Se l'utente è validatore tenico
        if ($dirittiRichiesta->getIsVT()) {
            foreach($entities as $entity) {
                //Vede tutte quelle in attesa di validazione tecnica
                if ($entity->getStatus() == RichiestaModel::STATUS_ATTESA_VAL_TEC) {
                    array_push($toReturn, $entity);
                    continue;
                }
                //Vede tutte quelle che ha inserito
                $iter = $this->em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idutente' => $utente->getId(),
                    'idrichiesta'=>$entity->getId()));
                if ($iter)
                    array_push($toReturn, $entity);
            }
        }

        //Se l'utente è utente
        if ($dirittiRichiesta->getIsAI()) {
            //vede soltanto le sue
            //ciclo su richiesta, guardo per ogni richiesta se c'è un iter con utente = utente
            foreach($entities as $entity) {
                $iter = $this->em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idutente' => $utente->getId(),
                    'idrichiesta'=>$entity->getId()));
                if ($iter)
                    array_push($toReturn, $entity);

            }
        }

        return $toReturn;
    }

    /**
     * ritorna un elenco di categorie che l'utente pu� accedere
     *
     * @return array(Categoria) un array di categorie
     */
    public function getCategorieByUser() {
        $usercheck = $this->container->get("usercheck.notify");

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

        $dateRisposta = new \DateTime();
        $dateRisposta->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $dataRisposta = $dateRisposta->format(\DateTime::ATOM);

        $risposta = new RispostaPerSistematica();
        //Ci prendiamo la data
        //$time = strtotime($data);
        //$newformat = date('Y-m-d\TH:i:sP',$time);
        //file_put_contents(time()."_data.txt",
        //    $newformat
        //);
        //$dataFornita = false;
        if (empty($data)) {
            $dateTime = new \DateTime();
            $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
            $dataIter = $dateTime->format(\DateTime::ATOM);
           // file_put_contents("datanulla","ciao");
            $dataFornita = false;
        } else {
            //TODO convertire la $data in oggetto!!!!!
            $dateTime = new \DateTime($data, new \DateTimeZone('Europe/Rome'));
            $dataFornita = true;
           // file_put_contents("dataok","ciao");
        }



        //Prendiamo la richiesta

        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')->findOneBy(array('id' => $idpratica));

        //Se la richiesta non è trovata, ritorniamo un messaggio di errore
        if (is_null($richiesta)) {
            $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
            $risposta->setCodiceErrore(RispostaPerSistematica::codiceErrorePraticaNonTrovata);
            $risposta->setDescrizioneErrore("Non è stata trovata alcuna pratica con id ".$idpratica);
            return $risposta;
        }

        //Passiamo a gestire i vari caso
        //Tiriamo su la macchina a stati
        $factory = $this->container->get('sm.factory');
        $articleSM = $factory->get($richiesta, 'rda');

        switch($codicestato){
            case '010':
                //valutazione tecnica
                //La richiesta passa in stato di valutazione tecnica
                if ($articleSM->can('rifiutata_tec_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_tec_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica gg non può transire nello stato richiesto "); //.$articleSM->can('rifiutata_tec_ABS')." - ".$articleSM->getState());
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
            case '020':
                //valutazione amministrativa
                //La richiesta passa in stato di valutazione amministrativa
                if ($articleSM->can('rifiutata_amm_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_amm_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '030':
                //attesa documentazione aggiuntiva

                //La richiesta passa in stato di valutazione amministrativa
                if ($articleSM->can('rifiutata_amm_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_amm_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                //TODO: ricordiamoci di mettere un avviso via mail
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '040':
                //rigetto pratica
                //La richiesta passa in stato di rifiutata ABS
                if ($articleSM->can('chiusura_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('chiusura_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_CHIUSA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '050':
                //Assegnata programmazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_da_inviare_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ASSEGNATAPROGRAMMAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setAnnoprogrammazione($note);

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
            case '060':
                //Istruttoria
                if ($richiesta->getStatus() == RichiestaModel::STATUS_da_inviare_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ISTRUTTORIA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
            case '070':
                //Indizione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_da_inviare_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_INDIZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '080':
                //Valutazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_da_inviare_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_VALUTAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '090':
                //Aggiudicazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_da_inviare_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_VALUTAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '100':
                //Chiusura (iter terminato)
                if ($articleSM->can('chiusura_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('evasione_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_CHIUSA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");

                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '110':
                //Annullato ABS
                if ($articleSM->can('annullamento_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('annullamento_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ANNULLATO);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");

                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '120':
                //Archiviato ABS

                if ($articleSM->can('chiusura_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('evasione_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ARCHIVIATA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");

                    $this->em->persist($iter);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");

                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            default:
                //Codice non gestito. Ritorniamo errore.
                $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
        }
    }
}


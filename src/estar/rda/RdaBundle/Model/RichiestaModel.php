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
    const STATUS_ELIMINATA = 'eliminata';
    const STATUS_ANNULLATA = 'annullata';
    const STATUS_ATTESA_VAL_TEC = 'attesa_val_tec';
    const STATUS_ATTESA_VAL_AMM = 'attesa_val_amm';
    const STATUS_DA_INVIARE_ABS = 'da_inviare_ABS';
    const STATUS_INVIATA_ABS = 'inviata_ABS';
    const STATUS_CHIUSA_ABS = "chiusa_ABS";
    const STATUS_ANNULLATA_ABS = "annullata_ABS";
    const STATUS_EVASA_ABS = "evasa_ABS";

    const STATUSABS_RIGETTO = "Rigettata da ABS";
    const STATUSABS_ASSEGNATAPROGRAMMAZIONE = "In Programmazione";
    const STATUSABS_VALUTAZIONE = "In valutazione";
    const STATUSABS_AGGIUDICAZIONE = "Aggiudicazione";
    const STATUSABS_ISTRUTTORIA = "In Istruttoria";
    const STATUSABS_INDIZIONE = "Gara Indetta";
    const STATUSABS_ANNULLATA = "Pratica tornata in Istruttoria";
    const STATUSABS_ARCHIVIATA = "Archiviata da ABS";
    const STATUSABS_CHIUSA = "Chiusa da ABS per termine Iter";
    const STATUSABS_RICHIESTADOCUMENTAZIONE_RUP = "Richiesta documentazione Aggiuntiva da parte del RUP all'avvio della gara";

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
        $idUtente=$utente->getId();

        if ($dirittiRichiesta->getIsVA() AND $dirittiRichiesta->getIsAI() AND $dirittiRichiesta->getIsVT()){

            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idutente=:idutente OR r.status=:stato1 OR r.status=:stato2 OR r.status=:stato3 OR r.status=:stato4 OR r.status=:stato5 OR r.status=:stato6 OR r.status=:stato7 OR r.status=:stato8");
            $query->setParameters(array(
                'idutente'=> $idUtente,
                'stato1'=> RichiestaModel::STATUS_ATTESA_VAL_AMM,
                'stato2'=> RichiestaModel::STATUS_DA_INVIARE_ABS,
                'stato3'=> RichiestaModel::STATUS_INVIATA_ABS,
                'stato4' => RichiestaModel::STATUS_ATTESA_VAL_TEC,
                'stato5' => RichiestaModel::STATUS_ELIMINATA,
                'stato6' => RichiestaModel::STATUS_ANNULLATA,
                'stato7' => RichiestaModel::STATUS_CHIUSA_ABS,
                'stato8' => RichiestaModel::STATUS_ANNULLATA_ABS

            ));
            $richiesteutente = $query->getResult();
            return $richiesteutente;

        }else{


        //Se l'utente è validatore amministrativo
        if ($dirittiRichiesta->getIsVA()) {
            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idutente=:idutente OR r.status=:stato1 OR r.status=:stato2 OR r.status=:stato3");
            $query->setParameters(array(
                'idutente'=> $idUtente,
                'stato1'=> RichiestaModel::STATUS_ATTESA_VAL_AMM,
                'stato2'=> RichiestaModel::STATUS_DA_INVIARE_ABS,
                'stato3'=> RichiestaModel::STATUS_INVIATA_ABS,
            ));
            $richiesteutente = $query->getResult();

            //            foreach($entities as $entity) {
            //            //Vede tutte quelle in attesa di validazione amministrativa
            //            if ($entity->getStatus() == RichiestaModel::STATUS_ATTESA_VAL_AMM) {
            //                array_push($toReturn, $entity);
            //                continue;
            //            }
            //            //Vede tutte quelle che ha inserito
            //            $iter = $this->em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idutente' => $utente->getId(),
            //                'idrichiesta'=>$entity->getId()));
            //            if ($iter)
            //                array_push($toReturn, $entity);
            //        }
            return $richiesteutente;
        }

        //Se l'utente è validatore tenico
        if ($dirittiRichiesta->getIsVT()) {

            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idutente=:idutente OR r.status=:stato");
            $query->setParameters(array(
                'idutente'=> $idUtente,
                'stato'=> RichiestaModel::STATUS_ATTESA_VAL_TEC,
            ));
            $richiesteutente = $query->getResult();



            //          foreach($entities as $entity) {
            //              //Vede tutte quelle in attesa di validazione tecnica
            //              if ($entity->getStatus() == RichiestaModel::STATUS_ATTESA_VAL_TEC) {
            //                  array_push($toReturn, $entity);
            //                  continue;
            //              }
            //              //Vede tutte quelle che ha inserito
            //              $iter = $this->em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idutente' => $utente->getId(),
            //                  'idrichiesta'=>$entity->getId()));
            //              if ($iter)
            //                  array_push($toReturn, $entity);
            //          }
            return $richiesteutente;
        }

        //Se l'utente è utente
        if ($dirittiRichiesta->getIsAI()) {
            //vede soltanto le sue
            //ciclo su richiesta, guardo per ogni richiesta se c'è un iter con utente = utente

            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idutente=:idutente");
            $query->setParameter('idutente', $idUtente);
            $richiesteutente = $query->getResult();


            //foreach($entities as $entity) {
            //    $iter = $this->em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idutente' => $utente->getId(),
            //        'idrichiesta'=>$entity->getId()));
            //    if ($iter)
            //        array_push($toReturn, $entity);
            //
            //}
            return $richiesteutente;
        }
        }

        //return $toReturn;
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
     * @param string $data
     * @param string $note
     * @param string $idpratica
     * @param string $codicestato
     * @param string $codicegara
     * @return RispostaPerSistematica
     */
    public function getPratica($utente, $data, $note, $idpratica, $codicestato, $codicegara) {
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
                    $richiesta->setPresentato(10);
                    $this->em->persist($richiesta);
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
                    $richiesta->setPresentato(9);
                    $this->em->persist($richiesta);
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
                    $richiesta->setPresentato(14);
                    $this->em->persist($richiesta);
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
                if ($articleSM->can('rigettata_ABS')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rigettata_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_RIGETTO);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setPresentato(11);
                    $this->em->persist($richiesta);
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
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ASSEGNATAPROGRAMMAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione('La pratica è stata programmata per l\'anno '.$note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setAnnoprogrammazione($note);
                    $richiesta->setPresentato(16);
                    $this->em->persist($richiesta);
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
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ABS) {
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
                    $richiesta->setPresentato(17);
                    $this->em->persist($richiesta);
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
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ABS AND !empty($codicegara)) {
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
                    $richiesta->setCodicegara($codicegara);
                    $richiesta->setPresentato(18);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    if($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ABS and empty($codicegara))
                        $risposta->setDescrizioneErrore("Non è stato indicato il codice Gara");
                    else
                        $risposta->setDescrizioneErrore("La pratica non può transire nello stato richiesto");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '080':
                //Valutazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ABS) {
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
                    $richiesta->setPresentato(19);
                    $this->em->persist($richiesta);
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
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ABS) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_AGGIUDICAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setPresentato(20);
                    $this->em->persist($richiesta);
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
                    $articleSM->apply('chiusura_ABS');
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
                    $richiesta->setPresentato(12);
                    $this->em->persist($richiesta);
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
                    //$articleSM->apply('annullamento_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_ANNULLATA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setCodicegara(null);
                    $richiesta->setPresentato(21);
                    $this->em->persist($richiesta);
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
                    $articleSM->apply('chiusura_ABS');
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
                    $richiesta->setPresentato(12);
                    $this->em->persist($richiesta);
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

            case '130':

                //if($richiesta->getCodicegara()==$codicegara)
                //    $idgara=true;
                //else
                //    $idgara=false;

                //attesa documentazione aggiuntiva RIP
                //La richiesta passa in stato di valutazione amministrativa
                if (($articleSM->can('rifiutata_amm_ABS')) AND !empty($codicegara)) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_amm_ABS');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSABS_RICHIESTADOCUMENTAZIONE_RUP);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setCodicegara($codicegara);
                    $richiesta->setPresentato(15);
                    $this->em->persist($richiesta);
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


            default:
                //Codice non gestito. Ritorniamo errore.
                $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                $risposta->setDescrizioneErrore("Il codice immesso non è gestito.");
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
        }
    }
}


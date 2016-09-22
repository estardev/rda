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
    const STATUS_DA_INVIARE_ESTAR = 'da_inviare_ESTAR';
    const STATUS_INVIATA_ESTAR = 'inviata_ESTAR';
    const STATUS_CHIUSA_ESTAR = "chiusa_ESTAR";
    const STATUS_ANNULLATA_ESTAR = "annullata_ESTAR";
    const STATUS_EVASA_ESTAR = "evasa_ESTAR";
    const STATUS_RIGETTO_ESTAR = "rigetto_ESTAR";

    const STATUSESTAR_RIGETTO = "Rigettata dal controllo Tecnico ESTAR";
    const STATUSESTAR_RIGETTO_AMM = "Rigettata dal controllo Amministrativo ESTAR";
    const STATUSESTAR_ASSEGNATAPROGRAMMAZIONE = "In Programmazione ESTAR";
    const STATUSESTAR_VALUTAZIONE = "In valutazione ESTAR";
    const STATUSESTAR_VALUTAZIONE_AMM = "In valutazione amministrativa ESTAR";
    const STATUSESTAR_VALUTAZIONE_TEC = "In valutazione tecnica ESTAR";
    const STATUSESTAR_AGGIUDICAZIONE = "Aggiudicazione ESTAR";
    const STATUSESTAR_ATTESA_TEC = "Attesa documentazione aggiuntiva Tecnica";
    const STATUSESTAR_ATTESA_AMM = "Attesa documentazione aggiuntiva Amministrativa";
    const STATUSESTAR_ATTESA_INV = "Inviata documentazione aggiuntiva";
    const STATUSESTAR_ISTRUTTORIA = "In Istruttoria ESTAR";
    const STATUSESTAR_ISTRUTTORIA_AMM = "In Istruttoria ESTAR Amministrativa";
    const STATUSESTAR_INDIZIONE = "Indizione";
    const STATUSESTAR_ANNULLATA = "Conferma pratica annullata ESTAR";
    const STATUSESTAR_ARCHIVIATA = "Archiviata da ESTAR";
    const STATUSESTAR_CHIUSA = "Chiusa da ESTAR per termine Iter";
    const STATUSESTAR_RICHIESTADOCUMENTAZIONE_RUP = "Richiesta documentazione (RUP)";

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

            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idcategoria=:idcategoria AND (r.idutente=:idutente OR r.status=:stato1 OR r.status=:stato2 OR r.status=:stato3 OR r.status=:stato4 OR r.status=:stato5 OR r.status=:stato6 OR r.status=:stato7 OR r.status=:stato8 OR r.status=:stato9)");
            $query->setParameters(array(
                'idcategoria'=> $idCategoria,
                'idutente'=> $idUtente,
                'stato1'=> RichiestaModel::STATUS_ATTESA_VAL_AMM,
                'stato2'=> RichiestaModel::STATUS_DA_INVIARE_ESTAR,
                'stato3'=> RichiestaModel::STATUS_INVIATA_ESTAR,
                'stato4' => RichiestaModel::STATUS_ATTESA_VAL_TEC,
                'stato5' => RichiestaModel::STATUS_ELIMINATA,
                'stato6' => RichiestaModel::STATUS_ANNULLATA,
                'stato7' => RichiestaModel::STATUS_CHIUSA_ESTAR,
                'stato8' => RichiestaModel::STATUS_ANNULLATA_ESTAR,
                'stato9' => RichiestaModel::STATUS_RIGETTO_ESTAR,


            ));
            $richiesteutente = $query->getResult();
            return $richiesteutente;

        }else{


        //Se l'utente è validatore amministrativo
        if ($dirittiRichiesta->getIsVA()) {
            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idcategoria=:idcategoria AND (r.idutente=:idutente OR r.status=:stato1 OR r.status=:stato2 OR r.status=:stato3)");
            $query->setParameters(array(
                'idcategoria'=>$idCategoria,
                'idutente'=> $idUtente,
                'stato1'=> RichiestaModel::STATUS_ATTESA_VAL_AMM,
                'stato2'=> RichiestaModel::STATUS_DA_INVIARE_ESTAR,
                'stato3'=> RichiestaModel::STATUS_INVIATA_ESTAR,
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

            $query = $this->em->createQuery("SELECT r FROM estarRdaBundle:Richiesta r WHERE r.idcategoria=:idcategoria AND (r.idutente=:idutente OR r.status=:stato)");
            $query->setParameters(array(
                'idcategoria'=>$idCategoria,
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
            $dateTime->modify('+ 2 hours');
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

        $iter= new Iter();

        switch($codicestato){
            case '010':
                //valutazione tecnica
                //La richiesta passa in stato di valutazione tecnica
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_VALUTAZIONE_TEC);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_VALUTAZIONE_TEC);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto"); //.$articleSM->can('rifiutata_tec_ESTAR')." - ".$articleSM->getState());
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
               case '020':
                //valutazione amministrativa
                //La richiesta passa in stato di valutazione amministrativa
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_VALUTAZIONE_AMM);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_VALUTAZIONE_AMM);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                    //$iter= new Iter();
                    //$iter->setDastato($articleSM->getState());
                    //$articleSM->apply('rifiutata_amm_ESTAR');
                    //$iter->setAstato($articleSM->getState());
                    //$iter->setDastatogestav($richiesta->getStatusgestav());
                    //$iter->setAstatogestav($richiesta->getStatusgestav());
                    //$iter->setIdrichiesta($richiesta);
                    //$iter->setMotivazione($note);
                    //$iter->setDataora($dateTime);
                    //$iter->setIdutente($utente);
                    //$iter->setDatafornita($dataFornita);
                    //$risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    //$risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    //$risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    //$richiesta->setPresentato(9);
                    //$this->em->persist($richiesta);
                    //$this->em->persist($iter);
                    //$this->em->flush();

                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '030':
                //attesa documentazione aggiuntiva tecnica
                //La richiesta passa in stato di valutazione tecnica
                if ($articleSM->can('rifiutata_tec_ESTAR')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_tec_ESTAR');
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
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ATTESA_TEC);
                    $richiesta->setPresentato(14);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                //TODO: ricordiamoci di mettere un avviso via mail
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;
            case '031':
                    //attesa documentazione aggiuntiva amministrativa
                    //La richiesta passa in stato di valutazione amministrativa
                    if ($articleSM->can('rifiutata_amm_ESTAR')) {
                        $iter= new Iter();
                        $iter->setDastato($articleSM->getState());
                        $articleSM->apply('rifiutata_amm_ESTAR');
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
                        $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ATTESA_AMM);
                        $richiesta->setPresentato(14);
                        $richiesta->setCodicegara(null);
                        $this->em->persist($richiesta);
                        $this->em->persist($iter);
                        $this->em->flush();

                    } else {
                        //Non posso transire in quello stato
                        $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                        $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                        $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto "); //.$articleSM->can('rifiutata_tec_ESTAR')." - ".$articleSM->getState());
                    }
                    $risposta->setDataRisposta($dataRisposta);
                    return $risposta;

            case '040':
                //rigetto pratica controllo tecnico
                //La richiesta passa in stato di rifiutata ESTAR
                if ($articleSM->can('rigettata_ESTAR') or $richiesta->getStatus()=='rigetto_ESTAR') {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rigettata_ESTAR');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_RIGETTO);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_RIGETTO);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '041':
                //rigetto pratica controllo amministrativo
                //La richiesta passa in stato di rifiutata ESTAR
                if ($articleSM->can('rigettata_ESTAR') or $richiesta->getStatus()=='rigetto_ESTAR') {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rigettata_ESTAR');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_RIGETTO_AMM);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_RIGETTO_AMM);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '050':
                //Assegnata programmazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_ASSEGNATAPROGRAMMAZIONE) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_ASSEGNATAPROGRAMMAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione('La pratica è stata programmata per l\'anno '.$note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setAnnoprogrammazione($note);
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ASSEGNATAPROGRAMMAZIONE);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '060':
                //Istruttoria tecnica
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_ISTRUTTORIA) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_ISTRUTTORIA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ISTRUTTORIA);
                    $richiesta->setCodicegara($codicegara);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '061':
                //Istruttoria amministrativa
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_ISTRUTTORIA_AMM) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_ISTRUTTORIA_AMM);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ISTRUTTORIA_AMM);
                    $richiesta->setCodicegara($codicegara);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '070':
                //Indizione
                if (($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR AND !empty($codicegara)) or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_INDIZIONE) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_INDIZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_INDIZIONE);
                    $richiesta->setCodicegara($codicegara);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    if($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR and empty($codicegara))
                        $risposta->setDescrizioneErrore("Non è stato indicato il codice Gara");
                    else
                        $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '080':
                //Valutazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_VALUTAZIONE) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_VALUTAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_VALUTAZIONE);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '090':
                //Aggiudicazione
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_AGGIUDICAZIONE) {
                    $iter= new Iter();
                    $iter->setDastato($richiesta->getStatus());
                    $iter->setAstato($richiesta->getStatus());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_AGGIUDICAZIONE);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_AGGIUDICAZIONE);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '100':
                //Chiusura (iter terminato)
                if ($articleSM->can('chiusura_ESTAR') or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_CHIUSA or $richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR ) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('chiusura_ESTAR');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_CHIUSA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_CHIUSA);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");

                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

            case '110':
                //Annullato ESTAR
                if ($richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR or $articleSM->can('annullamento_ESTAR') or $richiesta->getStatus()==RichiestaModel::STATUS_ANNULLATA) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    //$articleSM->apply('annullamento_ESTAR');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_ANNULLATA);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_ANNULLATA);
                    $richiesta->setCodicegara(null);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");

                }
                $risposta->setDataRisposta($dataRisposta);
                return $risposta;

    // //      case '120':
     //          //Archiviato ESTAR
     //          if ($articleSM->can('chiusura_ESTAR') or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_ARCHIVIATA) {
     //              $iter= new Iter();
     //              $iter->setDastato($articleSM->getState());
     //              $articleSM->apply('chiusura_ESTAR');
     //              $iter->setAstato($articleSM->getState());
     //              $iter->setDastatogestav($richiesta->getStatusgestav());
     //              $iter->setAstatogestav(RichiestaModel::STATUSESTAR_ARCHIVIATA);
     //              $iter->setIdrichiesta($richiesta);
     //              $iter->setMotivazione($note);
     //              $iter->setDataora($dateTime);
     //              $iter->setIdutente($utente);
     //              $iter->setDatafornita($dataFornita);
     //              $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
     //              $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
     //              $risposta->setDescrizioneErrore("Pratica gestita correttamente");
     //              $richiesta->setPresentato(12);
     //              $this->em->persist($richiesta);
     //              $this->em->persist($iter);
     //              $this->em->flush();

     //          } else {
     //              //Non posso transire in quello stato
     //              $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
     //              $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
     //              $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");

     //          }
     //          $risposta->setDataRisposta($dataRisposta);
     //          return $risposta;

            case '130':

                //if($richiesta->getCodicegara()==$codicegara)
                //    $idgara=true;
                //else
                //    $idgara=false;

                //attesa documentazione aggiuntiva RIP
                //La richiesta passa in stato di valutazione amministrativa
                if ((($articleSM->can('rifiutata_amm_ESTAR')) AND !empty($codicegara)) or $iter->getAstatogestav()==RichiestaModel::STATUSESTAR_RICHIESTADOCUMENTAZIONE_RUP or $richiesta->getStatus() == RichiestaModel::STATUS_INVIATA_ESTAR ) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('rifiutata_amm_ESTAR');
                    $iter->setAstato($articleSM->getState());
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav(RichiestaModel::STATUSESTAR_RICHIESTADOCUMENTAZIONE_RUP);
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);
                    $iter->setDataora($dateTime);
                    $iter->setIdutente($utente);
                    $iter->setDatafornita($dataFornita);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreOK);
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $richiesta->setCodicegara($codicegara);
                    $richiesta->setStatusgestav(RichiestaModel::STATUSESTAR_RICHIESTADOCUMENTAZIONE_RUP);
                    $richiesta->setPresentato(15);
                    $this->em->persist($richiesta);
                    $this->em->persist($iter);
                    $this->em->flush();
                } else {
                    //Non posso transire in quello stato
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaErrore);
                    $risposta->setCodiceErrore(RispostaPerSistematica::codiceErroreStatoNonGestito);
                    $risposta->setDescrizioneErrore("La pratica ".$idpratica." non può transire nello stato richiesto ");
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


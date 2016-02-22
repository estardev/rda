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
     * $param Utente $utente
     * @param string $note
     * @param string $idpratica
     * @param string $codicestato
     * @return RispostaPerSistematica
     */
    public function getPratica($utente, $note, $idpratica, $codicestato) {
        // Ci costruiamo l'oggetto risposta

        $risposta = new RispostaPerSistematica();

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
                if ($articleSM->can('attesa_val_tec')) {
                    $iter= new Iter();
                    $iter->setDastato($articleSM->getState());
                    $articleSM->apply('attesa_val_tec');
                    $iter->setAstato($articleSM->getState());
                    $risposta->setCodiceRisposta(RispostaPerSistematica::codiceRispostaOk);
                    $risposta->setDescrizioneErrore("Pratica gestita correttamente");
                    $iter->setDastatogestav($richiesta->getStatusgestav());
                    $iter->setAstatogestav($richiesta->getStatusgestav());
                    $iter->setIdrichiesta($richiesta);
                    $iter->setMotivazione($note);




                }
            case '020':
                //valutazione amministrativa
            case '030':
                //attesa documentazione aggiuntiva
            case '040':
                //rigetto pratica
            case '050':
                //Assegnata programmazione
            case '060':
                //Istruttoria
            case '070':
                //Indizione
            case '080':
                //Valutazione
            case '090':
                //Aggiudicazione
            case '100':
                //Chiusura (iter terminato)
            case '110':
                //Annullato ABS
            case '120':
                //Archiviato ABS
            default:
                //Codice non gestito. Ritorniamo errore.
        }
    }
}

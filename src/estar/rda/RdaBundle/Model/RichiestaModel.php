<?php

namespace estar\rda\RdaBundle\Model;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Campo;


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

    /** costruttore di default. Mi serve un entity manager e l'utente corrente */
    public function __construct($em, $user)
    {
        $this->em = $em;
        $this->user = $user;
    }


    /** metodo che restituisce i campi da mostrare allo stato attuale
     *
     * @return un array di campo
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
            if ($campo->getObbligatorioinserzione()>=0 && isAbilitatoInserimento>0) {
                array_push($toReturn, $campo);
                continue;
            }
            //se non posso vederlo come utente abilitato ma come validatore tecnico si
            if ($campo->getObbligatoriovalidazionetecnica()>=0 && isValidatoreTecnico>0) {
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
     * @return un array di campo
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
        if ($status == RichiestaModel::STATUS_ATTESA_VALTEC) {
            $toReturn = $repository->findBy(array('obbligatoriovalidazionetecnica' => 1));
        }
        if ($status == RichiestaModel::STATUS_ATTESA_VALAMM) {
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

    /** Avanza una richiesta allo stato indicato
     *
     */

}

<?php
/**
 * Created by PhpStorm.
 * User: f.galli
 * Date: 28/10/2015
 * Time: 14.28
 */

namespace estar\rda\RdaBundle\Model;


/** Classe che rappresenta i diritti di una richiesta
 *
 */
class DirittiRichiesta
{

    private $isAI;


    private $isVA;


    private $isVT;

    /**
     * @return boolean true o false se è abilitato all'inserimento.
     */
    public function getIsAI()
    {
        return $this->isAI;
    }

    /**
     * @param mixed $isAI
     * @return DirittiRichiesta
     */
    public function setIsAI($isAI)
    {
        $this->isAI = $isAI;
        return $this;
    }

    /**
     * @return boolean true o false se è validatore amministrativo.
     */
    public function getIsVA()
    {
        return $this->isVA;
    }

    /**
     * @param mixed $isVA
     * @return DirittiRichiesta
     */
    public function setIsVA($isVA)
    {
        $this->isVA = $isVA;
        return $this;
    }

    /**
     * @return boolean true o false se è validatore tecnico
     */
    public function getIsVT()
    {
        return $this->isVT;
    }

    /**
     * @param mixed $isVT
     * @return DirittiRichiesta
     */
    public function setIsVT($isVT)
    {
        $this->isVT = $isVT;
        return $this;
    }

    /**
     * DirittiRichiesta constructor.
     */
    public function __construct()
    {
        $isAI = false;
        $isVA = false;
        $isVT = false;
    }

    /** funzione di comodo che mi dice se un campo è visualizzabile oppure no
     *
     * @param DirittiRichiesta $diritti
     * @param Campo $campo
     * @return boolean true or false
     */
    public function campoVisualizzabile($diritti,  $campo) {
        //TODO spostare nella classe DirittiRichiesta
        $isAbilitatoInserimento = $diritti->getIsAI();
        $isValidatoreTecnico = $diritti->getIsVT();;
        $isValidatoreAmministrativo = $diritti->getIsVA();

        $permessiInserzione = $campo->getObbligatorioinserzione();
        $permessiValidazionetecnica = $campo->getObbligatoriovalidazionetecnica();
        $permessiValidazioneAmministrativa = $campo->getObbligatoriovalidazioneamministrativa();

        //se posso vederlo come utente abilitato all'inserimento...
        if ($permessiInserzione>=0 && $isAbilitatoInserimento) {
            return true;
        }
        //se non posso vederlo come utente abilitato ma come validatore tecnico si
        if ($permessiValidazionetecnica>=0 && $isValidatoreTecnico) {
            return true;
        }
        //se non posso vederlo come utente abilitato o come validatore tecnico ma come validatore amministrativo si
        if ($permessiValidazioneAmministrativa>=0 && $isValidatoreAmministrativo) {
            return true;
        }
        return false;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: f.galli
 * Date: 28/10/2015
 * Time: 14.28
 */

namespace estar\rda\RdaBundle\Model;

use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Categoria;
use estar\rda\RdaBundle\Entity\Utente;

/** Classe che rappresenta i diritti di una richiesta
 *
 */
class DirittiRichiesta
{

    /**
     * @var bool
     */
    private $isAI;

    /**
     * @var bool
     */
    private $isRead;

    /**
     * @var bool
     */
    private $isVA;

    /**
     * @var bool
     */
    private $isVT;
    /**
     * @var Utente
     */
    private $user;

    /**
     * @var Categoria
     */
    private $categoria;

    /**
     * @return bool
     */
    public function isRead()
    {
        return $this->isRead;
    }

    /**
     * @param bool $isRead
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
    }

    /**
     * @return Utente
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Utente $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return boolean true o false se � abilitato all'inserimento.
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
     * @return boolean true o false se � validatore amministrativo.
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
     * @return boolean true o false se � validatore tecnico
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
     * @return Categoria
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param Categoria $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }


    /**
     * DirittiRichiesta constructor.
     */
    public function __construct()
    {
        $this->isAI = false;
        $this->isVA = false;
        $this->isVT = false;
        $this->isRead = false;
    }

    /** funzione di comodo che mi dice se un campo � visualizzabile oppure no
     *
     * @param DirittiRichiesta $diritti
     * @param Campo $campo
     * @return boolean true or false
     */
    public function campoVisualizzabile($diritti,  $campo) {
        //TODO spostare nella classe DirittiRichiesta
        $isAbilitatoInserimento = $diritti->getIsAI();
        $isValidatoreTecnico = $diritti->getIsVT();
        $isValidatoreAmministrativo = $diritti->getIsVA();
        $isRead = $diritti->isRead();
        $permessiInserzione = $campo->getObbligatorioinserzione();
        $permessiValidazionetecnica = $campo->getObbligatoriovalidazionetecnica();
        $permessiValidazioneAmministrativa = $campo->getObbligatoriovalidazioneamministrativa();

        //se posso vederlo come utente abilitato all'inserimento...
        if ($permessiInserzione>=0 and ($isAbilitatoInserimento or $isRead)) {
            return true;
        }
        //se non posso vederlo come utente abilitato ma come validatore tecnico si
        if ($permessiValidazionetecnica>=0 and ($isValidatoreTecnico or $isRead)) {
            return true;
        }
        //se non posso vederlo come utente abilitato o come validatore tecnico ma come validatore amministrativo si
        if ($permessiValidazioneAmministrativa>=0 and ($isValidatoreAmministrativo or $isRead)) {
            return true;
        }
        return false;
    }

}
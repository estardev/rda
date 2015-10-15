<?php

namespace estar\rda\RdaBundle\Entity;

/**
 * Utente
 */
class Utente
{
    /**
     * @var string
     */
    private $utenteldap;

    /**
     * @var string
     */
    private $utentecartaoperatore;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Azienda
     */
    private $idazienda;

    /**
     * @var \estar\rda\RdaBundle\Entity\FosUser
     */
    private $idfosuser;

    public function __toString(){return strval($this->getId());}
    /**
     * Set utenteldap
     *
     * @param string $utenteldap
     *
     * @return Utente
     */
    public function setUtenteldap($utenteldap)
    {
        $this->utenteldap = $utenteldap;
    
        return $this;
    }

    /**
     * Get utenteldap
     *
     * @return string
     */
    public function getUtenteldap()
    {
        return $this->utenteldap;
    }

    /**
     * Set utentecartaoperatore
     *
     * @param string $utentecartaoperatore
     *
     * @return Utente
     */
    public function setUtentecartaoperatore($utentecartaoperatore)
    {
        $this->utentecartaoperatore = $utentecartaoperatore;
    
        return $this;
    }

    /**
     * Get utentecartaoperatore
     *
     * @return string
     */
    public function getUtentecartaoperatore()
    {
        return $this->utentecartaoperatore;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idazienda
     *
     * @param \estar\rda\RdaBundle\Entity\Azienda $idazienda
     *
     * @return Utente
     */
    public function setIdazienda(\estar\rda\RdaBundle\Entity\Azienda $idazienda = null)
    {
        $this->idazienda = $idazienda;
    
        return $this;
    }

    /**
     * Get idazienda
     *
     * @return \estar\rda\RdaBundle\Entity\Azienda
     */
    public function getIdazienda()
    {
        return $this->idazienda;
    }

    /**
     * Set idfosuser
     *
     * @param \estar\rda\RdaBundle\Entity\FosUser $idfosuser
     *
     * @return Utente
     */
    public function setIdfosuser(\estar\rda\RdaBundle\Entity\FosUser $idfosuser = null)
    {
        $this->idfosuser = $idfosuser;
    
        return $this;
    }

    /**
     * Get idfosuser
     *
     * @return \estar\rda\RdaBundle\Entity\FosUser
     */
    public function getIdfosuser()
    {
        return $this->idfosuser;
    }
}


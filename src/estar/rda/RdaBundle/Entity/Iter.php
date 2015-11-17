<?php

namespace estar\rda\RdaBundle\Entity;

/**
 * Iter
 */
class Iter
{
    /**
     * @var \DateTime
     */
    private $dataora;

    /**
     * @var string
     */
    private $dastato;

    /**
     * @var string
     */
    private $astato;

    /**
     * @var string
     */
    private $motivazione;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Utente
     */
    private $idutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     */
    private $idrichiesta;


    /**
     * Set dataora
     *
     * @param \DateTime $dataora
     *
     * @return Iter
     */
    public function setDataora($dataora)
    {
        $this->dataora = $dataora;

        return $this;
    }

    /**
     * Get dataora
     *
     * @return \DateTime
     */
    public function getDataora()
    {
        return $this->dataora;
    }

    /**
     * Set dastato
     *
     * @param string $dastato
     *
     * @return Iter
     */
    public function setDastato($dastato)
    {
        $this->dastato = $dastato;

        return $this;
    }

    /**
     * Get dastato
     *
     * @return string
     */
    public function getDastato()
    {
        return $this->dastato;
    }

    /**
     * Set astato
     *
     * @param string $astato
     *
     * @return Iter
     */
    public function setAstato($astato)
    {
        $this->astato = $astato;

        return $this;
    }

    /**
     * Get astato
     *
     * @return string
     */
    public function getAstato()
    {
        return $this->astato;
    }

    /**
     * Set motivazione
     *
     * @param string $motivazione
     *
     * @return Iter
     */
    public function setMotivazione($motivazione)
    {
        $this->motivazione = $motivazione;

        return $this;
    }

    /**
     * Get motivazione
     *
     * @return string
     */
    public function getMotivazione()
    {
        return $this->motivazione;
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
     * Set idutente
     *
     * @param \estar\rda\RdaBundle\Entity\Utente $idutente
     *
     * @return Iter
     */
    public function setIdutente(\estar\rda\RdaBundle\Entity\Utente $idutente = null)
    {
        $this->idutente = $idutente;

        return $this;
    }

    /**
     * Get idutente
     *
     * @return \estar\rda\RdaBundle\Entity\Utente
     */
    public function getIdutente()
    {
        return $this->idutente;
    }

    /**
     * Set idrichiesta
     *
     * @param \estar\rda\RdaBundle\Entity\Richiesta $idrichiesta
     *
     * @return Iter
     */
    public function setIdrichiesta(\estar\rda\RdaBundle\Entity\Richiesta $idrichiesta = null)
    {
        $this->idrichiesta = $idrichiesta;

        return $this;
    }

    /**
     * Get idrichiesta
     *
     * @return \estar\rda\RdaBundle\Entity\Richiesta
     */
    public function getIdrichiesta()
    {
        return $this->idrichiesta;
    }
}

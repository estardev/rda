<?php

namespace estar\rda\RdaBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Iter
 * @ORM\Table(name="iter", indexes={@ORM\Index(name="idxidutente", columns={"idutente"}), @ORM\Index(name="idxidrichiesta", columns={"idrichiesta"})})
 * @ORM\Entity
 */
class Iter
{
    /**
     * @var \DateTime
     * @ORM\Column(name="dataora", type="datetime", nullable=true)
     */
    private $dataora;

    /**
     * @var string
     * @ORM\Column(name="dastato", type="string",length=100, nullable=true)
     */
    private $dastato;

    /**
     * @var string
     * @ORM\Column(name="astato", type="string",length=100, nullable=true)
     */
    private $astato;

    /**
     * @var string
     * @ORM\Column(name="motivazione", type="text",length=65535, nullable=true)
     */
    private $motivazione;

    /**
     * @var string
     * @ORM\Column(name="dastatogestav", type="string", length=100, nullable=true);
     */
    private $dastatogestav;

    /**
     * @var string
     * @ORM\Column(name="astatogestav", type="string", length=100, nullable=true);
     */
    private $astatogestav;
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Utente
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Utente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtente", referencedColumnName="id")
     * })
     */
    private $idutente;

    /**
     * @var string
     *
     * @ORM\Column(name="idGestav", type="string", length=100, nullable=true)
     */
    private $idgestav;

    /**
     * @var string
     *
     * @ORM\Column(name="dataProtocollo", type="string", length=100, nullable=true)
     */
    private $dataprotocollo;

    /**
     * @return string
     */
    public function getIdgestav()
    {
        return $this->idgestav;
    }

    /**
     * @param string $idgestav
     * @return Iter
     */
    public function setIdgestav($idgestav)
    {
        $this->idgestav = $idgestav;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataprotocollo()
    {
        return $this->dataprotocollo;
    }

    /**
     * @param string $dataprotocollo
     * @return Iter
     */
    public function setDataprotocollo($dataprotocollo)
    {
        $this->dataprotocollo = $dataprotocollo;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="urlProtocollo", type="string", length=255, nullable=true)
     */
    private $urlprotocollo;

    /**
     * @return string
     */
    public function getUrlprotocollo()
    {
        return $this->urlprotocollo;
    }

    /**
     * @param string $urlprotocollo
     * @return Richiesta
     */
    public function setUrlprotocollo($urlprotocollo)
    {
        $this->urlprotocollo = $urlprotocollo;
        return $this;
    }

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRichiesta", referencedColumnName="id")
     * })
     */
    private $idrichiesta;


    /**
     * @var boolean
     * @ORM\Column(name="datafornita", type="boolean", nullable=true)
     */
    private $datafornita;

    /**
     * @var string
     * @ORM\Column(name="numeroProtocollo", type="string", length=100, nullable=true)
     */
    private $numeroprotocollo;

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

    /**
     * @return string
     */
    public function getDastatogestav()
    {
        return $this->dastatogestav;
    }

    /**
     * @param string $dastatogestav
     * @return \estar\rda\RdaBundle\Entity\Iter
     */
    public function setDastatogestav($dastatogestav)
    {
        $this->dastatogestav = $dastatogestav;
        return $this;
    }

    /**
     * @return string
     */
    public function getAstatogestav()
    {
        return $this->astatogestav;
    }

    /**
     * @param string $astatogestav
     * @return Iter
     */
    public function setAstatogestav($astatogestav)
    {
        $this->astatogestav = $astatogestav;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isDatafornita()
    {
        return $this->datafornita;
    }

    /**
     * @param boolean $datafornita
     * @return Iter
     */
    public function setDatafornita($datafornita)
    {
        $this->datafornita = $datafornita;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumeroprotocollo()
    {
        return $this->numeroprotocollo;
    }

    /**
     * @param string $numeroprotocollo
     * @return Iter
     */
    public function setNumeroprotocollo($numeroprotocollo)
    {
        $this->numeroprotocollo = $numeroprotocollo;
        return $this;
    }



}

<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utente
 *
 * @ORM\Table(name="utente", indexes={@ORM\Index(name="fkUtenteAzienda1Idx", columns={"idAzienda"})})
 * @ORM\Entity
 */
class Utente
{
    /**
     * @var string
     *
     * @ORM\Column(name="utenteLdap", type="string", length=45, nullable=true)
     */
    private $utenteldap;

    /**
     * @var string
     *
     * @ORM\Column(name="utenteCartaOperatore", type="string", length=45, nullable=true)
     */
    private $utentecartaoperatore;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Azienda
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Azienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAzienda", referencedColumnName="id")
     * })
     */
    private $idazienda;


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
}

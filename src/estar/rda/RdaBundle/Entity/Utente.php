<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utente
 *
 * @ORM\Table(name="utente", indexes={@ORM\Index(name="fkUtenteAzienda1Idx", columns={"aziendaIdazienda"})})
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
     * @ORM\Column(name="idUtente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Azienda
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Azienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aziendaIdazienda", referencedColumnName="idazienda")
     * })
     */
    private $aziendaidazienda;



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
     * Get idutente
     *
     * @return integer
     */
    public function getIdutente()
    {
        return $this->idutente;
    }

    /**
     * Set aziendaidazienda
     *
     * @param \estar\rda\RdaBundle\Entity\Azienda $aziendaidazienda
     *
     * @return Utente
     */
    public function setAziendaidazienda(\estar\rda\RdaBundle\Entity\Azienda $aziendaidazienda = null)
    {
        $this->aziendaidazienda = $aziendaidazienda;

        return $this;
    }

    /**
     * Get aziendaidazienda
     *
     * @return \estar\rda\RdaBundle\Entity\Azienda
     */
    public function getAziendaidazienda()
    {
        return $this->aziendaidazienda;
    }
}

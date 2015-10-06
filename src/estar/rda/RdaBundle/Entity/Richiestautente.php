<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richiestautente
 *
 * @ORM\Table(name="richiestautente", indexes={@ORM\Index(name="fkRichiestaHasUtenteUtente1Idx", columns={"UtenteIdUtente"}), @ORM\Index(name="fkRichiestaHasUtenteRichiesta1Idx", columns={"RichiestaIdRichiesta"})})
 * @ORM\Entity
 */
class Richiestautente
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="creatore", type="boolean", nullable=true)
     */
    private $creatore;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validatoreTecnico", type="boolean", nullable=true)
     */
    private $validatoretecnico;

    /**
     * @var string
     *
     * @ORM\Column(name="validatoreAmministrativo", type="string", length=45, nullable=true)
     */
    private $validatoreamministrativo;

    /**
     * @var string
     *
     * @ORM\Column(name="referenteAbs", type="string", length=45, nullable=true)
     */
    private $referenteabs;

    /**
     * @var integer
     *
     * @ORM\Column(name="idRichiestautente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrichiestautente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Utente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Utente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UtenteIdUtente", referencedColumnName="idUtente")
     * })
     */
    private $utenteidutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RichiestaIdRichiesta", referencedColumnName="idRichiesta")
     * })
     */
    private $richiestaidrichiesta;


    public function __toString()
    {
    	return strval($this->getIdrichiestautente());
    }
    /**
     * Set creatore
     *
     * @param boolean $creatore
     *
     * @return Richiestautente
     */
    public function setCreatore($creatore)
    {
        $this->creatore = $creatore;

        return $this;
    }

    /**
     * Get creatore
     *
     * @return boolean
     */
    public function getCreatore()
    {
        return $this->creatore;
    }

    /**
     * Set validatoretecnico
     *
     * @param boolean $validatoretecnico
     *
     * @return Richiestautente
     */
    public function setValidatoretecnico($validatoretecnico)
    {
        $this->validatoretecnico = $validatoretecnico;

        return $this;
    }

    /**
     * Get validatoretecnico
     *
     * @return boolean
     */
    public function getValidatoretecnico()
    {
        return $this->validatoretecnico;
    }

    /**
     * Set validatoreamministrativo
     *
     * @param string $validatoreamministrativo
     *
     * @return Richiestautente
     */
    public function setValidatoreamministrativo($validatoreamministrativo)
    {
        $this->validatoreamministrativo = $validatoreamministrativo;

        return $this;
    }

    /**
     * Get validatoreamministrativo
     *
     * @return string
     */
    public function getValidatoreamministrativo()
    {
        return $this->validatoreamministrativo;
    }

    /**
     * Set referenteabs
     *
     * @param string $referenteabs
     *
     * @return Richiestautente
     */
    public function setReferenteabs($referenteabs)
    {
        $this->referenteabs = $referenteabs;

        return $this;
    }

    /**
     * Get referenteabs
     *
     * @return string
     */
    public function getReferenteabs()
    {
        return $this->referenteabs;
    }

    /**
     * Get idrichiestautente
     *
     * @return integer
     */
    public function getIdrichiestautente()
    {
        return $this->idrichiestautente;
    }

    /**
     * Set utenteidutente
     *
     * @param \estar\rda\RdaBundle\Entity\Utente $utenteidutente
     *
     * @return Richiestautente
     */
    public function setUtenteidutente(\estar\rda\RdaBundle\Entity\Utente $utenteidutente = null)
    {
        $this->utenteidutente = $utenteidutente;

        return $this;
    }

    /**
     * Get utenteidutente
     *
     * @return \estar\rda\RdaBundle\Entity\Utente
     */
    public function getUtenteidutente()
    {
        return $this->utenteidutente;
    }

    /**
     * Set richiestaidrichiesta
     *
     * @param \estar\rda\RdaBundle\Entity\Richiesta $richiestaidrichiesta
     *
     * @return Richiestautente
     */
    public function setRichiestaidrichiesta(\estar\rda\RdaBundle\Entity\Richiesta $richiestaidrichiesta = null)
    {
        $this->richiestaidrichiesta = $richiestaidrichiesta;

        return $this;
    }

    /**
     * Get richiestaidrichiesta
     *
     * @return \estar\rda\RdaBundle\Entity\Richiesta
     */
    public function getRichiestaidrichiesta()
    {
        return $this->richiestaidrichiesta;
    }
}

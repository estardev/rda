<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richiestautente
 *
 * @ORM\Table(name="richiestautente", indexes={@ORM\Index(name="fkRichiestaHasUtenteUtente1Idx", columns={"idUtente"}), @ORM\Index(name="fkRichiestaHasUtenteRichiesta1Idx", columns={"idRichiesta"})})
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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Utente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Utente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtente", referencedColumnName="id")
     * })
     */
    private $idutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRichiesta", referencedColumnName="id")
     * })
     */
    private $idrichiesta;


    public function __toString(){return strval($this->getId());}
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
     * @return Richiestautente
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
     * @return Richiestautente
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

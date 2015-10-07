<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriagruppo
 *
 * @ORM\Table(name="categoriagruppo", indexes={@ORM\Index(name="fkCategoriaHasGruppoUtenteGruppoUtente1Idx", columns={"idGruppoutente"}), @ORM\Index(name="fkCategoriaHasGruppoUtenteCategoria1Idx", columns={"idCategoria"})})
 * @ORM\Entity
 */
class Categoriagruppo
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="abilitatoInserimentoRichieste", type="boolean", nullable=true)
     */
    private $abilitatoinserimentorichieste;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validatoreTecnico", type="boolean", nullable=true)
     */
    private $validatoretecnico;

    /**
     * @var boolean
     *
     * @ORM\Column(name="validatoreAmministrativo", type="boolean", nullable=true)
     */
    private $validatoreamministrativo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="referenteAbs", type="boolean", nullable=true)
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
     * @var \estar\rda\RdaBundle\Entity\Gruppoutente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Gruppoutente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGruppoutente", referencedColumnName="id")
     * })
     */
    private $idgruppoutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    private $idcategoria;


    public function __toString(){return strval($this->getId());}
    /**
     * Set abilitatoinserimentorichieste
     *
     * @param boolean $abilitatoinserimentorichieste
     *
     * @return Categoriagruppo
     */
    public function setAbilitatoinserimentorichieste($abilitatoinserimentorichieste)
    {
        $this->abilitatoinserimentorichieste = $abilitatoinserimentorichieste;

        return $this;
    }

    /**
     * Get abilitatoinserimentorichieste
     *
     * @return boolean
     */
    public function getAbilitatoinserimentorichieste()
    {
        return $this->abilitatoinserimentorichieste;
    }

    /**
     * Set validatoretecnico
     *
     * @param boolean $validatoretecnico
     *
     * @return Categoriagruppo
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
     * @param boolean $validatoreamministrativo
     *
     * @return Categoriagruppo
     */
    public function setValidatoreamministrativo($validatoreamministrativo)
    {
        $this->validatoreamministrativo = $validatoreamministrativo;

        return $this;
    }

    /**
     * Get validatoreamministrativo
     *
     * @return boolean
     */
    public function getValidatoreamministrativo()
    {
        return $this->validatoreamministrativo;
    }

    /**
     * Set referenteabs
     *
     * @param boolean $referenteabs
     *
     * @return Categoriagruppo
     */
    public function setReferenteabs($referenteabs)
    {
        $this->referenteabs = $referenteabs;

        return $this;
    }

    /**
     * Get referenteabs
     *
     * @return boolean
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
     * Set idgruppoutente
     *
     * @param \estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente
     *
     * @return Categoriagruppo
     */
    public function setIdgruppoutente(\estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente = null)
    {
        $this->idgruppoutente = $idgruppoutente;

        return $this;
    }

    /**
     * Get idgruppoutente
     *
     * @return \estar\rda\RdaBundle\Entity\Gruppoutente
     */
    public function getIdgruppoutente()
    {
        return $this->idgruppoutente;
    }

    /**
     * Set idcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $idcategoria
     *
     * @return Categoriagruppo
     */
    public function setIdcategoria(\estar\rda\RdaBundle\Entity\Categoria $idcategoria = null)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return \estar\rda\RdaBundle\Entity\Categoria
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }
}

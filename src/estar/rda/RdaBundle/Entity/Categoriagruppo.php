<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriagruppo
 *
 * @ORM\Table(name="categoriagruppo", indexes={@ORM\Index(name="fkCategoriaHasGruppoUtenteGruppoUtente1Idx", columns={"gruppoUtenteIdGruppo"}), @ORM\Index(name="fkCategoriaHasGruppoUtenteCategoria1Idx", columns={"categoriaIdCategoria"})})
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
     * @ORM\Column(name="idCategoriagruppo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriagruppo;

    /**
     * @var \estar\rda\RdaBundle\Entity\Gruppoutente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Gruppoutente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gruppoUtenteIdGruppo", referencedColumnName="idGruppo")
     * })
     */
    private $gruppoutenteidgruppo;

    /**
     * @var \estar\rda\RdaBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoriaIdCategoria", referencedColumnName="idCategoria")
     * })
     */
    private $categoriaidcategoria;



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
     * Get idcategoriagruppo
     *
     * @return integer
     */
    public function getIdcategoriagruppo()
    {
        return $this->idcategoriagruppo;
    }

    /**
     * Set gruppoutenteidgruppo
     *
     * @param \estar\rda\RdaBundle\Entity\Gruppoutente $gruppoutenteidgruppo
     *
     * @return Categoriagruppo
     */
    public function setGruppoutenteidgruppo(\estar\rda\RdaBundle\Entity\Gruppoutente $gruppoutenteidgruppo = null)
    {
        $this->gruppoutenteidgruppo = $gruppoutenteidgruppo;

        return $this;
    }

    /**
     * Get gruppoutenteidgruppo
     *
     * @return \estar\rda\RdaBundle\Entity\Gruppoutente
     */
    public function getGruppoutenteidgruppo()
    {
        return $this->gruppoutenteidgruppo;
    }

    /**
     * Set categoriaidcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $categoriaidcategoria
     *
     * @return Categoriagruppo
     */
    public function setCategoriaidcategoria(\estar\rda\RdaBundle\Entity\Categoria $categoriaidcategoria = null)
    {
        $this->categoriaidcategoria = $categoriaidcategoria;

        return $this;
    }

    /**
     * Get categoriaidcategoria
     *
     * @return \estar\rda\RdaBundle\Entity\Categoria
     */
    public function getCategoriaidcategoria()
    {
        return $this->categoriaidcategoria;
    }
}

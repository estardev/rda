<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campo
 *
 * @ORM\Table(name="campo", indexes={@ORM\Index(name="fkCampoCategoria1Idx", columns={"categoriaIdCategoria"})})
 * @ORM\Entity
 */
class Campo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=100, nullable=true)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=45, nullable=true)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obbligatorioInserzione", type="boolean", nullable=true)
     */
    private $obbligatorioinserzione;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obbligatorioValidazione", type="boolean", nullable=true)
     */
    private $obbligatoriovalidazione;

    /**
     * @var integer
     *
     * @ORM\Column(name="idCampo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcampo;

    /**
     * @var \estar\rda\RdaBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoriaIdCategoria", referencedColumnName="idCategoria")
     * })
     */
    private $categoriaidcategoria;


    public function __toString()
    {
    	return strval($this->getIdcampo());
    }
    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Campo
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return Campo
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Campo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set obbligatorioinserzione
     *
     * @param boolean $obbligatorioinserzione
     *
     * @return Campo
     */
    public function setObbligatorioinserzione($obbligatorioinserzione)
    {
        $this->obbligatorioinserzione = $obbligatorioinserzione;

        return $this;
    }

    /**
     * Get obbligatorioinserzione
     *
     * @return boolean
     */
    public function getObbligatorioinserzione()
    {
        return $this->obbligatorioinserzione;
    }

    /**
     * Set obbligatoriovalidazione
     *
     * @param boolean $obbligatoriovalidazione
     *
     * @return Campo
     */
    public function setObbligatoriovalidazione($obbligatoriovalidazione)
    {
        $this->obbligatoriovalidazione = $obbligatoriovalidazione;

        return $this;
    }

    /**
     * Get obbligatoriovalidazione
     *
     * @return boolean
     */
    public function getObbligatoriovalidazione()
    {
        return $this->obbligatoriovalidazione;
    }

    /**
     * Get idcampo
     *
     * @return integer
     */
    public function getIdcampo()
    {
        return $this->idcampo;
    }

    /**
     * Set categoriaidcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $categoriaidcategoria
     *
     * @return Campo
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
    /**
     * @var integer
     */
    private $ordinamento;


    /**
     * Set ordinamento
     *
     * @param integer $ordinamento
     *
     * @return Campo
     */
    public function setOrdinamento($ordinamento)
    {
        $this->ordinamento = $ordinamento;

        return $this;
    }

    /**
     * Get ordinamento
     *
     * @return integer
     */
    public function getOrdinamento()
    {
        return $this->ordinamento;
    }
    /**
     * @var string
     */
    private $fieldset;


    /**
     * Set fieldset
     *
     * @param string $fieldset
     *
     * @return Campo
     */
    public function setFieldset($fieldset)
    {
        $this->fieldset = $fieldset;

        return $this;
    }

    /**
     * Get fieldset
     *
     * @return string
     */
    public function getFieldset()
    {
        return $this->fieldset;
    }
}

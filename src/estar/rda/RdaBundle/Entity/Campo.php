<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campo
 *
 * @ORM\Table(name="campo", indexes={@ORM\Index(name="fkCampoCategoria1Idx", columns={"idCategoria"})})
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
     * @ORM\Column(name="obbligatorioValidazioneTecnica", type="boolean", nullable=true)
     */
    private $obbligatoriovalidazionetecnica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordinamento", type="integer", nullable=true)
     */
    private $ordinamento;

    /**
     * @var string
     *
     * @ORM\Column(name="fieldset", type="text", length=65535, nullable=true)
     */
    private $fieldset;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obbligatorioValidazioneAmministrativa", type="boolean", nullable=true)
     */
    private $obbligatoriovalidazioneamministrativa;

    /**
     * @var string
     *
     * @ORM\Column(name="padre", type="string", length=255, nullable=true)
     */
    private $padre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataAttivazione", type="datetime", nullable=true)
     */
    private $dataattivazione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataDismissione", type="datetime", nullable=true)
     */
    private $datadismissione;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    private $idcategoria;



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
     * Set obbligatoriovalidazionetecnica
     *
     * @param boolean $obbligatoriovalidazionetecnica
     *
     * @return Campo
     */
    public function setObbligatoriovalidazionetecnica($obbligatoriovalidazionetecnica)
    {
        $this->obbligatoriovalidazionetecnica = $obbligatoriovalidazionetecnica;

        return $this;
    }

    /**
     * Get obbligatoriovalidazionetecnica
     *
     * @return boolean
     */
    public function getObbligatoriovalidazionetecnica()
    {
        return $this->obbligatoriovalidazionetecnica;
    }

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

    /**
     * Set obbligatoriovalidazioneamministrativa
     *
     * @param boolean $obbligatoriovalidazioneamministrativa
     *
     * @return Campo
     */
    public function setObbligatoriovalidazioneamministrativa($obbligatoriovalidazioneamministrativa)
    {
        $this->obbligatoriovalidazioneamministrativa = $obbligatoriovalidazioneamministrativa;

        return $this;
    }

    /**
     * Get obbligatoriovalidazioneamministrativa
     *
     * @return boolean
     */
    public function getObbligatoriovalidazioneamministrativa()
    {
        return $this->obbligatoriovalidazioneamministrativa;
    }

    /**
     * Set padre
     *
     * @param string $padre
     *
     * @return Campo
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;

        return $this;
    }

    /**
     * Get padre
     *
     * @return string
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Set dataattivazione
     *
     * @param \DateTime $dataattivazione
     *
     * @return Campo
     */
    public function setDataattivazione($dataattivazione)
    {
        $this->dataattivazione = $dataattivazione;

        return $this;
    }

    /**
     * Get dataattivazione
     *
     * @return \DateTime
     */
    public function getDataattivazione()
    {
        return $this->dataattivazione;
    }

    /**
     * Set datadismissione
     *
     * @param \DateTime $datadismissione
     *
     * @return Campo
     */
    public function setDatadismissione($datadismissione)
    {
        $this->datadismissione = $datadismissione;

        return $this;
    }

    /**
     * Get datadismissione
     *
     * @return \DateTime
     */
    public function getDatadismissione()
    {
        return $this->datadismissione;
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
     * Set idcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $idcategoria
     *
     * @return Campo
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

    public function __toString(){return strval($this->getId());}
}

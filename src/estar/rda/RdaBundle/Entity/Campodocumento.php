<?php

namespace estar\rda\RdaBundle\Entity;

/**
 * Campodocumento
 */
class Campodocumento
{
    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $descrizione;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var boolean
     */
    private $obbligatorio;

    /**
     * @var integer
     */
    private $ordinamento;

    /**
     * @var string
     */
    private $fieldset;

    /**
     * @var string
     */
    private $ordinamentofieldset;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Documento
     */
    private $iddocumento;


    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Campodocumento
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
     * @return Campodocumento
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
     * @return Campodocumento
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
     * Set obbligatorio
     *
     * @param boolean $obbligatorio
     *
     * @return Campodocumento
     */
    public function setObbligatorio($obbligatorio)
    {
        $this->obbligatorio = $obbligatorio;

        return $this;
    }

    /**
     * Get obbligatorio
     *
     * @return boolean
     */
    public function getObbligatorio()
    {
        return $this->obbligatorio;
    }

    /**
     * Set ordinamento
     *
     * @param integer $ordinamento
     *
     * @return Campodocumento
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
     * @return Campodocumento
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
     * Set ordinamentofieldset
     *
     * @param string $ordinamentofieldset
     *
     * @return Campodocumento
     */
    public function setOrdinamentofieldset($ordinamentofieldset)
    {
        $this->ordinamentofieldset = $ordinamentofieldset;

        return $this;
    }

    /**
     * Get ordinamentofieldset
     *
     * @return string
     */
    public function getOrdinamentofieldset()
    {
        return $this->ordinamentofieldset;
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
     * Set iddocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Documento $iddocumento
     *
     * @return Campodocumento
     */
    public function setIddocumento(\estar\rda\RdaBundle\Entity\Documento $iddocumento = null)
    {
        $this->iddocumento = $iddocumento;

        return $this;
    }

    /**
     * Get iddocumento
     *
     * @return \estar\rda\RdaBundle\Entity\Documento
     */
    public function getIddocumento()
    {
        return $this->iddocumento;
    }
}


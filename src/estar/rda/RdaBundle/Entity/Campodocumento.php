<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campodocumento
 *
 * @ORM\Table(name="campodocumento", indexes={@ORM\Index(name="fkCampodocumentoDocumento1Idx", columns={"idDocumento"})})
 * @ORM\Entity
 */
class Campodocumento
{
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=255, nullable=true)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="obbligatorio", type="boolean", nullable=true)
     */
    private $obbligatorio;

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
     * @var string
     *
     * @ORM\Column(name="ordinamentoFieldset", type="string", length=255, nullable=true)
     */
    private $ordinamentofieldset;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Documento
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Documento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idDocumento", referencedColumnName="id")
     * })
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

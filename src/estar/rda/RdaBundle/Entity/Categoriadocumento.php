<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriadocumento
 *
 * @ORM\Table(name="categoriadocumento", indexes={@ORM\Index(name="fkCategoriaHasDocumentoDocumento1Idx", columns={"idDocumento"}), @ORM\Index(name="fkCategoriaHasDocumentoCategoria1Idx", columns={"idCategoria"})})
 * @ORM\Entity
 */
class Categoriadocumento
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="necessarioPerAbs", type="boolean", nullable=true)
     */
    private $necessarioperabs;

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
     * Set necessarioperabs
     *
     * @param boolean $necessarioperabs
     *
     * @return Categoriadocumento
     */
    public function setNecessarioperabs($necessarioperabs)
    {
        $this->necessarioperabs = $necessarioperabs;

        return $this;
    }

    /**
     * Get necessarioperabs
     *
     * @return boolean
     */
    public function getNecessarioperabs()
    {
        return $this->necessarioperabs;
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
     * @return Categoriadocumento
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

    /**
     * Set idcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $idcategoria
     *
     * @return Categoriadocumento
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

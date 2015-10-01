<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriadocumento
 *
 * @ORM\Table(name="categoriadocumento", indexes={@ORM\Index(name="fkCategoriaHasDocumentoDocumento1Idx", columns={"documentoIddocumento"}), @ORM\Index(name="fkCategoriaHasDocumentoCategoria1Idx", columns={"categoriaIdCategoria"})})
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
     * @ORM\Column(name="idCategoriadocumento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriadocumento;

    /**
     * @var \estar\rda\RdaBundle\Entity\Documento
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Documento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="documentoIddocumento", referencedColumnName="iddocumento")
     * })
     */
    private $documentoiddocumento;

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
     * Get idcategoriadocumento
     *
     * @return integer
     */
    public function getIdcategoriadocumento()
    {
        return $this->idcategoriadocumento;
    }

    /**
     * Set documentoiddocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Documento $documentoiddocumento
     *
     * @return Categoriadocumento
     */
    public function setDocumentoiddocumento(\estar\rda\RdaBundle\Entity\Documento $documentoiddocumento = null)
    {
        $this->documentoiddocumento = $documentoiddocumento;

        return $this;
    }

    /**
     * Get documentoiddocumento
     *
     * @return \estar\rda\RdaBundle\Entity\Documento
     */
    public function getDocumentoiddocumento()
    {
        return $this->documentoiddocumento;
    }

    /**
     * Set categoriaidcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $categoriaidcategoria
     *
     * @return Categoriadocumento
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

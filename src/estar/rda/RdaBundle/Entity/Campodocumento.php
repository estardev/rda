<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campodocumento
 *
 * @ORM\Table(name="campodocumento", indexes={@ORM\Index(name="fkCampodocumentoDocumento1Idx", columns={"documentoIddocumento"})})
 * @ORM\Entity
 */
class Campodocumento
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
     * @ORM\Column(name="tipo", type="string", length=45, nullable=true)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="idcampodocumento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcampodocumento;

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
     * Get idcampodocumento
     *
     * @return integer
     */
    public function getIdcampodocumento()
    {
        return $this->idcampodocumento;
    }

    /**
     * Set documentoiddocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Documento $documentoiddocumento
     *
     * @return Campodocumento
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
}

<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campodocumento
 *
 * @ORM\Table(name="campodocumento", indexes={@ORM\Index(name="fkCampodocumentoDocumento1Idx", columns={"idDocumento"}), @ORM\Index(name="idCampo", columns={"idCampo"})})
 * @ORM\Entity
 */
class Campodocumento
{
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
     * @var \estar\rda\RdaBundle\Entity\Campo
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Campo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCampo", referencedColumnName="id")
     * })
     */
    private $idcampo;

	public function __toString()
	{
		return strval($this->getId());
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

    /**
     * Set idcampo
     *
     * @param \estar\rda\RdaBundle\Entity\Campo $idcampo
     *
     * @return Campodocumento
     */
    public function setIdcampo(\estar\rda\RdaBundle\Entity\Campo $idcampo = null)
    {
        $this->idcampo = $idcampo;

        return $this;
    }

    /**
     * Get idcampo
     *
     * @return \estar\rda\RdaBundle\Entity\Campo
     */
    public function getIdcampo()
    {
        return $this->idcampo;
    }
}

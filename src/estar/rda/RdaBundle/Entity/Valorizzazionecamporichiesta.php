<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valorizzazionecamporichiesta
 *
 * @ORM\Table(name="valorizzazionecamporichiesta", indexes={@ORM\Index(name="fk_valorizzazioneCamporichiestaRichiesta1Idx", columns={"idRichiesta"}), @ORM\Index(name="fk_valorizzazioneCamporichiestaCampo1Idx", columns={"idCampo", "idCategoria"}), @ORM\Index(name="IDX_290A3F413ED374B7", columns={"idCampo"})})
 * @ORM\Entity
 */
class Valorizzazionecamporichiesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idCategoria", type="integer", nullable=false)
     */
    private $idcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="valore", type="string", length=45, nullable=true)
     */
    private $valore;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRichiesta", referencedColumnName="id")
     * })
     */
    private $idrichiesta;

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
     * Set idcategoria
     *
     * @param integer $idcategoria
     *
     * @return Valorizzazionecamporichiesta
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;

        return $this;
    }

    /**
     * Get idcategoria
     *
     * @return integer
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * Set valore
     *
     * @param string $valore
     *
     * @return Valorizzazionecamporichiesta
     */
    public function setValore($valore)
    {
        $this->valore = $valore;

        return $this;
    }

    /**
     * Get valore
     *
     * @return string
     */
    public function getValore()
    {
        return $this->valore;
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
     * Set idrichiesta
     *
     * @param \estar\rda\RdaBundle\Entity\Richiesta $idrichiesta
     *
     * @return Valorizzazionecamporichiesta
     */
    public function setIdrichiesta(\estar\rda\RdaBundle\Entity\Richiesta $idrichiesta = null)
    {
        $this->idrichiesta = $idrichiesta;

        return $this;
    }

    /**
     * Get idrichiesta
     *
     * @return \estar\rda\RdaBundle\Entity\Richiesta
     */
    public function getIdrichiesta()
    {
        return $this->idrichiesta;
    }

    /**
     * Set idcampo
     *
     * @param \estar\rda\RdaBundle\Entity\Campo $idcampo
     *
     * @return Valorizzazionecamporichiesta
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

<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valorizzazionecamporichiesta
 *
 * @ORM\Table(name="valorizzazionecamporichiesta", indexes={@ORM\Index(name="fk_valorizzazioneCamporichiestaRichiesta1Idx", columns={"RichiestaIdRichiesta"}), @ORM\Index(name="fk_valorizzazioneCamporichiestaCampo1Idx", columns={"campoIdCampo", "campoCategoriaIdCategoria"}), @ORM\Index(name="IDX_290A3F414305D38", columns={"campoIdCampo"})})
 * @ORM\Entity
 */
class Valorizzazionecamporichiesta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="campoCategoriaIdCategoria", type="integer", nullable=false)
     */
    private $campocategoriaidcategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="valore", type="string", length=45, nullable=true)
     */
    private $valore;

    /**
     * @var integer
     *
     * @ORM\Column(name="idvalorizzazioneCamporichiesta", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idvalorizzazionecamporichiesta;

    /**
     * @var \estar\rda\RdaBundle\Entity\Campo
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Campo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campoIdCampo", referencedColumnName="idCampo")
     * })
     */
    private $campoidcampo;

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RichiestaIdRichiesta", referencedColumnName="idRichiesta")
     * })
     */
    private $richiestaidrichiesta;


    public function __toString()
    {
    	return strval($this->getIdvalorizzazionecamporichiesta());
    }
    /**
     * Set campocategoriaidcategoria
     *
     * @param integer $campocategoriaidcategoria
     *
     * @return Valorizzazionecamporichiesta
     */
    public function setCampocategoriaidcategoria($campocategoriaidcategoria)
    {
        $this->campocategoriaidcategoria = $campocategoriaidcategoria;

        return $this;
    }

    /**
     * Get campocategoriaidcategoria
     *
     * @return integer
     */
    public function getCampocategoriaidcategoria()
    {
        return $this->campocategoriaidcategoria;
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
     * Get idvalorizzazionecamporichiesta
     *
     * @return integer
     */
    public function getIdvalorizzazionecamporichiesta()
    {
        return $this->idvalorizzazionecamporichiesta;
    }

    /**
     * Set campoidcampo
     *
     * @param \estar\rda\RdaBundle\Entity\Campo $campoidcampo
     *
     * @return Valorizzazionecamporichiesta
     */
    public function setCampoidcampo(\estar\rda\RdaBundle\Entity\Campo $campoidcampo = null)
    {
        $this->campoidcampo = $campoidcampo;

        return $this;
    }

    /**
     * Get campoidcampo
     *
     * @return \estar\rda\RdaBundle\Entity\Campo
     */
    public function getCampoidcampo()
    {
        return $this->campoidcampo;
    }

    /**
     * Set richiestaidrichiesta
     *
     * @param \estar\rda\RdaBundle\Entity\Richiesta $richiestaidrichiesta
     *
     * @return Valorizzazionecamporichiesta
     */
    public function setRichiestaidrichiesta(\estar\rda\RdaBundle\Entity\Richiesta $richiestaidrichiesta = null)
    {
        $this->richiestaidrichiesta = $richiestaidrichiesta;

        return $this;
    }

    /**
     * Get richiestaidrichiesta
     *
     * @return \estar\rda\RdaBundle\Entity\Richiesta
     */
    public function getRichiestaidrichiesta()
    {
        return $this->richiestaidrichiesta;
    }
}

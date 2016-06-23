<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valorizzazionecampodocumento
 *
 * @ORM\Table(name="valorizzazionecampodocumento", indexes={@ORM\Index(name="fk_valorizzazioneCampodocumentoRichiestaDocumento1Idx", columns={"IdRichiestadocumento"}), @ORM\Index(name="fk_valorizzazioneCampoCampodocumento1", columns={"idCampodocumento"})})
 * @ORM\Entity
 */
class Valorizzazionecampodocumento
{
    /**
     * @var string
     *
     * @ORM\Column(name="valore", type="string", length=65535, nullable=true)
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
     * @var \estar\rda\RdaBundle\Entity\Richiestadocumento
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiestadocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdRichiestadocumento", referencedColumnName="id")
     * })
     */
    private $idrichiestadocumento;

    /**
     * @var \estar\rda\RdaBundle\Entity\Campodocumento
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Campodocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCampodocumento", referencedColumnName="id")
     * })
     */
    private $idcampodocumento;



    /**
     * Set valore
     *
     * @param string $valore
     *
     * @return Valorizzazionecampodocumento
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
     * Set idrichiestadocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Richiestadocumento $idrichiestadocumento
     *
     * @return Valorizzazionecampodocumento
     */
    public function setIdrichiestadocumento(\estar\rda\RdaBundle\Entity\Richiestadocumento $idrichiestadocumento = null)
    {
        $this->idrichiestadocumento = $idrichiestadocumento;

        return $this;
    }

    /**
     * Get idrichiestadocumento
     *
     * @return \estar\rda\RdaBundle\Entity\Richiestadocumento
     */
    public function getIdrichiestadocumento()
    {
        return $this->idrichiestadocumento;
    }

    /**
     * Set idcampodocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Campodocumento $idcampodocumento
     *
     * @return Valorizzazionecampodocumento
     */
    public function setIdcampodocumento(\estar\rda\RdaBundle\Entity\Campodocumento $idcampodocumento = null)
    {
        $this->idcampodocumento = $idcampodocumento;

        return $this;
    }

    /**
     * Get idcampodocumento
     *
     * @return \estar\rda\RdaBundle\Entity\Campodocumento
     */
    public function getIdcampodocumento()
    {
        return $this->idcampodocumento;
    }

    public function __toString(){return strval($this->getId());}
}

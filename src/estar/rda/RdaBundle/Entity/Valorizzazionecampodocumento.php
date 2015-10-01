<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Valorizzazionecampodocumento
 *
 * @ORM\Table(name="valorizzazionecampodocumento", indexes={@ORM\Index(name="fk_valorizzazioneCampodocumentoRichiestaDocumento1Idx", columns={"richiestaDocumentoIdRichiestadocumento"}), @ORM\Index(name="fk_valorizzazioneCampoCampodocumento1", columns={"campodocumentoIdcampodocumento"})})
 * @ORM\Entity
 */
class Valorizzazionecampodocumento
{
    /**
     * @var string
     *
     * @ORM\Column(name="valore", type="string", length=45, nullable=true)
     */
    private $valore;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_valorizzazioneCampodocumentocol", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idValorizzazionecampodocumentocol;

    /**
     * @var \estar\rda\RdaBundle\Entity\Richiestadocumento
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiestadocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="richiestaDocumentoIdRichiestadocumento", referencedColumnName="idRichiestadocumento")
     * })
     */
    private $richiestadocumentoidrichiestadocumento;

    /**
     * @var \estar\rda\RdaBundle\Entity\Campodocumento
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Campodocumento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campodocumentoIdcampodocumento", referencedColumnName="idcampodocumento")
     * })
     */
    private $campodocumentoidcampodocumento;



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
     * Get idValorizzazionecampodocumentocol
     *
     * @return integer
     */
    public function getIdValorizzazionecampodocumentocol()
    {
        return $this->idValorizzazionecampodocumentocol;
    }

    /**
     * Set richiestadocumentoidrichiestadocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Richiestadocumento $richiestadocumentoidrichiestadocumento
     *
     * @return Valorizzazionecampodocumento
     */
    public function setRichiestadocumentoidrichiestadocumento(\estar\rda\RdaBundle\Entity\Richiestadocumento $richiestadocumentoidrichiestadocumento = null)
    {
        $this->richiestadocumentoidrichiestadocumento = $richiestadocumentoidrichiestadocumento;

        return $this;
    }

    /**
     * Get richiestadocumentoidrichiestadocumento
     *
     * @return \estar\rda\RdaBundle\Entity\Richiestadocumento
     */
    public function getRichiestadocumentoidrichiestadocumento()
    {
        return $this->richiestadocumentoidrichiestadocumento;
    }

    /**
     * Set campodocumentoidcampodocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Campodocumento $campodocumentoidcampodocumento
     *
     * @return Valorizzazionecampodocumento
     */
    public function setCampodocumentoidcampodocumento(\estar\rda\RdaBundle\Entity\Campodocumento $campodocumentoidcampodocumento = null)
    {
        $this->campodocumentoidcampodocumento = $campodocumentoidcampodocumento;

        return $this;
    }

    /**
     * Get campodocumentoidcampodocumento
     *
     * @return \estar\rda\RdaBundle\Entity\Campodocumento
     */
    public function getCampodocumentoidcampodocumento()
    {
        return $this->campodocumentoidcampodocumento;
    }
}

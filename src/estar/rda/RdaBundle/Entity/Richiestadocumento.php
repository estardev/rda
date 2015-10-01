<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richiestadocumento
 *
 * @ORM\Table(name="richiestadocumento", indexes={@ORM\Index(name="fkRichiestaHasDocumentoDocumento1Idx", columns={"documentoIddocumento"}), @ORM\Index(name="fkRichiestaHasDocumentoRichiesta1Idx", columns={"RichiestaIdRichiesta"})})
 * @ORM\Entity
 */
class Richiestadocumento
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataInvio", type="datetime", nullable=true)
     */
    private $datainvio;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroProtocollo", type="string", length=45, nullable=true)
     */
    private $numeroprotocollo;

    /**
     * @var string
     *
     * @ORM\Column(name="filePath", type="string", length=100, nullable=true)
     */
    private $filepath;

    /**
     * @var integer
     *
     * @ORM\Column(name="idRichiestadocumento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrichiestadocumento;

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
     * @var \estar\rda\RdaBundle\Entity\Richiesta
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="RichiestaIdRichiesta", referencedColumnName="idRichiesta")
     * })
     */
    private $richiestaidrichiesta;



    /**
     * Set datainvio
     *
     * @param \DateTime $datainvio
     *
     * @return Richiestadocumento
     */
    public function setDatainvio($datainvio)
    {
        $this->datainvio = $datainvio;

        return $this;
    }

    /**
     * Get datainvio
     *
     * @return \DateTime
     */
    public function getDatainvio()
    {
        return $this->datainvio;
    }

    /**
     * Set numeroprotocollo
     *
     * @param string $numeroprotocollo
     *
     * @return Richiestadocumento
     */
    public function setNumeroprotocollo($numeroprotocollo)
    {
        $this->numeroprotocollo = $numeroprotocollo;

        return $this;
    }

    /**
     * Get numeroprotocollo
     *
     * @return string
     */
    public function getNumeroprotocollo()
    {
        return $this->numeroprotocollo;
    }

    /**
     * Set filepath
     *
     * @param string $filepath
     *
     * @return Richiestadocumento
     */
    public function setFilepath($filepath)
    {
        $this->filepath = $filepath;

        return $this;
    }

    /**
     * Get filepath
     *
     * @return string
     */
    public function getFilepath()
    {
        return $this->filepath;
    }

    /**
     * Get idrichiestadocumento
     *
     * @return integer
     */
    public function getIdrichiestadocumento()
    {
        return $this->idrichiestadocumento;
    }

    /**
     * Set documentoiddocumento
     *
     * @param \estar\rda\RdaBundle\Entity\Documento $documentoiddocumento
     *
     * @return Richiestadocumento
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
     * Set richiestaidrichiesta
     *
     * @param \estar\rda\RdaBundle\Entity\Richiesta $richiestaidrichiesta
     *
     * @return Richiestadocumento
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

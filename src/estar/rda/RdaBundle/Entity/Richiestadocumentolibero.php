<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile as File;

/**
 * Richiestadocumento
 *
 * @ORM\Table(name="richiestadocumentolibero", indexes={@ORM\Index(name="fkRichiestaHasDocumentoLiberoRichiesta1Idx", columns={"idRichiesta"})})
 * @ORM\Entity
 *
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
 */
class Richiestadocumentolibero
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
     * @ORM\Column(name="idGestav", type="string", length=100, nullable=true)
     */
    private $idgestav;

    /**
     * @var string
     *
     * @ORM\Column(name="dataProtocollo", type="string", length=100, nullable=true)
     */
    private $dataprotocollo;

    /**
     * @return string
     */
    public function getIdgestav()
    {
        return $this->idgestav;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="urlProtocollo", type="string", length=255, nullable=true)
     */
    private $urlprotocollo;

    /**
     * @return string
     */
    public function getUrlprotocollo()
    {
        return $this->urlprotocollo;
    }

    /**
     * @param string $urlprotocollo
     * @return Richiesta
     */
    public function setUrlprotocollo($urlprotocollo)
    {
        $this->urlprotocollo = $urlprotocollo;
        return $this;
    }

    /**
     * @param string $idgestav
     * @return Richiestadocumentolibero
     */
    public function setIdgestav($idgestav)
    {
        $this->idgestav = $idgestav;
        return $this;
    }

    /**
     * @return string
     */
    public function getDataprotocollo()
    {
        return $this->dataprotocollo;
    }

    /**
     * @param string $dataprotocollo
     * @return Richiestadocumentolibero
     */
    public function setDataprotocollo($dataprotocollo)
    {
        $this->dataprotocollo = $dataprotocollo;
        return $this;
    }

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
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=100, nullable=true)
     */
    private $descrizione;

    public function __toString(){return strval($this->getId());}


    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="richiesta_documento", fileNameProperty="filePath")
     *
     * @var File
     */
    private $imageFile;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Richiestadocumentolibero
     */
    public function setImageFile($image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->datainvio = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
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
     * @return Richiestadocumento
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
     * @return string
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * @param string $descrizione
     * @return Richiestadocumentolibero
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }



    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="richiesta_documento", fileNameProperty="filePath")
     *
     * @var File $docFile
     */
    public $docFile;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $doc
     */
    public function setdocFile($doc = null)
    {
        $this->docFile = $doc;

        if ($doc) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->datainvio = new \DateTime('now');
        }
    }

    /**
     * @return File
     */
    public function getdocFile()
    {
        return $this->docFile;
    }


}

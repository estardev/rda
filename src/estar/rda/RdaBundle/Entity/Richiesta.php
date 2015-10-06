<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richiesta
 *
 * @ORM\Table(name="richiesta", indexes={@ORM\Index(name="fkRichiestaCategoriaIdx", columns={"idCategoria"}), @ORM\Index(name="fkRichiestaAzienda1Idx", columns={"idAzienda"})})
 * @ORM\Entity
 */
class Richiesta
{
    /**
     * @var string
     *
     * @ORM\Column(name="numeroPratica", type="string", length=45, nullable=true)
     */
    private $numeropratica;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroProtocollo", type="string", length=45, nullable=true)
     */
    private $numeroprotocollo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Categoria
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCategoria", referencedColumnName="id")
     * })
     */
    private $idcategoria;

    /**
     * @var \estar\rda\RdaBundle\Entity\Azienda
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Azienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAzienda", referencedColumnName="id")
     * })
     */
    private $idazienda;

	public function __toString()
	{
		return strval($this->getId());
	}

    /**
     * Set numeropratica
     *
     * @param string $numeropratica
     *
     * @return Richiesta
     */
    public function setNumeropratica($numeropratica)
    {
        $this->numeropratica = $numeropratica;

        return $this;
    }

    /**
     * Get numeropratica
     *
     * @return string
     */
    public function getNumeropratica()
    {
        return $this->numeropratica;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Richiesta
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set numeroprotocollo
     *
     * @param string $numeroprotocollo
     *
     * @return Richiesta
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $idcategoria
     *
     * @return Richiesta
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

    /**
     * Set idazienda
     *
     * @param \estar\rda\RdaBundle\Entity\Azienda $idazienda
     *
     * @return Richiesta
     */
    public function setIdazienda(\estar\rda\RdaBundle\Entity\Azienda $idazienda = null)
    {
        $this->idazienda = $idazienda;

        return $this;
    }

    /**
     * Get idazienda
     *
     * @return \estar\rda\RdaBundle\Entity\Azienda
     */
    public function getIdazienda()
    {
        return $this->idazienda;
    }
}

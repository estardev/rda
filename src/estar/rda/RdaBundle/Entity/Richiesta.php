<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richiesta
 *
 * @ORM\Table(name="richiesta", indexes={@ORM\Index(name="fkRichiestaCategoriaIdx", columns={"categoriaIdCategoria"}), @ORM\Index(name="fkRichiestaAzienda1Idx", columns={"aziendaIdazienda"})})
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
     * @ORM\Column(name="idRichiesta", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrichiesta;

    /**
     * @var \estar\rda\RdaBundle\Entity\Azienda
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Azienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aziendaIdazienda", referencedColumnName="idazienda")
     * })
     */
    private $aziendaidazienda;

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
     * Get idrichiesta
     *
     * @return integer
     */
    public function getIdrichiesta()
    {
        return $this->idrichiesta;
    }

    /**
     * Set aziendaidazienda
     *
     * @param \estar\rda\RdaBundle\Entity\Azienda $aziendaidazienda
     *
     * @return Richiesta
     */
    public function setAziendaidazienda(\estar\rda\RdaBundle\Entity\Azienda $aziendaidazienda = null)
    {
        $this->aziendaidazienda = $aziendaidazienda;

        return $this;
    }

    /**
     * Get aziendaidazienda
     *
     * @return \estar\rda\RdaBundle\Entity\Azienda
     */
    public function getAziendaidazienda()
    {
        return $this->aziendaidazienda;
    }

    /**
     * Set categoriaidcategoria
     *
     * @param \estar\rda\RdaBundle\Entity\Categoria $categoriaidcategoria
     *
     * @return Richiesta
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

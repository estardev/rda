<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria", indexes={@ORM\Index(name="idxidarea", columns={"idarea"})})
 * @ORM\Entity
 */
class Categoria
{
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Campo", mappedBy="idcategoria" ,cascade={"persist"})
     */

    private $campi;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=100, nullable=true)
     */
    private $descrizione;

    /**
     * @var string
     *
     * @ORM\Column(name="gruppogestav", type="string", length=100, nullable=true)
     */
    private $gruppogestav;

    /**
     * @var string
     *
     * @ORM\Column(name="nomegestav", type="string", length=45, nullable=true)
     */
    private $nomegestav;



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Area
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Area")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idarea", referencedColumnName="id")
     * })
     */
    private $idarea;


    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Categoria
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
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return Categoria
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string
     */
    public function getDescrizione()
    {
        return $this->descrizione;
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
     * Set idarea
     *
     * @param \estar\rda\RdaBundle\Entity\Area $idarea
     *
     * @return Categoria
     */
    public function setIdarea(\estar\rda\RdaBundle\Entity\Area $idarea = null)
    {
        $this->idarea = $idarea;

        return $this;
    }

    /**
     * Get idarea
     *
     * @return \estar\rda\RdaBundle\Entity\Area
     */
    public function getIdarea()
    {
        return $this->idarea;
    }

    public function __toString()
    {
        return strval($this->getId());
    }


    /**
     * @return mixed
     */
    public function getCampi()
    {
        return $this->campi;
    }


    public function __construct()
    {
        $this->campi = new ArrayCollection();
    }



    public function addCampus($campo)
    {
        if ( ! $this->campi->contains($campo) ) {
            $campo->setIdcategoria($this);
            $this->campi->add($campo);
        }
        return $this->campi;
    }
    public function removeCampus( $campo)
    {
        if ($this->campi->contains($campo)) {
            $this->campi->removeElement($campo);
        }
        return $this->campi;
    }
    /**
     * @param Collection $campi
     * @return $this
     */
    public function setCampi(Collection $campi)
    {
        $this->campi = $campi;
        return $this->campi;
    }

    /**
     * @return string
     */
    public function getGruppogestav()
    {
        return $this->gruppogestav;
    }

    /**
     * @param string $gruppogestav
     *
     * @return Categoria
     */
    public function setGruppogestav($gruppogestav)
    {
        $this->gruppogestav = $gruppogestav;
        return $this;
    }

    /**
     * @return string
     */
    public function getNomegestav()
    {
        return $this->nomegestav;
    }

    /**
     * @param string $nomegestav
     * @return Categoria
     */
    public function setNomegestav($nomegestav)
    {
        $this->nomegestav = $nomegestav;
        return $this;
    }


}

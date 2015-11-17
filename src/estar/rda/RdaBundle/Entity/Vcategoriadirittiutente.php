<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vista sulla categoria a cui ha accesso un utente
 *
 * @ORM\Table(name="vcategoriadirittiutente")
 * @ORM\Entity
 */
class Vcategoriadirittiutente
{
    /**
     * @var string
     *
     * @ORM\Column(name="nomearea", type="string", length=255, nullable=true)
     */
    private $nomearea;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizionearea", type="string", length=255, nullable=true)
     */
    private $descrizionearea;

    /**
     * @var string
     *
     * @ORM\Column(name="nomecategoria", type="string", length=255, nullable=true)
     */
    private $nomecategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizionecategoria", type="string", length=255, nullable=true)
     */
    private $descrizionecategoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="isabilitatoinserimento", type="integer", nullable=true)
     */
    private $isabilitatoinserimento;

    /**
     * @var integer
     *
     * @ORM\Column(name="isvalidatoretecnico", type="integer", nullable=true)
     */
    private $isvalidatoretecnico;

    /**
     * @var integer
     *
     * @ORM\Column(name="isvalidatoreamministrativo", type="integer", nullable=true)
     */
    private $isvalidatoreamministrativo;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="idutente", type="integer", nullable=true)
     */
    private $idutente;

    /**
     * @var integer
     * @ORM\Id
     * @ORM\Column(name="idcategoria", type="integer", nullable=true)
     */
    private $idcategoria;

    /**
     * @return int
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * @param int $idcategoria
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }

    /**
     * @return string
     */
    public function getDescrizionearea()
    {
        return $this->descrizionearea;
    }

    /**
     * @param string $descrizionearea
     */
    public function setDescrizionearea($descrizionearea)
    {
        $this->descrizionearea = $descrizionearea;
    }

    /**
     * @return string
     */
    public function getNomecategoria()
    {
        return $this->nomecategoria;
    }

    /**
     * @param string $nomecategoria
     */
    public function setNomecategoria($nomecategoria)
    {
        $this->nomecategoria = $nomecategoria;
    }

    /**
     * @return string
     */
    public function getDescrizionecategoria()
    {
        return $this->descrizionecategoria;
    }

    /**
     * @param string $descrizionecategoria
     */
    public function setDescrizionecategoria($descrizionecategoria)
    {
        $this->descrizionecategoria = $descrizionecategoria;
    }

    /**
     * @return int
     */
    public function getIsabilitatoinserimento()
    {
        return $this->isabilitatoinserimento;
    }

    /**
     * @param int $isabilitatoinserimento
     */
    public function setIsabilitatoinserimento($isabilitatoinserimento)
    {
        $this->isabilitatoinserimento = $isabilitatoinserimento;
    }

    /**
     * @return int
     */
    public function getIsvalidatoretecnico()
    {
        return $this->isvalidatoretecnico;
    }

    /**
     * @param int $isvalidatoretecnico
     */
    public function setIsvalidatoretecnico($isvalidatoretecnico)
    {
        $this->isvalidatoretecnico = $isvalidatoretecnico;
    }

    /**
     * @return int
     */
    public function getIsvalidatoreamministrativo()
    {
        return $this->isvalidatoreamministrativo;
    }

    /**
     * @param int $isvalidatoreamministrativo
     */
    public function setIsvalidatoreamministrativo($isvalidatoreamministrativo)
    {
        $this->isvalidatoreamministrativo = $isvalidatoreamministrativo;
    }

    /**
     * @return int
     */
    public function getIdutente()
    {
        return $this->idutente;
    }

    /**
     * @param int $idutente
     */
    public function setIdutente($idutente)
    {
        $this->idutente = $idutente;
    }


    /**
     * @return string
     */
    public function getNomearea()
    {
        return $this->nomearea;
    }

    /**
     * @param string $nomearea
     */
    public function setNomearea($nomearea)
    {
        $this->nomearea = $nomearea;
    }



    public function __toString(){return strval($this->getIdutente());}
}

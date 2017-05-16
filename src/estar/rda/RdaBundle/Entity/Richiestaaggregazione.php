<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Richiestaaggregazione
 *
 * @ORM\Table(name="richiestaaggregazione", indexes={@ORM\Index(name="fkRichiestaIdx", columns={"idRichiesta"}), @ORM\Index(name="fkRichiestaAzienda1Idx", columns={"idAzienda"})})
 * @ORM\Entity
 */
class Richiestaaggregazione
{
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
     * riferimento al map tra medici e ambulatori
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Richiesta",inversedBy="richiestaAggregazione")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idRichiesta", referencedColumnName="id")
     * })
     */
    private $idrichiesta;

    /**
     * @var \estar\rda\RdaBundle\Entity\Azienda
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Azienda")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idAzienda", referencedColumnName="id")
     * })
     */
    private $idazienda;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Categoria
     */
    public function getIdrichiesta()
    {
        return $this->idrichiesta;
    }

    /**
     * @param Categoria $idrichiesta
     */
    public function setIdrichiesta($idrichiesta)
    {
        $this->idrichiesta = $idrichiesta;
    }

    /**
     * @return Azienda
     */
    public function getIdazienda()
    {
        return $this->idazienda;
    }

    /**
     * @param Azienda $idazienda
     */
    public function setIdazienda($idazienda)
    {
        $this->idazienda = $idazienda;
    }



    public function __toString(){return strval($this->getId());}
}

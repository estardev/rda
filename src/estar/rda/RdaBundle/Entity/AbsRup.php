<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="abs_rup")
 * @ORM\Entity
 */
class AbsRup
{
    /**
     * @var string
     *
     * @ORM\Column(name="rup_descrizione", type="string", length=255, nullable=true)
     */
    private $rup_descrizione;

    /**
     * @var integer
     *
     * @ORM\Column(name="rup_id", type="string", length=15)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rup_id;

    /**
     * @return string
     */
    public function getRupDescrizione()
    {
        return $this->rup_descrizione;
    }

    /**
     * @param string $rup_descrizione
     */
    public function setRupDescrizione($rup_descrizione)
    {
        $this->rup_descrizione = $rup_descrizione;
    }

    /**
     * @return string
     */
    public function getRupId()
    {
        return $this->rup_id;
    }

    /**
     * @param string $rup_id
     */
    public function setRupId($rup_id)
    {
        $this->rup_id = $rup_id;
    }



    public function __toString(){return strval($this->getId());}
}

<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Area
 *
 * @ORM\Table(name="abs_programmatoria")
 * @ORM\Entity
 */
class AbsPro
{
    /**
     * @var string
     *
     * @ORM\Column(name="pro_cui", type="string", length=100, nullable=true)
     */
    private $pro_cui;

    /**
     * @var \estar\rda\RdaBundle\Entity\AbsRup
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\AbsRup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rup_id", referencedColumnName="rup_id")
     * })
     */
    private $rup_id;

    /**
     * @var integer
     *
     * @ORM\Column(name="pro_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $pro_id;

    /**
     * @var string
     * @ORM\Column(name="pro_oggetto_esteso", type="text", nullable=true)
     */
    private $pro_oggetto_esteso;

    /**
     * @var string
     * @ORM\Column(name="pro_prontoper_rda", type="string", length=1, nullable=true)
     */
    private $pro_prontoper_rda;

    /**
     * @var string
     * @ORM\Column(name="pro_note", type="text", nullable=true)
     */
    private $pro_note;

    /**
     * @var string
     *
     * @ORM\Column(name="ctr_id", type="string", length=15, nullable=true)
     */
    private $ctr_id;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_trasferito_rda", type="string", length=1, nullable=true)
     */
    private $pro_trasferito_rda;


    /**
     * @var string
     *
     * @ORM\Column(name="pro_protocollo_rda", type="string", length=1, nullable=true)
     */
    private $pro_protocollo_rda;


    /**
     * @var string
     *
     * @ORM\Column(name="pro_errore_rda", type="string", length=255, nullable=true)
     */
    private $pro_errore_rda;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pro_datatrasf_rda", type="datetime", nullable=true)
     */
    private $pro_datatrasf_rda;


    /**
     * @var string
     *
     * @ORM\Column(name="lpr_id", type="string", length=15, nullable=true)
     */
    private $lpr_id;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_importo_complessivo_ie", type="float", nullable=true)
     */
    private $pro_importo_complessivo_ie;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_utente_ins", type="string", length=50, nullable=true)
     */
    private $pro_utente_ins;

    /**
     * @var string
     *
     * @ORM\Column(name="pro_anno", type="string", length=4, nullable=true)
     */
    private $pro_anno;

    /**
     * @return string
     */
    public function getProCui()
    {
        return $this->pro_cui;
    }

    /**
     * @param string $pro_cui
     */
    public function setProCui($pro_cui)
    {
        $this->pro_cui = $pro_cui;
    }

    /**
     * @return AbsRup
     */
    public function getRupId()
    {
        return $this->rup_id;
    }

    /**
     * @param AbsRup $rup_id
     */
    public function setRupId($rup_id)
    {
        $this->rup_id = $rup_id;
    }

    /**
     * @return int
     */
    public function getProId()
    {
        return $this->pro_id;
    }

    /**
     * @param int $pro_id
     */
    public function setProId($pro_id)
    {
        $this->pro_id = $pro_id;
    }

    /**
     * @return string
     */
    public function getProOggettoEsteso()
    {
        return $this->pro_oggetto_esteso;
    }

    /**
     * @param string $pro_oggetto_esteso
     */
    public function setProOggettoEsteso($pro_oggetto_esteso)
    {
        $this->pro_oggetto_esteso = $pro_oggetto_esteso;
    }

    /**
     * @return string
     */
    public function getProNote()
    {
        return $this->pro_note;
    }

    /**
     * @param string $pro_note
     */
    public function setProNote($pro_note)
    {
        $this->pro_note = $pro_note;
    }

    /**
     * @return string
     */
    public function getCtrId()
    {
        return $this->ctr_id;
    }

    /**
     * @param string $ctr_id
     */
    public function setCtrId($ctr_id)
    {
        $this->ctr_id = $ctr_id;
    }

    /**
     * @return string
     */
    public function getLprId()
    {
        return $this->lpr_id;
    }

    /**
     * @param string $lpr_id
     */
    public function setLprId($lpr_id)
    {
        $this->lpr_id = $lpr_id;
    }

    /**
     * @return string
     */
    public function getProImportoComplessivoIe()
    {
        return $this->pro_importo_complessivo_ie;
    }

    /**
     * @param string $pro_importo_complessivo_ie
     */
    public function setProImportoComplessivoIe($pro_importo_complessivo_ie)
    {
        $this->pro_importo_complessivo_ie = $pro_importo_complessivo_ie;
    }

    /**
     * @return string
     */
    public function getProUtenteIns()
    {
        return $this->pro_utente_ins;
    }

    /**
     * @param string $pro_utente_ins
     */
    public function setProUtenteIns($pro_utente_ins)
    {
        $this->pro_utente_ins = $pro_utente_ins;
    }

    /**
     * @return string
     */
    public function getProAnno()
    {
        return $this->pro_anno;
    }

    /**
     * @param string $pro_anno
     */
    public function setProAnno($pro_anno)
    {
        $this->pro_anno = $pro_anno;
    }

    /**
     * @return string
     */
    public function getProProntoperRda()
    {
        return $this->pro_prontoper_rda;
    }

    /**
     * @param string $pro_prontoper_rda
     */
    public function setProProntoperRda($pro_prontoper_rda)
    {
        $this->pro_prontoper_rda = $pro_prontoper_rda;
    }

    /**
     * @return string
     */
    public function getProTrasferitoRda()
    {
        return $this->pro_trasferito_rda;
    }

    /**
     * @param string $pro_trasferito_rda
     */
    public function setProTrasferitoRda($pro_trasferito_rda)
    {
        $this->pro_trasferito_rda = $pro_trasferito_rda;
    }

    /**
     * @return string
     */
    public function getProProtocolloRda()
    {
        return $this->pro_protocollo_rda;
    }

    /**
     * @param string $pro_protocollo_rda
     */
    public function setProProtocolloRda($pro_protocollo_rda)
    {
        $this->pro_protocollo_rda = $pro_protocollo_rda;
    }

    /**
     * @return \DateTime
     */
    public function getProDatatrasfRda()
    {
        return $this->pro_datatrasf_rda;
    }

    /**
     * @param \DateTime $pro_datatrasf_rda
     */
    public function setProDatatrasfRda($pro_datatrasf_rda)
    {
        $this->pro_datatrasf_rda = $pro_datatrasf_rda;
    }

    /**
     * @return string
     */
    public function getProErroreRda()
    {
        return $this->pro_errore_rda;
    }

    /**
     * @param string $pro_errore_rda
     */
    public function setProErroreRda($pro_errore_rda)
    {
        $this->pro_errore_rda = $pro_errore_rda;
    }





    public function __toString(){return strval($this->getId());}
}

<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
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
     * @var \DateTime
     * @ORM\Column(name="dataora", type="datetime", nullable=true)
     */
    private $dataora;

    /**
     * @var \DateTime
     * @ORM\Column(name="dataUltimaModifica", type="datetime", nullable=true)
     */
    private $dataultimamodifica;

    /**
     * @ORM\OneToMany(targetEntity="estar\rda\RdaBundle\Entity\Richiestaaggregazione", mappedBy="idrichiesta", cascade={"persist"})
     */
    private $richiestaAggregazione;

    public function __construct() {
        $this->richiestaAggregazione = new ArrayCollection();
     }

    /**
     * @return ArrayCollection
     */
    public function getRichiestaaggregazione()
    {
        return $this->richiestaAggregazione;
    }

    public function addRichiestaaggregazioneon(Richiestaaggregazione $c)
    {
        $c->setIdrichiesta($this);
        $this->richiestaAggregazione->add($c);
    }

    public function removeRichiestaaggregazioneon(Richiestaaggregazione $c)
    {
        $this->richiestaAggregazione->removeElement($c);
    }

    /**
     * @return \DateTime
     */
    public function getDataora()
    {
        return $this->dataora;
    }

    /**
     * @param \DateTime $dataora
     * @return Richiesta
     */
    public function setDataora($dataora)
    {
        $this->dataora = $dataora;
        return $this;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="procui", type="string", length=255, nullable=true)
     */
    private $procui;

    /**
     * @var string
     *
     * @ORM\Column(name="prorupnome", type="string", length=255, nullable=true)
     */
    private $prorupnome;

    /**
     * @var string
     *
     * @ORM\Column(name="proutenteins", type="string", length=255, nullable=true)
     */
    private $proutenteins;

    /**
     * @var string
     *
     * @ORM\Column(name="proanno", type="string", length=255, nullable=true)
     */
    private $proanno;

    /**
     * @var string
     *
     * @ORM\Column(name="proid", type="string", length=255, nullable=true)
     */
    private $proid;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="string", length=255, nullable=true)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="documentazione", type="string", length=512, nullable=true)
     */
    private $documentazione;

    /**
     * @return boolean
     */
    public function isCp()
    {
        return $this->cp;
    }

    /**
     * @param boolean $cp
     */
    public function setCp($cp)
    {
        $this->cp = $cp;
    }

    /**
     * @var boolean
     *
     * @ORM\Column(name="cp", type="boolean", nullable=true)
     */
    private $cp;

    /**
     * @var boolean
     *
     * @ORM\Column(name="assenzaconflitto", type="boolean", nullable=true)
     */
    private $assenzaconflitto;

    /**
     * @return boolean
     */
    public function isAssenzaconflitto()
    {
        return $this->assenzaconflitto;
    }

    /**
     * @param boolean $assenzaconflitto
     */
    public function setAssenzaconflitto($assenzaconflitto)
    {
        $this->assenzaconflitto = $assenzaconflitto;
    }

    /**
     * @return \DateTime
     */
    public function getDataultimamodifica()
    {
        return $this->dataultimamodifica;
    }

    /**
     * @param \DateTime $dataultimamodifica
     */
    public function setDataultimamodifica($dataultimamodifica)
    {
        $this->dataultimamodifica = $dataultimamodifica;
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
     * @var string
     *
     * @ORM\Column(name="descrizione", type="text", length=65535, nullable=false)
     */
    private $descrizione;


    /**
     * @var string
     *
     * @ORM\Column(name="numeroPratica", type="string", length=255, nullable=true)
     */
    private $numeropratica;

    /**
     * @var string
     *
     * @ORM\Column(name="codiceGara", type="string", length=255, nullable=true)
     */
    private $codicegara;

    /**
     * @return string
     */
    public function getCodicegara()
    {
        return $this->codicegara;
    }

    /**
     * @param string $codicegara
     * @return Richiesta
     */
    public function setCodicegara($codicegara)
    {
        $this->codicegara = $codicegara;
        return $this;
    }

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
     * @param string $idgestav
     * @return Richiesta
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
     * @return Richiesta
     */
    public function setDataprotocollo($dataprotocollo)
    {
        $this->dataprotocollo = $dataprotocollo;
        return $this;
    }


    /**
     * @var string
     *
     * @ORM\Column(name="priorita", type="string", length=45, nullable=true)
     */
    private $priorita;

    /**
     * @var string
     *
     * @ORM\Column(name="prioritaGestav", type="string", length=45, nullable=true)
     */
    private $prioritaGestav;

    /**
     * @return string
     */
    public function getPrioritaGestav()
    {
        return $this->prioritaGestav;
    }

    /**
     * @param string $prioritaGestav
     */
    public function setPrioritaGestav($prioritaGestav)
    {
        $this->prioritaGestav = $prioritaGestav;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="numeroProtocollo", type="string", length=100, nullable=true)
     */
    private $numeroprotocollo;

    /**
     * @var string
     *
     * @ORM\Column(name="statusgestav", type="string", length=100, nullable=true)
     */
    private $statusgestav;

    /**
     * @var string
     * @ORM\Column(name="annoprogrammazione", type="string", length=100, nullable=true)
     */
    private $annoprogrammazione;


    /**
     * @var string
     *
     * @ORM\Column(name="Presentato", type="integer", options={"default" = 0})
     */
     private $presentato = 0;

    /**
     * @return string
     */
    public function getPresentato()
    {
        return $this->presentato;
    }

    /**
     * @param string $presentato
     * @return Richiesta
     */
    public function setPresentato($presentato)
    {
        $this->presentato = $presentato;
        return $this;
    }


    /**
     * @return string
     */
    public function getAnnoprogrammazione()
    {
        return $this->annoprogrammazione;
    }

    /**
     * @param string $annoprogrammazione
     * @return Richiesta
     */
    public function setAnnoprogrammazione($annoprogrammazione)
    {
        $this->annoprogrammazione = $annoprogrammazione;
        return $this;
    }

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
     * @var \estar\rda\RdaBundle\Entity\Utente
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Utente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtente", referencedColumnName="id")
     * })
     */
    private $idutente;

    /**
     * @return Utente
     */
    public function getIdutente()
    {
        return $this->idutente;
    }

    /**
     * @param Utente $idutente
     */
    public function setIdutente($idutente)
    {
        $this->idutente = $idutente;
    }


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
     * Set titolo
     *
     * @param string $titolo
     *
     * @return Richiesta
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;

        return $this;
    }

    /**
     * Get titolo
     *
     * @return string
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return Richiesta
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
     * Set statusgestav
     *
     * @param string $statusgestav
     *
     * @return Richiesta
     */
    public function setStatusgestav($statusgestav)
    {
        $this->statusgestav = $statusgestav;

        return $this;
    }

    /**
     * Get statusgestav
     *
     * @return string
     */
    public function getStatusgestav()
    {
        return $this->statusgestav;
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

    /**
     * @return string
     */
    public function getPriorita()
    {
        return $this->priorita;
    }

    /**
     * @param string $priorita
     * @return Richiesta
     */
    public function setPriorita($priorita)
    {
        $this->priorita = $priorita;

        return $this;
    }

    /**
     * @return string
     */
    public function getProcui()
    {
        return $this->procui;
    }

    /**
     * @param string $procui
     */
    public function setProcui($procui)
    {
        $this->procui = $procui;
    }

    /**
     * @return string
     */
    public function getProrupnome()
    {
        return $this->prorupnome;
    }

    /**
     * @param string $prorupnome
     */
    public function setProrupnome($prorupnome)
    {
        $this->prorupnome = $prorupnome;
    }

    /**
     * @return string
     */
    public function getProutenteins()
    {
        return $this->proutenteins;
    }

    /**
     * @param string $proutenteins
     */
    public function setProutenteins($proutenteins)
    {
        $this->proutenteins = $proutenteins;
    }

    /**
     * @return string
     */
    public function getProanno()
    {
        return $this->proanno;
    }

    /**
     * @param string $proanno
     */
    public function setProanno($proanno)
    {
        $this->proanno = $proanno;
    }

    /**
     * @return string
     */
    public function getProid()
    {
        return $this->proid;
    }

    /**
     * @param string $proid
     */
    public function setProid($proid)
    {
        $this->proid = $proid;
    }



    /**
     * Ritorna i valori possibili per la priorit�
     * @return array
     */
    public static function getPossibleEnumPriorita()
    {
        $choices = array(
            '1' => 'Emergenza',
            '2' => 'Elevata',
            '3' => 'Standard');
        return $choices;
    }

    /**
     * @return string
     */
    public function getDocumentazione()
    {
        return $this->documentazione;
    }

    /**
     * @param string $documentazione
     */
    public function setDocumentazione($documentazione)
    {
        $this->documentazione = $documentazione;
    }



    public function __toString(){return strval($this->getId());}
}

<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utente
 *
 * @ORM\Table(name="utente")
 * @ORM\Entity
 */
class Utente extends BaseUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="utenteLdap", type="string", length=255, nullable=true)
     */
    private $utenteldap;

    /**
     * @var string
     *
     * @ORM\Column(name="utenteCartaOperatore", type="string", length=255, nullable=true)
     */
    private $utentecartaoperatore;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;


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
     * @var string
     *
     * @ORM\Column(name="nomecognome", type="string", length=255, nullable=true)
     */
    private $nomecognome;


    /**
     * @var string
     */
    protected $codicefiscale;


    protected $idgruppoutente;

    protected $gruppiutente;



    /**
     * Set utenteldap
     *
     * @param string $utenteldap
     *
     * @return Utente
     */
    public function setUtenteldap($utenteldap)
    {
        $this->utenteldap = $utenteldap;

        return $this;
    }

    /**
     * Get utenteldap
     *
     * @return string
     */
    public function getUtenteldap()
    {
        return $this->utenteldap;
    }

    /**
     * Set utentecartaoperatore
     *
     * @param string $utentecartaoperatore
     *
     * @return Utente
     */
    public function setUtentecartaoperatore($utentecartaoperatore)
    {
        $this->utentecartaoperatore = $utentecartaoperatore;

        return $this;
    }

    /**
     * Get utentecartaoperatore
     *
     * @return string
     */
    public function getUtentecartaoperatore()
    {
        return $this->utentecartaoperatore;
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
     * @return mixed
     */
    public function getIdgruppoutente()
    {
        return $this->idgruppoutente;
    }

    /**
     * @param mixed $idgruppoutente
     */
    public function setIdgruppoutente($idgruppoutente)
    {
        $this->idgruppoutente = $idgruppoutente;
    }

    /**
     * @return mixed
     */
    public function getGruppiutente()
    {
        return $this->gruppiutente;
    }

    /**
     * @param mixed $gruppiutente
     */
    public function setGruppiutente($gruppiutente)
    {
        $this->gruppiutente = $gruppiutente;
    }

    /**
     * @return string
     */
    public function getCodicefiscale()
    {
        return $this->codicefiscale;
    }

    /**
     * @param string $codicefiscale
     */
    public function setCodicefiscale($codicefiscale)
    {
        $this->codicefiscale = $codicefiscale;
    }


    /**
     * Set idazienda
     *
     * @param \estar\rda\RdaBundle\Entity\Azienda $idazienda
     *
     * @return Utente
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
     * Set nomecognome
     *
     * @param string $nomecognome
     *
     * @return Utente
     */
    public function setNomecognome($nomecognome)
    {
        $this->nomecognome = $nomecognome;

        return $this;
    }

    /**
     * Get nomecognome
     *
     * @return string
     */
    public function getNomecognome()
    {
        return $this->nomecognome;
    }

    public function __toString()
    {
        return strval($this->getId());
    }


//    public function removeAnPatRemoton(CicotAnPatRemota $anamnesiPatologicaGenerale)
//    {
//        $this->anPatRemota->removeElement($anamnesiPatologicaGenerale);
//    }
    public function __construct()
    {
        parent::__construct();
        $this->utentegruppoutente = new ArrayCollection();
    }
}

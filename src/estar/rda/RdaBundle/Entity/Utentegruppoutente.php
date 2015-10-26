<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utentegruppoutente
 *
 * @ORM\Table(name="utentegruppoutente", indexes={@ORM\Index(name="fkGruppiUtenteHasUtenteUtente1Idx", columns={"idUtente"}), @ORM\Index(name="fkGruppiUtenteHasUtenteGruppiUtente1Idx", columns={"idGruppoutente"})})
 * @ORM\Entity
 */
class Utentegruppoutente
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="amministratore", type="boolean", nullable=true)
     */
    private $amministratore;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \estar\rda\RdaBundle\Entity\Utente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Utente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUtente", referencedColumnName="id")
     * })
     */
    private $idutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Gruppoutente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Gruppoutente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idGruppoutente", referencedColumnName="id")
     * })
     */
    private $idgruppoutente;



    /**
     * Set amministratore
     *
     * @param boolean $amministratore
     *
     * @return Utentegruppoutente
     */
    public function setAmministratore($amministratore)
    {
        $this->amministratore = $amministratore;

        return $this;
    }

    /**
     * Get amministratore
     *
     * @return boolean
     */
    public function getAmministratore()
    {
        return $this->amministratore;
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
     * Set idutente
     *
     * @param \estar\rda\RdaBundle\Entity\Utente $idutente
     *
     * @return Utentegruppoutente
     */
    public function setIdutente(\estar\rda\RdaBundle\Entity\Utente $idutente = null)
    {
        $this->idutente = $idutente;

        return $this;
    }

    /**
     * Get idutente
     *
     * @return \estar\rda\RdaBundle\Entity\Utente
     */
    public function getIdutente()
    {
        return $this->idutente;
    }

    /**
     * Set idgruppoutente
     *
     * @param \estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente
     *
     * @return Utentegruppoutente
     */
    public function setIdgruppoutente(\estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente = null)
    {
        $this->idgruppoutente = $idgruppoutente;

        return $this;
    }

    /**
     * Get idgruppoutente
     *
     * @return \estar\rda\RdaBundle\Entity\Gruppoutente
     */
    public function getIdgruppoutente()
    {
        return $this->idgruppoutente;
    }

    public function __toString(){return strval($this->getId());}
}

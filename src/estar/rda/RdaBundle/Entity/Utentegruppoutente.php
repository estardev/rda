<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utentegruppoutente
 *
 * @ORM\Table(name="utentegruppoutente", indexes={@ORM\Index(name="fkGruppiUtenteHasUtenteUtente1Idx", columns={"UtenteIdUtente"}), @ORM\Index(name="fkGruppiUtenteHasUtenteGruppiUtente1Idx", columns={"gruppoUtenteIdGruppo"})})
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
     * @ORM\Column(name="idUtentegruppoutente", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idutentegruppoutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Utente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Utente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="UtenteIdUtente", referencedColumnName="idUtente")
     * })
     */
    private $utenteidutente;

    /**
     * @var \estar\rda\RdaBundle\Entity\Gruppoutente
     *
     * @ORM\ManyToOne(targetEntity="estar\rda\RdaBundle\Entity\Gruppoutente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gruppoUtenteIdGruppo", referencedColumnName="idGruppo")
     * })
     */
    private $gruppoutenteidgruppo;



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
     * Get idutentegruppoutente
     *
     * @return integer
     */
    public function getIdutentegruppoutente()
    {
        return $this->idutentegruppoutente;
    }

    /**
     * Set utenteidutente
     *
     * @param \estar\rda\RdaBundle\Entity\Utente $utenteidutente
     *
     * @return Utentegruppoutente
     */
    public function setUtenteidutente(\estar\rda\RdaBundle\Entity\Utente $utenteidutente = null)
    {
        $this->utenteidutente = $utenteidutente;

        return $this;
    }

    /**
     * Get utenteidutente
     *
     * @return \estar\rda\RdaBundle\Entity\Utente
     */
    public function getUtenteidutente()
    {
        return $this->utenteidutente;
    }

    /**
     * Set gruppoutenteidgruppo
     *
     * @param \estar\rda\RdaBundle\Entity\Gruppoutente $gruppoutenteidgruppo
     *
     * @return Utentegruppoutente
     */
    public function setGruppoutenteidgruppo(\estar\rda\RdaBundle\Entity\Gruppoutente $gruppoutenteidgruppo = null)
    {
        $this->gruppoutenteidgruppo = $gruppoutenteidgruppo;

        return $this;
    }

    /**
     * Get gruppoutenteidgruppo
     *
     * @return \estar\rda\RdaBundle\Entity\Gruppoutente
     */
    public function getGruppoutenteidgruppo()
    {
        return $this->gruppoutenteidgruppo;
    }
}

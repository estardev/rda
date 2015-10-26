<?php

namespace estar\rda\RdaBundle\Entity;
//commento per modifica
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * FormTemplate
 * Entit� che astrae una form cos� come vista dalle richieste: si occupa di mostrare i campi adeguati
 * e gestisce i metodi di persistenza delle classi che astraggono il DB
 *
 * @ORM\Table(name="azienda")
 * @ORM\Entity
 */
class FormTemplate
{
    public function __toString()
    {
        return "Form Template";
    }

    /*
     * enumerato che rappresenta i documenti collegati alla richiesta
     */
    private $documenti;

    /**
     * @return ArrayCollection
     */
    public function getDocumenti()
    {
        return $this->documenti;
    }

    /**
     * @param ArrayCollection $documenti
     */
    public function setDocumenti($documenti)
    {
        $this->documenti = $documenti;
    }

    /*
     * enumerato che rappresenta i campi collegati alla richiesta
     */
    private $campi;

    /**
     * @return ArrayCollection
     */
    public function getCampi()
    {
        return $this->campi;
    }

    /**
     * @param ArrayCollection $campi
     */
    public function setCampi($campi)
    {
        $this->campi = $campi;
    }

    /** @var  la categoria su cui stiamo operando
     */
    private $idcategoria;

    /**
     * @return la
     */
    public function getIdcategoria()
    {
        return $this->idcategoria;
    }

    /**
     * @param $idcategoria
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }


    /**
     * costruttore di default
     * @param $idCategoria
     * @param $campi
     * @internal param id $idCategoria numerico della categoria da settare
     */
    public function __construct($idCategoria, $campi)
    {
        $this->idcategoria = $idCategoria;
        $this->campi = $campi;

    }


}

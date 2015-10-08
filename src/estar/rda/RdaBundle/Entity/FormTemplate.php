<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * FormTemplate
 * Entità che astrae una form così come vista dalle richieste: si occupa di mostrare i campi adeguati
 * e gestisce i metodi di persistenza delle classi che astraggono il DB
 *
 * @ORM\Table(name="azienda")
 * @ORM\Entity
 */
class FormTemplate
{
    public function __toString()
    {
        return "pippo";
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
     * @param la $idcategoria
     */
    public function setIdcategoria($idcategoria)
    {
        $this->idcategoria = $idcategoria;
    }


    /**
     * costruttore di default
     * @param idCategoria l'id numerico della categoria da settare
     */
    public function __construct($idCategoria)
    {
        //inizializziamo le collezioni
        $this->campi = new ArrayCollection();
        $this->documenti = new ArrayCollection();
        //Retrieve della categoria interessata
        $em = $this->getDoctrine()->getManager();

        //A partire dalla categoria, retrieve dei campi della categoria e valorizzazione della collezione

        //A partire dalla categoria, retrieve dei documenti della categoria e valorizzazione della collezione
        //TODO si fa poi
    }
}

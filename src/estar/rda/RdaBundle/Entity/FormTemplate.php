<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * FormTemplate
 * Entit� che astrae una form cos� come vista dalle richieste: si occupa di mostrare i campi adeguati
 * e gestisce i metodi di persistenza delle classi che astraggono il DB
 *
 *
 *
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


    private $idcategoria;


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
     * 
     */
    public function __construct($idCategoria, $campi)
    {
        $this->idcategoria = $idCategoria;
        $this->campi = $campi;

    }


}

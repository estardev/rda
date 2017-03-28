<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="regola")
 * @ORM\Entity
 */
class Categoria
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
     * @var string
     *
     * @ORM\Column(name="regola", type="string", length=100, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="campovalore", type="string", length=255, nullable=true)
     */
    private $campovalore;


    /**
     * @var string
     *
     * @ORM\Column(name="messaggio", type="string", length=255, nullable=true)
     */
    private $messaggio;

    /**
     * @var string
     *
     * @ORM\Column(name="transizione", type="string", length=100, nullable=true)
     */
    private $transizione;

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
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return string
     */
    public function getCampovalore()
    {
        return $this->campovalore;
    }

    /**
     * @param string $campovalore
     */
    public function setCampovalore($campovalore)
    {
        $this->campovalore = $campovalore;
    }

    /**
     * @return string
     */
    public function getMessaggio()
    {
        return $this->messaggio;
    }

    /**
     * @param string $messaggio
     */
    public function setMessaggio($messaggio)
    {
        $this->messaggio = $messaggio;
    }

    /**
     * @return string
     */
    public function getTransizione()
    {
        return $this->transizione;
    }

    /**
     * @param string $transizione
     */
    public function setTransizione($transizione)
    {
        $this->transizione = $transizione;
    }


}

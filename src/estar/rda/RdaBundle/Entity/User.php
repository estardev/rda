<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     */
    protected $nomecognome;
    /**
     * @var string
     */
    protected  $codicefiscale;

    /**
     * @var string
     */
    protected  $idazienda;


    protected $idgruppoutente;

    protected $gruppiutente;

    public function __construct()
    {
        parent::__construct();
        $this->gruppiutente = new ArrayCollection();
    }

    /**
     * @param string $role
     *
     * @return array
     */

    public function findByRole($role)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from($this->_entityName, 'u')
            ->where('u.roles LIKE :roles')
            ->setParameter('roles', '%"'.$role.'"%');

        return $qb->getQuery()->getResult();
    }

    //public function __toString(){return strval($this->getId());}
    /**
     * Set name
     *
     * @param string $name
     *
     * @return UserExt
     */
    /*public function setName($name)
    {
        $this->name = $name;
        return $this;
    }*/

    /**
     * Get name
     *
     * @return string
     */
    /*public function getName()
    {
        return $this->name;
    }*/

    /** Get e Set nomecognome */
    public function setNomecognome($nomecognome)
    {
        $this->nomecognome = $nomecognome;
        return $this;
    }

    public function getNomecognome()
    {
        return $this->nomecognome;
    }

    /** Get e Set codicefiscale */
    public function setCodicefiscale($codicefiscale)
    {
        $this->codicefiscale = $codicefiscale;
        return $this;
    }

    public function getCodicefiscale()
    {
        return $this->codicefiscale;
    }
    /**
     * Set idazienda
     *
     * @param \estar\rda\RdaBundle\Entity\Azienda $idazienda
     *
     * @return User
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
     * Set user groups
     *
     * @return User
     */
    public function setGruppiutente(ArrayCollection $gruppiutente = null)
    {
        $this->gruppiutente = $gruppiutente;
        /*$this->getGruppiutente()->clear();

        foreach($gruppiutente as $gruppoutente) {
            $this->addGruppoutente($gruppoutente);
        }

        return $this;*/
        return $this;
    }

    /**
     * Get groups granted to the user.
     *
     * @return Collection
     */
    public function getGruppiutente()
    {
        return $this->gruppiutente;// ?: $this->gruppiutente = new ArrayCollection();
    }

    /*public function addGruppoutente(Gruppoutente $gruppoutente){
        $this->gruppiutente[] = $gruppoutente;
        $gruppoutente->addArchive($this);
    }

    public function removeGruppoutente(Gruppoutente $gruppoutente){
        $this->gruppiutente->removeElement($gruppoutente);
        $gruppoutente->setArchive(null);
    }*/


    /**
     * Set idgruppoutente
     *
     * @param \estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente
     *
     * @return User
     */
    /*public function setIdgruppoutente(\estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente = null)
    {
        $this->idgruppoutente = $idgruppoutente;
        return $this;
    }*/

    /**
     * Get idgruppoutente
     *
     * @return \estar\rda\RdaBundle\Entity\Gruppoutente
     */
    /*public function getIdgruppoutente()
    {
        return $this->idgruppoutente;
    }*/
}
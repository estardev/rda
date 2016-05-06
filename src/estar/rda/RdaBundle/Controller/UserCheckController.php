<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use estar\rda\RdaBundle\Entity\Utentegruppoutente;
use estar\rda\RdaBundle\Model\DirittiRichiesta;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserCheckController extends Controller
{

    protected $em;
    protected $user;
    protected $session;

    public function __construct($em, $user, $session)
    {
        $this->em = $em;
        $this->user = $user->getToken()->getUser();
        $this->session = $session;
    }

    public function getName()
    {
//        $idutenteSessione = $this->user->getToken()->getUser();
//        $nomeUtente = $idutenteSessione->getName();
//        return $nomeUtente;

        return $this->user->getName();

    }

    public function getIdUtente()
    {
//        $idutenteSessione = $this->user->getToken()->getUser();
//        $repository = $this->em->getRepository('estarRdaBundle:Utente');
//
//
//
//
//        $idUtente = $repository->findOneBy(array(
//                'idfosuser' => $idutenteSessione)
//        );
//        $idUtente = $idUtente->getId();
//        return $idUtente;
        return $this->user->getId();

    }


   // public function dirittiUtente()
   // {
   //     $utente = $this->getUtente();
   //     $idUtente =  $utente->getId();
//
   //     $query = $this->em->createQuery('SELECT max(cg.abilitatoinserimentorichieste) as inserimento,
   //                                 max(cg.validatoretecnico) as valtec, max(cg.validatoreamministrativo) as valamm, cg.idcategoria as idcatego
   //                                 FROM estarRdaBundle:Categoriagruppo cg, estarRdaBundle:Gruppoutente gu, estarRdaBundle:Utentegruppoutente ugu
   //                                 WHERE ugu.idgruppoutente = gu.id
   //                                 AND cg.idgruppoutente = gu.id
   //                                 AND ugu.idutente = :idUtente')
   //         ->setparameter('idUtente', $idUtente);
//
   //     return $query->getResult();
   // }


    public function getUtente()
    {
//        $idutenteSessione = $this->user->getToken()->getUser();
//        $repository = $this->em->getRepository('estarRdaBundle:Utente');
//        $utente = $repository->findOneBy(array(
//                'idfosuser' => $idutenteSessione)
//        );

//        return $utente;

        return $this->user;
    }

    public function getIdUtenteGruppoUtente()
    {
        $idutente = $this->getIdUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Utentegruppoutente');
//        $idutentegruppo = new Utentegruppoutente();
        $idutentegruppo = $repository->findOneBy(array(
                'idutente' => $idutente)
        );
        $idutentegruppo = $idutentegruppo->getId();
        return $idutentegruppo;

    }

    public function getUtenteGruppoUtente()
    {
        $idgruppoutente = $this->getIdUtenteGruppoUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Gruppoutente');
        $utentegruppo = $repository->findOneBy(array(
                'id' => $idgruppoutente)
        );
        $gruppoutente = $utentegruppo->getNome();
        return $gruppoutente;

    }

    public function isAbilitatoInserimentoRichieste($categoria)
    {
        $idgruppoutente = $this->getIdUtenteGruppoUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Categoriagruppo');
        $utentegruppo = $repository->findOneBy(array(
                'idgruppoutente' => $idgruppoutente,
                'idcategoria' => $categoria)
        );
        $isAR = $utentegruppo->getAbilitatoinserimentorichieste();
        return $isAR;

    }

    public function isValidatoreTecnico($categoria)
    {
        $idgruppoutente = $this->getIdUtenteGruppoUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Categoriagruppo');
        $utentegruppo = $repository->findOneBy(array(
                'idgruppoutente' => $idgruppoutente,
                'idcategoria' => $categoria)
        );
        $isVT = $utentegruppo->getValidatoretecnico();
        return $isVT;

    }

    public function isValidatoreAmministrativo($categoria)
    {
        $idgruppoutente = $this->getIdUtenteGruppoUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Categoriagruppo');
        $utentegruppo = $repository->findOneBy(array(
                'idgruppoutente' => $idgruppoutente,
                'idcategoria' => $categoria)
        );
        $isVA = $utentegruppo->getValidatoreamministrativo();
        return $isVA;

    }

    /** ritorna tutti i ruoli per una categoria dato l'utente loggato
     *
     * @author Francesco Galli
     * @param $categoria id della categoria su cui si lavora
     * @return DirittiRichiesta i diritti della richiesta
     */
    public function allRole($categoria)
    {
        $utente = $this->getUtente();
        $idUtente =  $utente->getId();

        //recupero il massimo livello di accesso per la categoria a cui � collegato l'utente tramite i gruppi
        //di appartenenza
//        $query = $this->em->createQuery('SELECT max(cg.abilitatoinserimentorichieste) as inserimento,
//                                    max(cg.validatoretecnico) as valtec, max(cg.validatoreamministrativo) as valamm
//                                    FROM estarRdaBundle:Categoriagruppo cg
//                                    JOIN estarRdaBundle:Gruppoutente gu
//                                    JOIN estarRdaBundle:Utentegruppoutente ugu
//                                    WITH ugu.idgruppoutente = gu.id
//                                    AND cg.idgruppoutente = gu.id
//                                    WHERE ugu.idutente = :idUtente')
        $query = $this->em->createQuery('SELECT max(cg.abilitatoinserimentorichieste) as inserimento,
                                    max(cg.validatoretecnico) as valtec, max(cg.validatoreamministrativo) as valamm
                                    FROM estarRdaBundle:Categoriagruppo cg, estarRdaBundle:Gruppoutente gu, estarRdaBundle:Utentegruppoutente ugu
                                    WHERE ugu.idgruppoutente = gu.id
                                    AND cg.idgruppoutente = gu.id
                                    AND ugu.idutente = :idUtente
                                    AND cg.idcategoria = :idCategoria')

            ->setparameter('idUtente', $idUtente)->setparameter('idCategoria', $categoria);

        $diritti = $query->getResult();
        $dirittiRichiesta = new DirittiRichiesta();
        foreach($diritti as $diritto) {
            if ($diritto['inserimento'] >0 ) $dirittiRichiesta->setIsAI(true);
            if ($diritto['valamm'] >0 ) $dirittiRichiesta->setIsVA(true);
            if ($diritto['valtec'] >0 ) $dirittiRichiesta->setIsVT(true);
        }
        $dirittiRichiesta->setUser($utente);
        //FG20160415 mettiamo anche la categoria
        $categoriaDB = $this->em->getRepository('estarRdaBundle:Categoria')->findOneById($categoria);
        $dirittiRichiesta->setCategoria($categoriaDB);
        return $dirittiRichiesta;
        //vecchio codice di Demetrio
        //$idgruppoutente = $this->getIdUtenteGruppoUtente();
        //$repository = $this->em->getRepository('estarRdaBundle:Categoriagruppo');
        //$utentegruppo = $repository->findOneBy(array(
        //        'idgruppoutente' => $idgruppoutente,
        //        'idcategoria' => $categoria)
        //);
        //$isVA = $utentegruppo->getValidatoreamministrativo();
        //$isVT = $utentegruppo->getValidatoretecnico();
        //$isAR = $utentegruppo->getAbilitatoinserimentorichieste();
        //return array($isAR, $isVT, $isVA);

    }


    /**
     * Ritorna tutti i diritti di tutte le categorie per ogni utente
     * @return array(DirittiRichiesta)
     */
    public function dirittiByUtente() {

        $utente = $this->getUtente();
        $idUtente =  $utente->getId();

        $query = $this->em->createQuery('SELECT DISTINCT identity(cg.idcategoria)
                                    FROM estarRdaBundle:Categoriagruppo cg
                                    JOIN estarRdaBundle:Gruppoutente gu
                                    WITH cg.idgruppoutente = gu.id
                                    JOIN estarRdaBundle:Utentegruppoutente ugu
                                    WITH ugu.idgruppoutente = gu.id
                                    AND ugu.idutente = :idUtente
                                    ')
            ->setparameter('idUtente', $idUtente);


        $cat = $query->getResult();
        $toReturn = new ArrayCollection();
        foreach($cat as $idcategoria1 ) {
            $prova = $this->allRole($idcategoria1);
            $toReturn->add($prova);
        }
        return $toReturn;

    }

}

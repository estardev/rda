<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UserCheckController extends Controller
{

    protected $em;

    public function __construct($em, $user, $session)
    {
        $this->em = $em;
        $this->user = $user;
        $this->session = $session;
    }

    public function getName()
    {
        $idutenteSessione = $this->user->getToken()->getUser();
        $nomeUtente = $idutenteSessione->getName();
        return $nomeUtente;

    }

    public function getIdUtente()
    {
        $idutenteSessione = $this->user->getToken()->getUser();
        $repository = $this->em->getRepository('estarRdaBundle:Utente');
        $idUtente = $repository->findOneBy(array(
                'idfosuser' => $idutenteSessione)
        );
        $idUtente = $idUtente->getId();
        return $idUtente;

    }

    public function getUtente()
    {
        $idutenteSessione = $this->user->getToken()->getUser();
        $repository = $this->em->getRepository('estarRdaBundle:Utente');
        $utente = $repository->findOneBy(array(
                'idfosuser' => $idutenteSessione)
        );

        return $utente;

    }

    public function getIdUtenteGruppoUtente()
    {
        $idutente = $this->getIdUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Utentegruppoutente');
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

    public function allRole($categoria)
    {
        $idgruppoutente = $this->getIdUtenteGruppoUtente();
        $repository = $this->em->getRepository('estarRdaBundle:Categoriagruppo');
        $utentegruppo = $repository->findOneBy(array(
                'idgruppoutente' => $idgruppoutente,
                'idcategoria' => $categoria)
        );
        $isVA = $utentegruppo->getValidatoreamministrativo();
        $isVT = $utentegruppo->getValidatoretecnico();
        $isAR = $utentegruppo->getAbilitatoinserimentorichieste();
        return array($isAR, $isVT, $isVA);

    }


}

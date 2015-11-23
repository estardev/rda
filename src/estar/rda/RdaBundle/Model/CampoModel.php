<?php
/**
 * Created by PhpStorm.
 * User: francesco.galli
 * Date: 19/11/2015
 * Time: 13.12
 */

namespace estar\rda\RdaBundle\Model;

use estar\rda\RdaBundle\Entity\Campo;


class CampoModel extends Controller

{

    /** costruttore di default. Mi serve un entity manager e l'utente corrente */
    public function __construct($em, $user)
    {
        $this->em = $em;
        $this->user = $user;
    }

    /** funzioncina di comodo
     *
     */
    static public function cast(Campo $object) {
        return $object;
    }
    /**
     * Sposta un campo sotto
     *
     * @param $idcampo
     * @return un beneamato cazzo. Fa tutto per effetto laterale (brrr...)
     */
    public function spostaSu($idCampo) {
        $campo = CampoModel::cast($this->em->getRepository('estarRdaBundle:Campo')
            ->find($idCampo));
        //Error check: se non è un oggetto, ritorno.
        if (!is_object($campo)) return;

        //Vediamo su cosa stiamo lavorando
        $ordinamentoDaSpostare = $campo->getOrdinamento();

        //Se è il primo, non faccio niente.
        if ($ordinamentoDaSpostare == 1) return;

        //Se è il secondo ma è figlio di qualcuno, non faccio niente
        if ($ordinamentoDaSpostare == 2 && $this->isFiglio($campo)) return;

        //A voler essere fiscali un figlio NON lo posso spostare direttamente, quindi...
        if ($this->isFiglio($campo)) return;

        //Ok, c'è da lavorare.
        //Andiamoci a prendere il campo immediatamente sopra a questo.
        //partiamo da questo
        $ordinamentoCampoSopra = $campo->getOrdinamento();
        //Prendiamo quello immediatamente sopra
        $ordinamentoCampoSopra = $ordinamentoCampoSopra - 1;
        $campoDaSpostare=$this->getCampoByOrdinamento($campo->getIdcategoria(), $ordinamentoCampoSopra);
        //Se il campo sopra è un figlio, dobbiamo spostare suo padre
        $campoDaSpostareFiglio =null;
        if ($this->isFiglio($campoDaSpostare)) {
            $campoDaSpostareFiglio = $campoDaSpostare;
            $ordinamentoCampoSopra = $ordinamentoCampoSopra - 1;
            $campoDaSpostare = $this->getCampoByOrdinamento($campo->getIdcategoria(), $ordinamentoCampoSopra);
        }
        //Se questo campo ha un figlio, dobbiamo salvarcelo
        $campoFiglio = null;
        if ($this->isPadre($campo))
            $campoFiglio = $campo->getFiglio();

        //Facciamo lo spostamento
        //Caso semplice: non ci sono figli coinvolti
        if (!$campoDaSpostareFiglio && !$campoFiglio) {
            $swap = $campo->getOrdinamento();
            $campo->setOrdinamento($campoDaSpostare->getOrdinamento());
            $campoDaSpostare->setOrdinamento($swap);
        }
        //Caso più complesso: il campo non ha figli ma il campo sopra in realtà si
        if (!$campoFiglio && $campoDaSpostareFiglio) {
            $ordinamentoCampo = $campo->getOrdinamento();
            $ordinamentoCampoDaSpostare = $campoDaSpostare->getOrdinamento();
            $ordinamentoCampoDaSpostareFiglio = $campoDaSpostareFiglio->getOrdinamento();
            //Il campo prende l'ordinamento del campo da spostare
            $campo->setOrdinamento($ordinamentoCampoDaSpostare);
            //Il campo da spostare prende l'ordinamento del figlio
            $campoDaSpostare->setOrdinamento($ordinamentoCampoDaSpostareFiglio);
            //Il figlio del campo da spostare prende l'ordinamento del campo
            $campoDaSpostareFiglio->setObbligatoriovalidazionetecnica($ordinamentoCampo);
        }
        //Moccoli & bestemmie: entrambi i campi hanno figli (e le mogli puttane)
        if ($campoFiglio && $campoDaSpostareFiglio) {
            //Swappo i padri
            $swap = $campo->getOrdinamento();
            $campo->setOrdinamento($campoDaSpostare->getOrdinamento());
            $campoDaSpostare->setOrdinamento($swap);
            //Swappo i figli
            $swap = $campoFiglio->getOrdinamento();
            $campoFiglio->setOrdinamento($campoDaSpostareFiglio->getOrdinamento());
            $campoDaSpostareFiglio->setOrdinamento($swap);
        }
        //Finito. Anubi.
        $this->em->flush();
    }

    /**
     * Sposta un campo sotto
     *
     * @param $idcampo
     */
    public function spostaGiu($idCampo) {
        $campo = CampoModel::cast($this->em->getRepository('estarRdaBundle:Campo')
            ->find($idCampo));

        $ordinamento = $campo->getOrdinamento();
        $maxOrdinamentoCategoria = $this->getMaxOrdinamento($campo->getIdcategoria()->getId());

        //Gestione dei casi particolari: se è già l'ultimo campo o se è il penultimo ma ha un figlio, non faccio nulla.



    }

    /** Libera lo spazio per inserire un campo sopra
     *
     * @param $idcampo l'id del campo sopra il quale inserire
     */
    public function inserisciSopra($idCampo) {
        $campo = CampoModel::cast($this->em->getRepository('estarRdaBundle:Campo')
            ->find($idCampo));

    }

    /*
     * Libera lo spazio per inserire un campo sotto
     *
     * @param $idcampo l'id del campo sotto il quale inserire
     */
    public function inserisciSotto($idCampo) {
        $campo = CampoModel::cast($this->em->getRepository('estarRdaBundle:Campo')
            ->find($idCampo));

    }

    /** Ritorna TRUE se il campo è figlio di qualcuno
     *
     * @return boolean
     */
    public function isFiglio(Campo $campo) {
        //Un campo è figlio di qualcuno se  esiste un padre che ha lui come id figlio
        $probabilePadre = $this->em->getRepository('estarRdaBundle:Campo')->findOneByFiglio($campo);
        if($probabilePadre) return true;
        return false;
    }

    /** Ritorna TRUE se il campo è padre di qualcuno
     *
     * @return boolean
     */
    public function isPadre(Campo $campo) {
        if (!is_null($campo->getFiglio())) return true;
        return false;
    }

    /**
     * Metodo di comodo che mi ritorna un campo data la categoria e l'ordinamento
     * @param $idCategoria
     * @param $idOrdinamento
     * @return Campo
     */
    public function getCampoByOrdinamento($idCategoria, $idOrdinamento) {
        $campo = $this->em->getRepository('estarRdaBundle:Campo')->findOneBy(
            array('ordinamento' => $idOrdinamento,
                'idcategoria' => $idCategoria));
        //In teoria dovremmo sempre averne uno, ma nel dubbio si fa un check
        if (!$campo) return null;
        return $this->cast($campo);

    }

    /**
     * Ritorna il massimo tra gli ordinamenti di una data categoria
     * @param $idCategoria
     */
    public function getMaxOrdinamento($idCategoria) {
        $max = $this->em->createQueryBuilder()
            ->select('max(c.ordinamento)')
            ->from('estarRdaBundle:Campo c')
            ->where('idcategoria = :categoria')
            ->setParameter('categoria', $idCategoria)
            ->getQuery()
            ->getSingleScalarResult();
        return $max;
    }
}
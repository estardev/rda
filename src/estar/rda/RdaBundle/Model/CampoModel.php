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
        } elseif (!$campoFiglio && $campoDaSpostareFiglio) {
            //Caso più complesso: il campo non ha figli ma il campo sopra in realtà si
            $ordinamentoCampo = $campo->getOrdinamento();
            $ordinamentoCampoDaSpostare = $campoDaSpostare->getOrdinamento();
            $ordinamentoCampoDaSpostareFiglio = $campoDaSpostareFiglio->getOrdinamento();
            //Il campo prende l'ordinamento del campo da spostare
            $campo->setOrdinamento($ordinamentoCampoDaSpostare);
            //Il campo da spostare prende l'ordinamento del figlio
            $campoDaSpostare->setOrdinamento($ordinamentoCampoDaSpostareFiglio);
            //Il figlio del campo da spostare prende l'ordinamento del campo
            $campoDaSpostareFiglio->setObbligatoriovalidazionetecnica($ordinamentoCampo);
        } elseif ($campoFiglio && $campoDaSpostareFiglio) {
            //Moccoli & bestemmie: entrambi i campi hanno figli (e le mogli puttane)
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
        if ($ordinamento == $maxOrdinamentoCategoria) return;
        if ($this->isPadre($campo) && $ordinamento == $maxOrdinamentoCategoria-1) return;

        //Non dovrei mai entrare in questo if ma lo metto per sicurezza. Un figlio non si sposta da sè.
        if ($this->isFiglio($campo)) return;

        //Il campo da spostare è...
        $ordinamentoCampoSotto = $campo->getOrdinamento();
        $ordinamentoCampoSotto = $ordinamentoCampoSotto + 1;
        $campoDaSpostare = $this->getCampoByOrdinamento($campo->getIdcategoria(), $ordinamentoCampoSotto);

        //Casistiche:
        //Se il campo non ha figli e il campo sotto non ha figli, semplice swap
        if (!$this->isPadre($campo) && !$this->isPadre($campoDaSpostare)) {
            $swap = $campo->getOrdinamento();
            $campo->setOrdinamento($campoDaSpostare->getOrdinamento());
            $campoDaSpostare->setOrdinamento($swap);

        } elseif ($this->isPadre($campo) &&!$this->isPadre($campoDaSpostare)) {
            //Se il campo ha un figlio e il campo sotto no
            $swap = $campo->getOrdinamento();
            //il campo sotto prende l'ordinamento del campo
            $campoDaSpostare->setOrdinamento($campo->getOrdinamento());
            //Il campo va immediatamente sopra
            $campo->setOrdinamento($swap + 1);
            $campoFiglio = $campo->getFiglio();
            $campoFiglio->setOrdinamento($swap + 2);
        } elseif (!$this->isPadre($campo) && $this->isPadre($campoDaSpostare)) {
            //Il campo non ha un figlio ma il campo sotto si
            $swap = $campo->getOrdinamento();
            //Il campo sotto prende l'ordinamento del padre
            $campoDaSpostare->setOrdinamento($swap);
            //Il figlio del campo sotto va sotto
            $campoFiglio = $campoDaSpostare->getFiglio();
            $campoFiglio->setOrdinamento($swap+1);
            //Il campo prende l'ordinamento +2
            $campo->setOrdinamento($swap+2);

        } elseif ($this->isPadre($campo) && $this->isPadre($campoDaSpostare)) {
            //Se entrambi i campi hanno dei figli
            $swap = $campo->getOrdinamento();
            //Il campo sotto prende l'ordinamento del campo
            $campoDaSpostare->setOrdinamento($swap);
            //Il figlio del campo da spostare va messo sotto
            $campoFiglioDaSpostare = $campoDaSpostare->getFiglio();
            $campoFiglioDaSpostare->setOrdinamento($swap+1);
            //Il campo va immediatamente sotto
            $campo->setOrdinamento($swap+2);
            //Il figlio del campo sotto ancora
            $campoFiglio = $campo->getFiglio();
            $campoFiglio->setOrdinamento($swap+3);
        }

        //Finito. Sia lode ai cavalieri Jedi.
        $this->em->flush();
    }

    /** Libera lo spazio per inserire un campo sopra
     *
     * @param $idcampo l'id del campo sopra il quale inserire
     * @return l'ordinamento del prossimo campo, ossia l'ordinamento orfano.
     */
    public function inserisciSopra($idCampo) {
        $campo = CampoModel::cast($this->em->getRepository('estarRdaBundle:Campo')
            ->find($idCampo));
        $campi = $this->em->getRepository('estarRdaBundle:Campo')->findBy(
            array('idcategoria' => $campo->getIdcategoria()->getId()),
            array('ordinamento' => 'ASC')
        );
        //Inizio a spostare dall'ordinamento del campo...
        $ordinamentoPartenza = $campo->getOrdinamento();
        foreach($campi as $campoDaModificare)
            if ($campoDaModificare->getOrdinamento() >= $ordinamentoPartenza-1)
                $campoDaModificare->setOrdinamento(($campoDaModificare->getOrdinamento())+1);
        $this->em->flush();
        return $ordinamentoPartenza;
    }

    /*
     * Libera lo spazio per inserire un campo sotto
     *
     * @param $idcampo l'id del campo sotto il quale inserire
     * @return l'ordinamento del campo "vuoto"
     */
    public function inserisciSotto($idCampo) {
        $campo = CampoModel::cast($this->em->getRepository('estarRdaBundle:Campo')
            ->find($idCampo));
        $campi = $this->em->getRepository('estarRdaBundle:Campo')->findBy(
            array('idcategoria' => $campo->getIdcategoria()->getId()),
            array('ordinamento' => 'ASC')
        );
        //Inizio a spostare dall'ordinamento del campo...
        $ordinamentoPartenza = $campo->getOrdinamento();
        //...a meno che non abbia un figlio, nel qual caso inizio da quello dopo.
        if ($this->isPadre($campo)) $ordinamentoPartenza = $ordinamentoPartenza + 1;
        foreach($campi as $campoDaModificare)
            if ($campoDaModificare->getOrdinamento() >= $ordinamentoPartenza)
                $campoDaModificare->setOrdinamento(($campoDaModificare->getOrdinamento())+1);
        $this->em->flush();
        return $ordinamentoPartenza;
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
<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Entity\AbsPro;
use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Richiestaaggregazione;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\Response;

class ProgrammatoriaController extends Controller
{
    public function getMapPriorita($pro)
    {
        switch ($pro){
            case 1: $priorita = 1; break;
            case 2: $priorita = 2; break;
            case 3: $priorita = 3; break;
        }

        return $priorita;
    }

    public function getMapCampoByCategoria($categoria)
    {
        switch ($categoria){
            case 1: $campo = 25; break;
            case 2: $campo = 189; break;
            case 3: $campo = 48; break;
            case 4: $campo = 206; break;
            case 5: $campo = 207; break;
            case 7: $campo = 208; break;
            case 8: $campo = 209; break;
            case 9: $campo = 210; break;
            case 11: $campo = 211; break;
            case 12: $campo = 212; break;
            case 15: $campo = 213; break;
            case 16: $campo = 214; break;
            case 19: $campo = 215; break;
            case 20: $campo = 216; break;
            case 21: $campo = 217; break;
            case 27: $campo = 218; break;
            case 30: $campo = 221; break;
            case 31: $campo = 408; break;
            case 32: $campo = 674; break;
            case 33: $campo = 451; break;
            case 34: $campo = 482; break;
            case 35: $campo = 513; break;
            case 36: $campo = 544; break;
            case 37: $campo = 575; break;
            case 38: $campo = 606; break;
            case 39: $campo = 637; break;
            case 40: $campo = 949; break;
            case 41: $campo = 968; break;
        }

        return $campo;
    }

    public function indexAction()
    {
        $anno=date('Y');

        $em = $this->getDoctrine()->getManager();
        $em->getConnection()->beginTransaction();
        /*
         * utente denominato SoftwareProgrammazione che serve per il servizio
         * presente con questo id in produzione ed in sviluppo locale
         */
        $IDUTENTE_SOFTWARE_PROGRAMMAZIONE = 252;
        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));

        $programmazioneDoctrine = $this->getDoctrine()->getManager('programmazione');

        $programs = $programmazioneDoctrine->getRepository('estarRdaBundle:AbsPro')->findBy(
            array('pro_prontoper_rda' => 'S','pro_trasferito_rda'=>'N'),
            array('pro_id' => 'ASC')
        );
//        $programs = $this->get('doctrine')
//            ->getRepository('estarRdaBundle:AbsPro', 'programmazione')->findBy(array('pro_prontoper_rda' => 'S'));
//            ->findAll();
        /* @var $programmazione AbsPro */
        foreach ($programs as $programmazione) {

            if ($programmazione->getProAnno() < $anno){
                continue;
            }
            $titolo = $programmazione->getProOggettoEsteso();
            if (is_null($programmazione->getProNote()) or $programmazione->getProNote() =="")
                $descrizione = $programmazione->getProOggettoEsteso();
            else
                $descrizione = $programmazione->getProNote();
            if (is_null($programmazione->getCtrId())) continue;
            $id_Categoria = $em->getRepository('estarRdaBundle:Categoria')->find($programmazione->getCtrId());
            $status = 'da_inviare_ESTAR';
            $azienda = $em->getRepository('estarRdaBundle:Azienda')->find(21);
            $priorita = $this->getMapPriorita($programmazione->getLprId());
            $id_utente = $em->getRepository('estarRdaBundle:Utente')->find($IDUTENTE_SOFTWARE_PROGRAMMAZIONE);
            $ivaesclusa = $programmazione->getProImportoComplessivoIe();

            //todo campi non presenti sul DB da aggiungere
            $cui = $programmazione->getProCui();
            $rup = $programmazione->getRupId()->getRupDescrizione();
            $utente_inserimento = $programmazione->getProUtenteIns();
            $anno_programmazione = $programmazione->getProAnno();
            $idRiferimento_programmazione = $programmazione->getProId();


            //registro la richiesta programmazione
            $richiesta_programmazione = new Richiesta();
            $richiesta_programmazione->setTitolo($titolo);
            $richiesta_programmazione->setDescrizione($descrizione);
            $richiesta_programmazione->setIdcategoria($id_Categoria);
            $richiesta_programmazione->setStatus($status);
            $richiesta_programmazione->setIdazienda($azienda);
            $richiesta_programmazione->setPriorita($priorita);
            $richiesta_programmazione->setIdutente($id_utente);
            $richiesta_programmazione->setDataora($dateTime);
            $richiesta_programmazione->setCp(1);
            $richiesta_programmazione->setAssenzaconflitto(1);
            $richiesta_programmazione->setProcui($cui);
            $richiesta_programmazione->setProrupnome($rup);
            $richiesta_programmazione->setProutenteins($utente_inserimento);
            $richiesta_programmazione->setProanno($anno_programmazione);
            $richiesta_programmazione->setProid($idRiferimento_programmazione);
            $em->persist($richiesta_programmazione);
            $em->flush();
            $em->refresh($richiesta_programmazione);
            $idRichiesta = $richiesta_programmazione->getId();
            //registro l'iter
            $iter = new Iter();
            $iter->setIdutente($id_utente);
            $iter->setIdrichiesta($richiesta_programmazione);
            $iter->setDataora($dateTime);
            $iter->setDatafornita(1);
            $iter->setDastato('bozza');
            $iter->setAstato('da_inviare_ESTAR');
            $iter->setMotivazione('nuova richiesta Programmata');
            $em->persist($iter);
            $em->flush();
            //registro l'aggregazione delle richieste
            $azienda = $em->getRepository('estarRdaBundle:Azienda')->findAll();
            foreach ($azienda as $insertAzienda) {
                $richiestaaggregazione = new Richiestaaggregazione();
                $richiestaaggregazione->setIdrichiesta($richiesta_programmazione);
                $richiestaaggregazione->setIdazienda($insertAzienda);
                $em->persist($richiestaaggregazione);
                $em->flush();
            }
            //registro la valorizzazione dei campi
            $valorizzazionecamporichiesta = new Valorizzazionecamporichiesta();
            $valorizzazionecamporichiesta->setIdrichiesta($richiesta_programmazione);
            $valorizzazionecamporichiesta->setIdcategoria($id_Categoria);
            $valorizzazionecamporichiesta->setIdcampo($em->getRepository('estarRdaBundle:Campo')->find($this->getMapCampoByCategoria($programmazione->getCtrId())));
            $valorizzazionecamporichiesta->setValore($ivaesclusa);
            $em->persist($valorizzazionecamporichiesta);
            $em->flush();


            //todo richiamare controller
//            $sistematicaController = $this->get('sistematicaclientcontroller');
            $esito = $this->forward('estarRdaBundle:SistematicaClient:index', array('idCategoria' => $programmazione->getCtrId(), 'idRichiesta' => $idRichiesta, 'tipologia' => "Nuova",'programmatoria'=>1));
//            $esito = $sistematicaController->indexAction($programmazione->getCtrId(), $idRichiesta, 'Nuova',1);
            if ($esito != "" and  $esito->getStatusCode()=='200') {
                $numprotocollo = $esito->getContent();
                $programmazione->setProTrasferitoRda('S');
                $programmazione->setProDatatrasfRda($dateTime);
                $programmazione->setProProtocolloRda($numprotocollo);
                $programmazioneDoctrine->flush();
                $em->getConnection()->commit();
            }
            else{
                $em->getConnection()->rollBack();
            }
        }
        return new Response();
    }
}

<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Richiestaaggregazione;
use estar\rda\RdaBundle\Entity\Utente;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\EntityManager;
use estar\rda\RdaBundle\Entity\Area;
use estar\rda\RdaBundle\Form\AreaType;
use Swift_Message;
/**
 * Controller per la gestione delle email (dubito serva, ma intanto ci faccio il test).
 *
 */
class EmailController extends Controller
{

    public $em;
    public $container;
    public function __construct($em, $container)
    {
        $this->em = $em;
        $this->container= $container;
    }
    /**
     * Lists all Area entities.
     *
     */
    public function testEmailAction()
    {
        $utente = $this->getUser();
        $mailLogger = new \Swift_Plugins_Loggers_ArrayLogger();
        $mailer = $this->get('mailer');
        $mailer->registerPlugin(new \Swift_Plugins_LoggerPlugin($mailLogger));
        $message = \Swift_Message::newInstance()
            ->setSubject('Mail di Test')
//            ->setFrom('cinghialemannaro@gmail.com')
            ->setFrom('assistenza.rda@estar.toscana.it')
            ->setTo($utente->getEmail())
            ->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'estarRdaBundle:Email:testemail.html.twig',
                    array('nomecognome' => $utente->getNomecognome())
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $risultato = $mailer->send($message);

        return $this->render('estarRdaBundle:Email:testemail.html.twig',
            array('nomecognome' => $utente->getNomecognome(),
                'risultato' => $mailLogger->dump(),
                'test' => true));
    }

    public function notifyEmailAction($idRichiesta)
    {

        $em   = $this->em;
        /* @var $richiesta Richiesta */
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $protocollo  = $richiesta->getNumeroprotocollo();
        $categoria   = $richiesta->getIdcategoria()->getDescrizione();
        $utente      = $richiesta->getIdutente()->getNomecognome();
        $mail        = $richiesta->getIdutente()->getEmail();
        $descrizione = $richiesta->getDescrizione();
        $azienda     = $richiesta->getIdazienda()->getNome();
        $titolo      = $richiesta->getTitolo();

        /* @var $richiestaaggregate Richiestaaggregazione */
        $richiestaaggregate = $this->em->getRepository('estarRdaBundle:Richiestaaggregazione')->findBy( array('idrichiesta' => $idRichiesta));
        $aziendaRichesta = new ArrayCollection();
        foreach ($richiestaaggregate as $aziendaR){
           $aziendaRichesta->add($aziendaR->getIdazienda()->getNome());
        }

        /* @var $iter Iter*/
        $iter = $em->getRepository('estarRdaBundle:Iter')->findBy(array('idrichiesta' => $idRichiesta),array('id' => 'DESC'));

        // review: zanna20180713 trovato errore in RichiesteModel da correggere perché nei due casi :
        //   030 STATUSESTAR_ATTESA_TEC = "Attesa documentazione aggiuntiva Tecnica"
        //   031 STATUSESTAR_ATTESA_AMM = "Attesa documentazione aggiuntiva Amministrativa"
        // non aggiornava lo stato corretto nell'iter

        $stato = $iter[0]->getAstatogestav();
        $stato = $richiesta->getStatusgestav();

        $message = \Swift_Message::newInstance();
        $message->setSubject('RDA AVVISO: Cambio di Stato richiesta n: '.$idRichiesta.' (protocollo '.$protocollo.')');
        $message->setFrom('assistenza.rda@estar.toscana.it');
        $message->setTo("$mail");
    //    $message->setTo('nadia.zanieri@estar.toscana.it');
        $message->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'estarRdaBundle:Email:notifyemail.html.twig',
                    array(
                        'nomecognome' => $utente,
                        'protocollo' => $protocollo,
                        'idrichiesta' => $idRichiesta,
                        'categoria' => $categoria,
                        'stato' => $stato,
                        'titolo' => $titolo,
                        'descrizione' => $descrizione,
                        'azienda' => $azienda,
                        'aziendaRichiesta' => $aziendaRichesta
                        )
                ),
                'text/html'
        )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $result = $this->get('mailer')->send($message);
        return $result;

        //return $this->render('estarRdaBundle:Email:notifyemail.html.twig',
        //    array('nomecognome' => $utente->getNomecognome(),
        //        'protocollo' => $protocollo,
        //        'idrichiesta' => $idRichiesta,
        //        'categoria' => $categoria,
        //        'stato' => $stato,
        //        'risultato' => $mailLogger->dump(),
        //        'test' => true));
    }


    /**
     * Metodo che pesca una richiesta e invia una mail al validatore amministrativo
     * @param $idRichiesta
     * @return mixed
     */
    public function notifyEmailVAAction($idRichiesta)
    {

        $em   = $this->em;
        /* @var $richiesta Richiesta */
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $protocollo  = $richiesta->getNumeroprotocollo();
        $categoria   = $richiesta->getIdcategoria()->getDescrizione();
        $utente      = $richiesta->getIdutente()->getNomecognome();

        $descrizione = $richiesta->getDescrizione();
        $azienda     = $richiesta->getIdazienda()->getNome();
        $titolo      = $richiesta->getTitolo();

        /* @var $richiestaaggregate Richiestaaggregazione */
        $richiestaaggregate = $this->em->getRepository('estarRdaBundle:Richiestaaggregazione')->findBy( array('idrichiesta' => $idRichiesta));
        $aziendaRichesta = new ArrayCollection();
        foreach ($richiestaaggregate as $aziendaR){
            $aziendaRichesta->add($aziendaR->getIdazienda()->getNome());
        }

        /* @var $iter Iter*/
        $iter = $em->getRepository('estarRdaBundle:Iter')->findOneBy(array('idrichiesta' => $idRichiesta, 'dastato' =>'attesa_val_amm', 'astato' => 'da_inviare_ESTAR'),array('id' => 'DESC'));

        // review: zanna20180713 trovato errore in RichiesteModel da correggere perché nei due casi :
        //   030 STATUSESTAR_ATTESA_TEC = "Attesa documentazione aggiuntiva Tecnica"
        //   031 STATUSESTAR_ATTESA_AMM = "Attesa documentazione aggiuntiva Amministrativa"
        // non aggiornava lo stato corretto nell'iter
        //FG20181212 potrebbe non esserci ul'utente
        $utenteVA = $iter->getIdutente();
        if ($utenteVA != null) {
            $mail = $iter->getIdutente()->getEmail();
            $stato = $iter->getAstatogestav();
            $stato = $richiesta->getStatusgestav();

            $message = \Swift_Message::newInstance();
            $message->setSubject('RDA AVVISO per Validatore Amministrativo: Cambio di Stato richiesta n: ' . $idRichiesta . ' (protocollo ' . $protocollo . ')');
            $message->setFrom('assistenza.rda@estar.toscana.it');
            $message->setTo("$mail");
            //    $message->setTo('nadia.zanieri@estar.toscana.it');
            $message->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'estarRdaBundle:Email:notifyemailVA.html.twig',
                    array(
                        'nomecognome' => $utente,
                        'protocollo' => $protocollo,
                        'idrichiesta' => $idRichiesta,
                        'categoria' => $categoria,
                        'stato' => $stato,
                        'titolo' => $titolo,
                        'descrizione' => $descrizione,
                        'azienda' => $azienda,
                        'aziendaRichiesta' => $aziendaRichesta
                    )
                ),
                'text/html'
            )/*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
            ;
            $result = $this->get('mailer')->send($message);
            return $result;
        }
        return 0;

        //return $this->render('estarRdaBundle:Email:notifyemail.html.twig',
        //    array('nomecognome' => $utente->getNomecognome(),
        //        'protocollo' => $protocollo,
        //        'idrichiesta' => $idRichiesta,
        //        'categoria' => $categoria,
        //        'stato' => $stato,
        //        'risultato' => $mailLogger->dump(),
        //        'test' => true));
    }


}

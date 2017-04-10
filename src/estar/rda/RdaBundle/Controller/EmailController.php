<?php

namespace estar\rda\RdaBundle\Controller;

use estar\rda\RdaBundle\Entity\Iter;
use estar\rda\RdaBundle\Entity\Richiesta;
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

        $em = $this->em;
        /* @var $richiesta Richiesta */
        $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
        $protocollo = $richiesta->getNumeroprotocollo();
        $categoria= $richiesta->getIdcategoria()->getDescrizione();
        $utente= $richiesta->getIdutente()->getNomecognome();
        $mail = $richiesta->getIdutente()->getEmail();

        /* @var $iter Iter*/
        $iter = $em->getRepository('estarRdaBundle:Iter')->findBy(array('idrichiesta' => $idRichiesta),array('id' => 'DESC'));
        $stato = $iter[0]->getAstatogestav();

        $message = \Swift_Message::newInstance();
            $message->setSubject('RDA AVVISO: Cambio di Stato');
//            ->setFrom('cinghialemannaro@gmail.com')
        $message->setFrom('assistenza.rda@estar.toscana.it');
            $message->setTo("$mail");
            $message->setBody(
                $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'estarRdaBundle:Email:notifyemail.html.twig',
                    array(
                        'nomecognome' => $utente,
                        'protocollo' => $protocollo,
                        'idrichiesta' => $idRichiesta,
                        'categoria' => $categoria,
                        'stato' => $stato
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
        return $this->get('mailer')->send($message);

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

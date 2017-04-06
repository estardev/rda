<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Area;
use estar\rda\RdaBundle\Form\AreaType;
use Swift_Message;
/**
 * Controller per la gestione delle email (dubito serva, ma intanto ci faccio il test).
 *
 */
class EmailController extends Controller
{

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
}

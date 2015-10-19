<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestingNotifyController extends Controller
{
    public function indexAction()
    {
        $notify = $this->get("usercheck.notify");
        $hello = $notify->getUtenteGruppoUtente();
        var_dump($hello);
        return $this->render('estarRdaBundle:Testing:index.html.twig', array(
            'hello' => $hello
    ));
            }
}

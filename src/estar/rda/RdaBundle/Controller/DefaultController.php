<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('estarRdaBundle:Default:index.html.twig');
    }
}

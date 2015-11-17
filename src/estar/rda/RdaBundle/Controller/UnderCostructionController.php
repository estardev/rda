<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class UnderCostructionController extends Controller
{
    public function indexAction()
    {
        return $this->render('estarRdaBundle::underCostruction.html.twig');
    }

}

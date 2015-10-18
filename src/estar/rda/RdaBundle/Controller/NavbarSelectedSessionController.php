<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NavbarSelectedSessionController extends Controller
{
    public function setNavbarSessionAction()
    {
        $request = $this->get('request');
        $homepageSelectCategoria = $request->request->get('homepageSelectCategoria');

        $response = array();
        $response['homepageSelectCategoria'] = "";

        if (isset($homepageSelectCategoria)){
            $this->get('session')->set('homepageSelectCategoria', $homepageSelectCategoria);
            $response['homepageSelectCategoria'] = $this->get('session')->get('homepageSelectCategoria');
        }

        return new Response(json_encode($response));

    }

    public function getNavbarSessionAction()
    {
        $response = array();
        $response['homepageSelectCategoria'] = $this->get('session')->get('homepageSelectCategoria');

        return new Response(json_encode($response));

    }

    public function clearNavbarSessionAction()
    {
        //$response = array();
        //$response['homepageSelectCategoria'] = "";

        $this->get('session')->set('homepageSelectCategoria', '');
        //$response['homepageSelectCategoria'] = $this->get('session')->get('homepageSelectCategoria');

        //return new Response(json_encode($response));

    }
}

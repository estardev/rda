<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



/**
 * pdf controller.
 *
 */
class PdfController extends Controller
{

    /**
     * Lists all pdf entities.
     *
     */
    public function indexAction()
    {

        require_once($this->get('kernel')->getRootDir().'/config/dompdf_config.inc.php');

        $dompdf = new \DOMPDF();
        $pippo="antani";
        $htmlfinale =  $this->renderView('estarRdaBundle:pdf:index.html.twig',array('pluto'=>$pippo));
        //$dompdf->load_html("<html><body><h1>titolo</h1></body></html>");
        $dompdf->load_html($htmlfinale);
        $dompdf->render();


        return new Response($dompdf->output(), 200, array(
            'Content-Type' => 'application/pdf'
        ));

    }

}
<?php

namespace estar\rda\RdaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

class ListaRichiesteFromSidebarController extends Controller
{
    public function setListaRichiesteAction()
    {
        $request = $this->get('request');
        $selectedSidebarLavorazione = $request->request->get('selectedSidebarLavorazione');
        $idCategoria = $request->request->get('idCategoria');
        $em = $this->getDoctrine()->getManager();
        var_dump($idCategoria);
        switch ($selectedSidebarLavorazione){

            //TODO: VANNO PASSATE GLI idCategoria PER SISTEMARE LE QUERY??
            case 'lavorate_0':
                $query = $em->createQuery(
                    'SELECT r
                        FROM estarRdaBundle:Richiesta r
                        WHERE r.status LIKE ?1 OR r.status LIKE ?2 OR r.status LIKE ?3 OR r.status LIKE ?4 OR r.status LIKE ?5 AND r.idcategoria=:6'
                    )->setParameters(array(1 => 'bozza', 2 => 'attesa_val_tec', 3 => 'attesa_val_amm', 4 => 'attesa_val_amm', 5 => 'da_inviare_ABS', 6 => $idCategoria));

                $entities = $query->getResult();
                break;
            case 'lavorate_1':
                //$criteria = array('status' => 'da_inviare_ABS');
                //$entities = $em->getRepository('estarRdaBundle:Richiesta')->findBy($criteria);
                $query = $em->createQuery(
                    'SELECT r
                        FROM estarRdaBundle:Richiesta r
                        WHERE r.status LIKE ?1 OR r.status LIKE ?2 OR r.status LIKE ?3 OR r.status LIKE ?4 OR r.status LIKE ?5 AND r.idcategoria=:6'
                )->setParameters(array(1 => 'inviata_ABS', 2 => 'evasa_ABS', 3 => 'rigetto_ABS', 4 => 'chiusa_ABS', 5 => 'annullata_ABS', 6=> $idCategoria));

                $entities = $query->getResult();

                break;
            case 'lavorate_2':
                $entities= new ArrayCollection();
                $ent = $em->getRepository('estarRdaBundle:Richiesta')->findAll();
                foreach($ent as $entity){
                    if($entity->getIdcategoria()!=$idCategoria) continue;
                    else $entities->add($entity);
                }
                break;
        }

        //$entities = $em->getRepository('estarRdaBundle:Richiesta')->findBy(array('status' => 'bozza'));

        //$entities_json = json_encode($entities);


        //return new Response($entities);
        return $this->render('estarRdaBundle:Richiesta:table.html.twig', array(
            'entities' => $entities
        ));

    }

    /*public function getNavbarSessionAction()
    {
        $response = array();
        $response['homepageSelectCategoria'] = $this->get('session')->get('homepageSelectCategoria');

        return new Response(json_encode($response));

    }*/

    /*public function clearNavbarSessionAction()
    {
        //$response = array();
        //$response['homepageSelectCategoria'] = "";

        $this->get('session')->set('homepageSelectCategoria', '');
        //$response['homepageSelectCategoria'] = $this->get('session')->get('homepageSelectCategoria');

        //return new Response(json_encode($response));

    }*/
}

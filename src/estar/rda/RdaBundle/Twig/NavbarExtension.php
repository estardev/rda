<?php
/**
 * Created by PhpStorm.
 * User: Nadia
 * Date: 16/10/2015
 * Time: 14.08
 */
namespace estar\rda\RdaBundle\Twig;

use estar\rda\RdaBundle\Entity\GenericDoctrine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavbarExtension extends \Twig_Extension
{

    protected $em;
    protected $user;
    protected $session;

    public function __construct($em, $user, $session)
    {
        $this->em = $em;
        $this->user = $user;
        $this->session = $session;
    }

           public function getFunctions()
    {
        return array(
            'navbar' => new \Twig_Function_Method($this, 'renderNavbar', array('is_safe' => array('html'),
                'needs_environment' => true))
        );

    }

    public function renderNavbar(\Twig_Environment $twig)
    {

        $utenteSessione= $this->user->getToken()->getUser();

        //FG 20151026 gestione aree su categoria
        //$categoria = $this->em->getRepository('estarRdaBundle:Categoria')->findAll();
        //FG 20151112 ulteriore modifica: ACL non fa vedere le categorie a chi non se le merita.
        //$query = $this->em->createQuery('select c.id, c.descrizione, a.nome as area from estarRdaBundle:Categoria c join c.idarea a where c.idarea = a.id');
        //$categoria = $query->getResult();
        // check: se l'utente � amministratore di sistema, vede tutto.
        //$utenteFos = $utenteSessione->getIdFosUser();
        if (!is_null($utenteSessione) && is_object($utenteSessione)) {
            //Se entro in questo branch ho l'utente loggato
            if ($utenteSessione->hasRole('ROLE_ADMIN') || $utenteSessione->hasRole('ROLE_SUPER_ADMIN')) {
                $query = $this->em->createQuery('select c.id as id, c.descrizione as descrizione, a.nome as area from estarRdaBundle:Categoria c join c.idarea a where c.idarea = a.id');
                $categoria = $query->getResult();

            } else {
                //Altrimenti dobbiamo mostrare solo le categorie a cui ha accesso
                //FIXME FG: questa query non viene eseguita da Doctrine per motivi mistico-cabalistici da investigare.
//                $subquery=$this->em->createQueryBuilder()
//                    ->select('IDENTITY(cg.idcategoria)')
//                    ->from('estarRdaBundle:Categoriagruppo','cg',)
//                    ->leftjoin( 'cg.idgruppoutente','gu')
//                    ->where('gu.id = :idutente')
//                    ->getDQL();
//
//
//                $query=$this->em->createQueryBuilder()
//                    ->select('c.id, c.descrizione, a.nome as area')
//                    ->from('estarRdaBundle:Categoria','c')
//                    ->leftjoin( 'c.idarea','a')
//                    ->where($this->em->createQueryBuilder()->expr()->in('c.id', $subquery))
//                    ->setParameter('idutente', $utenteSessione)
//                    ->getQuery();



                $query = $this->em->
                createQuery('select  c.id ,c.descrizione, a.nome as area
                      from estarRdaBundle:Categoria c, estarRdaBundle:Area a
                      where c.idarea = a.id
                      and c.id in (select IDENTITY(cg.idcategoria) from estarRdaBundle:Categoriagruppo cg, estarRdaBundle:Utentegruppoutente ugu
                        where cg.idgruppoutente = ugu.idgruppoutente
                        and ugu.idutente = :idutente)')
                    ->setParameter('idutente', $utenteSessione);
//                $query = $this->em->
//                        createQuery('select v.idcategoria as id, v.descrizionecategoria as descrizione, v.nomearea as area from
//                          estarRdaBundle:Vcategoriadirittiutente v where v.idutente= :utente')
//                    ->setParameter('utente', $utenteSessione);
                 $categoria=$query->getResult();


            }
        } else {
            //l'utente non � loggato
            $categoria = array();
        }
        $richiesta = $this->em->getRepository('estarRdaBundle:Richiesta')->findAll();


        $categoriaSelezionata = $this->session->get('homepageSelectCategoria');

        return $twig->render('estarRdaBundle::navbar.html.twig', array(
            'richiesta' => $richiesta,
            'categoria'=> $categoria,
            'utente' => ucfirst($utenteSessione),
            'categoriaSelezionata' => $categoriaSelezionata
        ));
    }

    public function getName()
    {
        return 'navbar_extension';
    }

}
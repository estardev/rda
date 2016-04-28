<?php

namespace estar\rda\RdaBundle\Controller;


use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Utente;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Routing\Router as Router;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * Nuovo controller di backoffice che gestisce la creazione di form con la relazione 1 padre -> molti figli
 * @author FrancescoGalliEstar
 * @Route("/formbuilder")
 */

class FormBuilderController extends Controller
{

    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_VALORI = '|';
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_CAMPI = '||';

    public function getChoicesOptions($string)
    {
        $options = explode(FormTemplateController::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateController::SEPARATORE_VALORI, $option);
            if (count($subOption) > 1) {
                $returnOptions[$subOption[0]] = $subOption[1];
            } else {
                $returnOptions[$subOption[0]] = $subOption[0];
            }
        }


        return $returnOptions;
    }

    function selectedOption($options, $key)
    {
        return $options[$key];
    }

    function getFirstLevel($string)
    {
        $options = explode(FormTemplateController::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateController::SEPARATORE_VALORI, $option);
            array_push($returnOptions, $subOption[1]);
        }

        return $returnOptions;
    }

    function getFather($string)
    {
        $options = explode(FormTemplateController::SEPARATORE_CAMPI, $string);
        $subOption = explode(FormTemplateController::SEPARATORE_VALORI, $options[0]);

        return $subOption[0];
    }

    /**
     * Ritorna i valori possibili per la priorit�
     * @return array
     */
    public static function getPossibleEnumPriorita()
    {
        $choices = array(
            '1' => '',
            '2' => 'Elevata',
            '3' => 'Standard');
        return $choices;
    }

    /**
     * Mostra tutti i campi di un controller
     * @Route("/showByCategoria/{idCategoria}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @return Response A Response instance
     *
     */
    public function showAction($idCategoria)
    {
        $repository = $this->getDoctrine()->getRepository(Campo::class);

        $entities = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamento' => 'ASC')
        );

        return $this->render('estarRdaBundle:FormBuilder:index.html.twig', array(
            'entities' => $entities,
            'idcategoria' => $idCategoria
        ));

    }


    /**
     * Fa scegliere il padre di un campo
     * @Route("/setPadre/{idCategoria}/{$idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     *
     */
    public function setPadreAction($idCategoria, $idCampo)
    {
        //Ci peschiamo il tutto
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $campoFiglio = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

        //I campi possibili padre sono tutti..
        $campiCategoria = $em->getRepository('estarRdaBundle:Campo')->findByIdcategoria($categoria);
        //..meno quelli che hanno già un padre o che sono lo stesso campo.
        $campiPossibili = array();
        foreach ($campiCategoria as $campoPossibile) {
            //Se è nullo il padre e non è sè stesso, lo aggiungo.
            if (($campoPossibile->getId() != $campoFiglio->getId() && (is_null($campoPossibile->getCampoPadre()))))
                array_push($campiPossibili, $campoPossibile);
        }

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_setPadreDB', array('idCategoria' => $idCategoria, 'idCampo' => $idCampo)))
            ->add('padre', 'entity', array(
                'choices' => $campiPossibili,
                'class' => 'estarRdaBundle:Campo',
                'label' => 'Padre',
                'choice_label' => 'nomedescrizione',
            ))
            ->add('submit', 'submit', array('label' => 'Imposta Padre'))
            ->getForm();
        $backForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
            ->add('submit', 'submit', array('label' => 'Indietro alla lista'))
            ->getForm();

        return $this->render('estarRdaBundle:FormBuilder:setPadre.html.twig', array(
            'form' => $form->createView(),
            'backForm' => $backForm->createView()));
    }


    /**
     * @Route("/setPadreDB/{idCategoria}/{$idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     */

    public function setPadreDBAction($idCategoria, $idCampo, Request $request)
    {
        //Innanzitutto salviamoci il campo su cui operare
        $em = $this->getDoctrine()->getManager();
        $campoFiglio = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

        //Dopodichè ci andiamo a pescare il campo padre.
        $campi = $request->request->all();
        $idPadre = $campi['form']['padre'];
        $campoPadre = $em->getRepository('estarRdaBundle:Campo')->find($idPadre);

        //Settiamo e salviamo
        $campoFiglio->setCampopadre($campoPadre);
        $em->flush();

        //e ciao
        return $this->redirect($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)));


    }

    /**
     * Fa scegliere le condizioni
     * @Route("/setCondizioni/{idCategoria}/{$idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     *
     */
    public function setCondizioniAction($idCategoria, $idCampo)
    {

        //Ci peschiamo il tutto
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

        //Serve il padre per vedere le condizioni
        $padre = $campo->getCampopadre();
        if (is_null($padre)) {
            $backForm = $this->createFormBuilder()
                ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
                ->add('submit', 'submit', array('label' => 'Il campo deve avere un Padre per avere condizioni'))
                ->getForm();

            return $this->render('estarRdaBundle:FormBuilder:setCondizioni.html.twig', array(
                'backForm' => $backForm->createView()));
        }

        if ($padre->getTipo() != Campo::TIPO_SCELTA) {
            //Il padre deve essere di tipo scelta
            $backForm = $this->createFormBuilder()
                ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
                ->add('submit', 'submit', array('label' => 'Il Padre deve essere di tipo scelta'))
                ->getForm();

            return $this->render('estarRdaBundle:FormBuilder:setCondizioni.html.twig', array(
                'backForm' => $backForm->createView()));

        }

        if ($campo->getTipo() == Campo::TIPO_SCELTA) {
            $backForm = $this->createFormBuilder()
                ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
                ->add('submit', 'submit', array('label' => 'Il campo figlio non può essere di tipo scelta'))
                ->getForm();

            return $this->render('estarRdaBundle:FormBuilder:setCondizioni.html.twig', array(
                'backForm' => $backForm->createView()));

        }

            //Ok, abbiamo un padre e possiamo lavorare sulle condizioni.
            $fieldset = $padre->getFieldset();
            $condizioni = $campo->getPadre();

        //TODO: per ora la facciamo cosi', alla stronza. Poi lo sistemiamo figo.

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_setCondizioniDB', array('idCategoria' => $idCategoria, 'idCampo' => $idCampo)))
            ->add('nomepadre', null, array(
                'label' => 'Nome del campo padre',
                'data' => $padre->getNome()
            ))
            ->add('disponibili', null, array(
                'label' => 'Opzioni Disponibili',
                'data' => $fieldset
            ))
            ->add('condizioni', null, array(
                'label' => 'Opzioni da mettere',
                'data' => $condizioni
            ))
            ->add('submit', 'submit', array('label' => 'Imposta Condizioni'))
            ->getForm();

        $backForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
            ->add('submit', 'submit', array('label' => 'Indietro alla lista'))
            ->getForm();

        return $this->render('estarRdaBundle:FormBuilder:setPadre.html.twig', array(
            'form' => $form->createView(),
            'backForm' => $backForm->createView()));

    }

    /**
     * @Route("/setCondizioniDB/{idCategoria}/{$idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     */

    public function setCondizioniDBAction($idCategoria, $idCampo, Request $request)
    {
        //Innanzitutto salviamoci il campo su cui operare
        $em = $this->getDoctrine()->getManager();
        $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

        //Dopodichè ci andiamo a pescare i valori.
        $campi = $request->request->all();
        $condizioni = $campi['form']['condizioni'];

        //Settiamo e salviamo
        $campo->setPadre($condizioni);
        $em->flush();

        //e ciao
        return $this->redirect($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)));


    }


    /**
     * Fa scegliere le condizioni
     * @Route("/setValori/{idCategoria}/{$idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     *
     */
    public function setValoriAction($idCategoria, $idCampo)
    {

        //Ci peschiamo il tutto
        $em = $this->getDoctrine()->getManager();

        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

        //Il campo deve essere di tipo scelta
        if ($campo->getTipo() != Campo::TIPO_SCELTA) {
            //Il padre deve essere di tipo scelta
            $backForm = $this->createFormBuilder()
                ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
                ->add('submit', 'submit', array('label' => 'Il campo deve essere di tipo scelta'))
                ->getForm();

            return $this->render('estarRdaBundle:FormBuilder:setCondizioni.html.twig', array(
                'backForm' => $backForm->createView()));

        }


        //Ok, possiamo lavorare
        $fieldset = $campo->getFieldset();

        //TODO: per ora la facciamo cosi', alla stronza. Poi lo sistemiamo figo.

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_setValoriDB', array('idCategoria' => $idCategoria, 'idCampo' => $idCampo)))
            ->add('nomepadre', null, array(
                'label' => 'Nome del campo da usare nei fieldset',
                'data' => $campo->getNome()
            ))
            ->add('valori', null, array(
                'label' => 'Opzioni Disponibili',
                'data' => $fieldset
            ))
            ->add('submit', 'submit', array('label' => 'Imposta Valori'))
            ->getForm();

        $backForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
            ->add('submit', 'submit', array('label' => 'Indietro alla lista'))
            ->getForm();

        return $this->render('estarRdaBundle:FormBuilder:setPadre.html.twig', array(
            'form' => $form->createView(),
            'backForm' => $backForm->createView()));

    }

    /**
     * @Route("/setValoriDB/{idCategoria}/{$idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     */

    public function setValoriDBAction($idCategoria, $idCampo, Request $request)
    {
        //Innanzitutto salviamoci il campo su cui operare
        $em = $this->getDoctrine()->getManager();
        $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);

        //Dopodichè ci andiamo a pescare i valori.
        $campi = $request->request->all();
        $valori = $campi['form']['valori'];

        //Settiamo e salviamo
        $campo->setFieldset($valori);
        $em->flush();

        //e ciao
        return $this->redirect($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)));


    }

    //TODO: FARE DA QUI ALLA FINE!!!!!

    /**
     * Modifica campo
     * @Route("/edit/{idCategoria}/{idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @return Response A Response instance
     *
     */
    public function editAction($idCategoria, $idCampo)
    {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);


        $vcr = $em->getRepository('estarRdaBundle:Valorizzazionecamporichiesta')->findByCampo($campo);
        if (is_null($vcr)) {
            //se non esiste alcuna valorizzazionecamporichiesta che punta a quel campo
            //edito quello che voglio

        } else {
            //Se esiste almeno una valorizzazionecamporichiesta che punta a quel campo
            //mostro solo la descrizione

        }

    }

        /**
     * Inserisce un nuovo campo
     * @Route("/nuovo/{idCategoria}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @return Response A Response instance
     *
     */
    public function creaAction($idCategoria)
    {

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_nuovoDB', array('idCategoria' => $idCategoria)))
            ->add("nome", "text", array(
                'label' => "Nome",
                'attr' => array(
                'placeholder'=> "Specificare il Nome del Campo"),
                'constraints' => new NotNull()
            ))
            ->add("descrizione", "text", array(
                'label' => "Descrizione",
                'attr' => array(
                'placeholder'=> "Specificare la descrizione del campo"),
                'constraints' => new NotNull()
            ))
            ->add("tipologia", "choice", array(
                'choices' => Campo::getPossibleEnumValues(),
                'label' => "Tipologia",
                'data' => "3"
            ))
            ->add("obbligatorioInserzione", "choice", array(
                'choices' => Campo::getPossibleEnumObblighi(),
                'label' => "Obbligatorio Inserzione",
                'expanded' => true
            ))
            ->add("obbligatorioValidazioneTecnica", "choice", array(
                'choices' => Campo::getPossibleEnumObblighi(),
                'label' => "Obbligatorio Validazione Tecnica",
                'expanded' => true
            ))
            ->add("obbligatorioValidazioneAmministrativa", "choice", array(
                'choices' => Campo::getPossibleEnumObblighi(),
                'label' => "Obbligatorio Validazione Amministrativa",
                'expanded' => true
            ))
            ->add('submit', 'submit', array('label' => 'Crea Campo'))
            ->getForm();

        $backForm = $this->createFormBuilder()
            ->setAction($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)))
            ->add('submit', 'submit', array('label' => 'Indietro'))
            ->getForm();

        return $this->render('estarRdaBundle:FormBuilder:crea.html.twig', array(
            'form' => $form->createView(),
            'backForm' => $backForm->createView()));
    }

    /**
     * Inserisce un nuovo campo
     * @Route("/nuovoDB/{idCategoria}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @return Response A Response instance
     *
     */
    public function creaDBAction($idCategoria, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);

        $campo = new Campo();
        //Dopodichè ci andiamo a pescare i valori.
        $campi = $request->request->all();
        $nome = $campi['form']['nome'];
        $descrizione = $campi['form']['descrizione'];
        $tipologia = $campi['form']['tipologia'];
        $inserzione =$campi['form']['obbligatorioInserzione'];
        $valtec = $campi['form']['obbligatorioValidazioneTecnica'];
        $valamm = $campi['form']['obbligatorioValidazioneAmministrativa'];

        //Settiamo e salviamo
        $campo->setDescrizione($descrizione);
        $campo->setIdcategoria($categoria);
        $campo->setTipo($tipologia);
        $campo->setObbligatorioinserzione($inserzione);
        $campo->setObbligatoriovalidazionetecnica($valtec);
        $campo->setObbligatoriovalidazioneamministrativa($valamm);
        $campo->setNome($nome);
        $em->persist($campo);
        $em->flush();

        return $this->redirect($this->generateUrl('formbuilder_showByCategoria', array('idCategoria' => $idCategoria)));
    }

    /**
     * Elimina un campo
     * @Route("/elimina/{idCategoria}/{idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     *
     */
    public function eliminaAction($idCategoria, $idCampo)
    {

    }

    /**
     * Elimina un campo
     * @Route("/spostaSu/{idCategoria}/{idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     *
     */
    public function spostaSuAction($idCategoria, $idCampo)
    {

    }

    /**
     * Elimina un campo
     * @Route("/spostaGiu/{idCategoria}/{idCampo}")
     * @Security("has_role('ROLE_ADMIN')")
     * @param string $idCategoria la categoria
     * @param string $idCampo il campo
     * @return Response A Response instance
     *
     */
    public function spostaGiuAction($idCategoria, $idCampo)
    {

    }



}
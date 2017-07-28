<?php

namespace estar\rda\RdaBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityRepository;
use estar\rda\RdaBundle\Controller\UserCheckController;
use estar\rda\RdaBundle\Entity\Azienda;
use estar\rda\RdaBundle\Entity\FormTemplate;
use \Doctrine\ORM\EntityManager;
use estar\rda\RdaBundle\Entity\Richiestaaggregazione;
use estar\rda\RdaBundle\estarRdaBundle;
use Symfony\Bundle\FrameworkBundle\Routing\Router as Router;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use estar\rda\RdaBundle\Entity\Richiesta;


class FormTemplateService
{

    private $user;
    private $router;
    private $em;
    private $session;
    private $idRichiestaG;

    const MODE_INSERT = 0;
    const MODE_EDIT = 1;
    const MODE_PRINT = 2;

    public function __construct(UserCheckController $user, Router $router, EntityManager $em, $session)
    {
        $this->user = $user;
        $this->router = $router;
        $this->em = $em;
        $this->session = $session;

    }

    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_VALORI = '|';
    /** FG messa costante per poterla più facilmente editare in futuro */
    const SEPARATORE_CAMPI = '||';

    public function getChoicesOptions($string)
    {
        $options = explode(FormTemplateService::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateService::SEPARATORE_VALORI, $option);
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

    function getFirstLevel($string, $id)
    {
        $options = explode(FormTemplateService::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateService::SEPARATORE_VALORI, $option);
            array_push($returnOptions, $subOption[1] . FormTemplateService::SEPARATORE_VALORI . $id);
        }

        return $returnOptions;
    }

    function getFather($string)
    {
        $options = explode(FormTemplateService::SEPARATORE_CAMPI, $string);
        $subOption = explode(FormTemplateService::SEPARATORE_VALORI, $options[0]);

        return $subOption[0];
    }


    /**
     * @param FormBuilderInterface $builder
     * @param FormTemplate $entity
     * @param $mode il modo di utilizzo, 0 per creazione nuovo oggetto, 1 per edit oggetto
     * @return \Symfony\Component\Form\Form
     *
     */
    public function build(FormBuilderInterface $builder, $entity, $mode)
    {

        $idCategoria = (get_class($entity) == 'estar\rda\RdaBundle\Entity\Categoria') ? $entity : $entity->getIdCategoria();

        $diritti = $this->user->allRole($idCategoria);
        $utentesessione = $this->user->getIdUtente();
// //       $statusrichiesta = $entity->getStatus();
//
        //       if($diritti->getIsVA() and ($statusrichiesta=='attesa_val_amm' or $statusrichiesta=='da_inviare_ESTAR')){
        //           $prova='a';
        //       }
        //       elseif($diritti->getIsVT() and $statusrichiesta=='attesa_val_tec'){
        //           $prova='b';
//
        //       }
        //       elseif($diritti->getIsAI() and $statusrichiesta=='bozza'){
        //           $prova='c';
//
        //       }
        //       else{
        //           $prova='d';
//
        //       }

        $firstLevels = array();
        if ($mode == FormTemplateService::MODE_INSERT) {

            $campi = $entity->getCampi();
            //sono in modalita NEW

            $builder->add("titolo", "text", array(
                'label' => "Titolo",
                'attr' => array(
                    'placeholder'=> "Specificare un oggetto per la propria richiesta"),
                'constraints' => new NotNull()
            ));
            $builder->get('titolo')
                ->addModelTransformer(new CallbackTransformer(

                    function ($originalValue) {


                        if (is_numeric($originalValue)) {
                            return intval($originalValue);
                        } else {
                            return $originalValue;
                        }


                    },
                    function ($submittedValue) {

                        return $submittedValue;

                    }
                ));
            $builder->add("descrizione", "textarea", array(
                'label' => "Descrizione",
                'attr' => array(
                    'placeholder'=> "indicare descrizione, azienda sanitaria e UOC destinataria"),
                'constraints' => new NotNull()
            ));
            $builder->get('descrizione')
                ->addModelTransformer(new CallbackTransformer(

                    function ($originalValue) {


                        if (is_numeric($originalValue)) {
                            return intval($originalValue);
                        } else {
                            return $originalValue;
                        }


                    },
                    function ($submittedValue) {

                        return $submittedValue;

                    }
                ));
            //FG20160224 modifica per priorità
            $builder->add("priorita", "choice", array(
                'choices' => Richiesta::getPossibleEnumPriorita(),
                'label' => "Priorità richiesta",
                'data' => "3"
            ));

            // bisogna fare una select per selezionare l'azienda richiedente
            if ($this->user->getUtente()->getIdazienda()->getNome()=='ESTAR') {
                $builder->add("Azienda", "choice", array(
                    'choices' => $this->getAllAzienda(),
                    'label' => "Azienda richiedente",
                    //'data' => "3"
                ));}
            else{
                $builder->add("Azienda", "choice", array(
                    'label' => "Azienda richiedente",
                    'choices'=> array($this->user->getUtente()->getIdazienda()->getId() => $this->user->getUtente()->getIdazienda()->getNome()),
                    'attr' => array(
                        'read_only' => true
                    )));
            }

            if ($this->user->getUtente()->getIdazienda()->getNome()=='ESTAR') {
                $builder->add('Azienda_agg', 'choice', array(
                    'choices' => $this->getAllAzienda(),
                    "multiple" => true,
                    "expanded" => true,
                    'label'    => 'NEL CASO DI RICHIESTE PROGRAMMATE DA PARTE DI ESTAR PER LE AZIENDE',
                    'attr' => array('class' => 'richiesta_abs')

                ));
            }

            foreach ($campi as $campo) {
                //FG 20151027 modifica per campi visualizzabili a seconda dei diritti
                if (!($diritti->campoVisualizzabile($diritti, $campo))) continue;

                $obbligatorio = $campo->getObbligatorioinserzione();
                if ($campo->getTipo() == 'choice') {
                    //Se è una scelta
                    if ($campo->getPadre() != null) {
                        //se è un figlio, ha come classe "secondLevel"
                        $class = array('class' => 'secondLevel');
                        $padri = $this->getFirstLevel($campo->getPadre(), $campo->getId());

                        if (array_key_exists($this->getFather($campo->getPadre()), $firstLevels)) {
                            array_push($firstLevels[$this->getFather($campo->getPadre())], $padri);
                        } else {
                            $firstLevels[$this->getFather($campo->getPadre())] = $padri;
                        }

                    } else {
                        //Altrimenti ha come classe "firstLevel
                        $class = array('class' => 'firstLevel');
                    }
                    $options = $this->getChoicesOptions($campo->getFieldset());

                    if ($obbligatorio) {
                        if ($campo->getPadre() != null) {
                            //Ha un padre
//                            $padre = $campo->getCampopadre();
//                            $class['padre'] = $padre->getNome().'-'.$padre->getId();
                            $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                                'choices' => $options,
                                'expanded' => true,
                                'multiple' => false,
                                'label' => $campo->getDescrizione(),
                                //'constraints' => new NotNull(),
                                'attr' => $class
                            ));
                        } else {
                            //non ha un padre
                            $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                                'choices' => $options,
                                'expanded' => true,
                                'multiple' => false,
                                'label' => $campo->getDescrizione(),
                                'constraints' => new NotNull(),
                                'attr' => $class
                            ));
                        }
                        $builder->get($campo->getNome() . '-' . $campo->getId())
                            ->addModelTransformer(new CallbackTransformer(

                                function ($originalValue) {


                                    if (is_numeric($originalValue)) {
                                        return intval($originalValue);
                                    } else {
                                        return $originalValue;
                                    }


                                },
                                function ($submittedValue) {

                                    return $submittedValue;

                                }
                            ));

                    } else {
                        //non è obbligatorio
                        $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                            'choices' => $options,
                            'expanded' => true,
                            'multiple' => false,
                            'label' => $campo->getDescrizione(),
                            //'constraints' => new NotNull(),
                            'attr' => $class
                        ));
                        $builder->get($campo->getNome() . '-' . $campo->getId())
                            ->addModelTransformer(new CallbackTransformer(

                                function ($originalValue) {


                                    if (is_numeric($originalValue)) {
                                        return intval($originalValue);
                                    } else {
                                        return $originalValue;
                                    }


                                },
                                function ($submittedValue) {

                                    return $submittedValue;

                                }
                            ));
                    }

                } else {
                    //Non è di tipo choice
                    $class = array();
                    $label = $campo->getDescrizione();

                    if ($campo->getPadre() != null) {
                        $class = array('class' => 'secondLevel');
                        $padri = $this->getFirstLevel($campo->getPadre(), $campo->getId());

                        if (array_key_exists($this->getFather($campo->getPadre()), $firstLevels)) {
                            array_push($firstLevels[$this->getFather($campo->getPadre())], $padri[0]);
                        } else {
                            $firstLevels[$this->getFather($campo->getPadre())] = $padri;
                        }

                    }

                    //var_dump(is_null($campo->getCampopadre()));

                    if ($obbligatorio) {
                        $builder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                            'label' => $label,
                            'constraints' => new NotNull(),
                            'attr' => $class
                        ));
                    } else {
                        $builder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                            'label' => $label,
                            'attr' => $class
                        ));
                    }
                    $builder->get($campo->getNome() . '-' . $campo->getId())
                        ->addModelTransformer(new CallbackTransformer(

                            function ($originalValue) {


                                if (is_numeric($originalValue)) {
                                    return intval($originalValue);
                                } else {
                                    return $originalValue;
                                }


                            },
                            function ($submittedValue) {

                                return $submittedValue;

                            }
                        ));
                }
            }
            $builder->setAction($this->router->generate('formtemplate_create', array('idCategoria' => $idCategoria)));
            $builder->setMethod('POST');
            $builder->add('submit', 'submit', array('label' => 'Salva e chiudi', 'attr' => array('class' => 'bottoniera')));

            return array(0 => $builder->getForm(), 1 => $firstLevels);
        } else {
            //sono in modalita EDITedit/1/28

            $em = $this->em;
            if (get_class($entity) != 'estar\rda\RdaBundle\Entity\Categoria') {
                $idRichiesta = $entity->getId();
                $this->idRichiestaG = $idRichiesta;
                $idCategoria = $idCategoria->getId();
                $idAzienda = $entity->getIdAzienda()->getId();
                //FG bugfix: in edit tira giù i campi tutte le categorie.
                $query = $em->createQuery('SELECT c.id AS idcampo, identity (c.idcategoria) as pippocategoria, c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,c.padre,vc.id,vc.valore
                                    FROM estarRdaBundle:Campo c LEFT JOIN estarRdaBundle:Valorizzazionecamporichiesta vc
                                    WITH c.id = vc.idcampo
                                    AND vc.idrichiesta = :idRichiesta
                                    AND c.idcategoria = :idCategoria
                                    ORDER BY c.ordinamento')
                    ->setparameters(array('idRichiesta' => $idRichiesta, 'idCategoria' => $idCategoria));


                //FG20160317 hack: non c'è verso di far capire a doctrine che voglio solo quelli di una categoria.
                $campiValorizzatiIntermedi = $query->getResult();
                //Itero sul risultato e sego. Mi vergogno di me stesso.
                $campiValorizzati = array();
                foreach ($campiValorizzatiIntermedi as $campovalorizzato) {
                    $campoTemp = $campovalorizzato;
                    if ($campoTemp['pippocategoria'] == $idCategoria)
                        array_push($campiValorizzati, $campoTemp);
                }
            } else {
                $idCategoria = $idCategoria->getId();
                $query = $em->createQuery('SELECT c.id, c.nome,c.descrizione,c.fieldset,c.tipo,c.dataattivazione,c.padre
                                    FROM estarRdaBundle:Campo c
                                    WHERE c.idcategoria = :idCategoria
                                    ORDER BY c.ordinamento')
                    ->setparameter('idCategoria', $idCategoria);

                $campiValorizzati = $query->getResult();


            }

            if((!$entity->isCp() OR !$entity->isAssenzaconflitto()) AND $entity->getStatus()!="inviata_ESTAR" AND $entity->getStatus()!="annullata" AND $entity->getStatus()!="eliminata"){
                if ($_SERVER['SERVER_NAME'] != "rda.estar.toscana.it" and $_SERVER['SERVER_NAME'] != "159.213.95.80") {
                    $messaggio= "<strong><a href=\"http://swtest.estav-sudest.toscana.it/rda/web/app.php/documento/byCategoria/$idRichiesta/$idCategoria\">RICORDARSI DI ALLEGARE I DOCUMENTI RICHIESTI IN FORMATO PDF</a></strong>";

                }
                else if($_SERVER['SERVER_NAME']=='localhost' or $_SERVER['SERVER_NAME']=='127.0.0.1'){
                    $messaggio= "<strong><a href=\"http://localhost/rda/web/app.php/documento/byCategoria/$idRichiesta/$idCategoria\">RICORDARSI DI ALLEGARE I DOCUMENTI RICHIESTI IN FORMATO PDF</a></strong>";

                }else{
                    $messaggio= "<strong><a href=\"http://rda.estar.toscana.it/rda/web/app.php/documento/byCategoria/$idRichiesta/$idCategoria\">RICORDARSI DI ALLEGARE I DOCUMENTI RICHIESTI IN FORMATO PDF</a></strong>";
                }
                $this->session->getFlashBag()->add(
                    'notice',
                    array(
                        "alert" => "danger",
                        "title" => "ATTENZIONE:",
                        "message" => "$messaggio"
                    )
                );
            }

            //FG 20151016 gestione dei campi della richiesta

            //controllo sul tipo di utente!!
            $statusrichiesta = $entity->getStatus();
            $permessoscrittura=0;
            if($statusrichiesta=='bozza'
                or ($diritti->getIsVT() and $statusrichiesta=='attesa_val_tec')
                or ($diritti->getIsVA() and ($statusrichiesta=='attesa_val_amm' or $statusrichiesta=='da_inviare_ESTAR')))
            {    $permessoscrittura = 1;
            }
            if (get_class($entity) != 'estar\rda\RdaBundle\Entity\Categoria') {
                //FG20170404 refactoring di un codice francamente orribile.
                //nuovo giro: se sono in modalità "print", titolo, priorità, descrizione e azienda richiedente
                //sono nel printbase.
                //diversamente, vengono messi come campi form readonly se ho permesso di scrittura, non readonly
                //se non sono in permesso di scrittura
                if ($mode == FormTemplateService::MODE_PRINT) {
                    //sono in modalità stampa. Non faccio nulla: gli oggetti sono aggiunti da doPrint di formTemplateController
                    $builder->add("titolo", "text", array(
                        'label' => "Titolo",
                        'data' => $entity->getTitolo(),
                        'disabled' => "disabled"

                    ));
                    $builder->add("descrizione", "textarea", array(
                        'label' => "Descrizione",
                        'data' => $entity->getDescrizione(),
                        'disabled' => "disabled",
                    ));
                    $builder->add("priorita", "choice", array(
                        'choices' => Richiesta::getPossibleEnumPriorita(),
                        'label' => "Priorità richiesta",
                        'data' => $entity->getPriorita(),
                        'disabled' => "disabled",

                    ));
                    $builder->add("azienda", "choice", array(
                        'choices' => $this->getAllAzienda(),
                        'label' => "Azienda Richiedente",
                        'disabled' => "disabled",
                        'data' => $idAzienda
                    ));
                    if ($this->user->getUtente()->getIdazienda()->getNome()=='ESTAR') {

                        $builder->add('Azienda_agg', 'choice', array(
                            'choices' => $this->getAllAzienda(),
                            "multiple" => true,
                            'disabled' => "disabled",
//                                'property' => 'nome',
                            "expanded" => true,
                            'choice_attr' => function($obj) {
                                if ($this->ricercaAzienda($obj)){
                                    return ['checked' => 'true'];
                                }
                                else{
                                    return array();
                                }
                            },
                            'label'    => 'NEL CASO DI RICHIESTE PROGRAMMATE DA PARTE DI ESTAR PER LE AZIENDE'
                        ));
                    }
                } else {
                    if ($permessoscrittura) {
                        //ho permesso di scrittura. Devo aggiungere titolo, descrizione, priorità e azienda come campi editabili
                        $builder->add("titolo", "text", array(
                            'label' => "Titolo",
                            'data' => $entity->getTitolo(),
                            'constraints' => new NotNull()
                        ));
                        $builder->add("descrizione", "textarea", array(
                            'label' => "Descrizione",
                            'data' => $entity->getDescrizione(),
                            'constraints' => new NotNull()
                        ));
                        $builder->add("priorita", "choice", array(
                            'choices' => Richiesta::getPossibleEnumPriorita(),
                            'label' => "Priorità richiesta",
                            'data' => $entity->getPriorita()
                        ));
                        $builder->add("azienda", "choice", array(
                            'choices' => $this->getAllAzienda(),
                            'label' => "Azienda Richiedente",
                            'disabled' => "disabled",
                            'data' => $idAzienda
                        ));
                        if ($this->user->getUtente()->getIdazienda()->getNome()=='ESTAR') {

                            $builder->add('Azienda_agg', 'choice', array(
                                'choices' => $this->getAllAzienda(),
                                "multiple" => true,
//                                'property' => 'nome',
                                "expanded" => true,
                                'choice_attr' => function($obj) {
                                if ($this->ricercaAzienda($obj)){
                                    return ['checked' => 'true'];
                                }
                                else{
                                    return array();
                                }
                            },
                                'label'    => 'NEL CASO DI RICHIESTE PROGRAMMATE DA PARTE DI ESTAR PER LE AZIENDE'
                            ));
                        }
                        //FG 20170404 ho rimosso le chiamate al callbackTransformer, probabilmente frutto di un copia e incolla, perchè non ne colgo l'utilità
                    } else {
                        //non ho permesso di scrittura: i campi devono essere read only
                        $builder->add("titolo", "text", array(
                            'label' => "Titolo",
                            'data' => $entity->getTitolo(),
                            'read_only' => true,
                            'disabled' => "disabled",
                        ));
                        $builder->add("descrizione", "textarea", array(
                            'label' => "Descrizione",
                            'data' => $entity->getDescrizione(),
                            'read_only' => true,
                            'disabled' => "disabled"
                        ));
                        //FG20160224 modifica per priorità
                        $builder->add("priorita", "choice", array(
                            'choices' => Richiesta::getPossibleEnumPriorita(),
                            'label' => "Priorità richiesta",
                            'disabled' => "disabled",
                            'read_only' => true,
                            'data' => $entity->getPriorita()
                        ));
                        $builder->add("Azienda", "choice", array(
                            'choices' => $this->getAllAzienda(),
                            'label' => "Azienda Richiedente",
                            'disabled' => "disabled",
                            'read_only' => true,
                            'data' => $idAzienda
                        ));

                    }
                }
            }
            //        $fieldsetVisitati = array();
            $richiesta1 = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
            $datarichiesta= $richiesta1->getDataora();

            $firstLevels = array();
            foreach ($campiValorizzati as $campovalorizzato) {
//            $campo = $campovalorizzato->getIdcampo();
                $campo = $campovalorizzato;
                //FG20151028 se il campo non è visualizzabile, skip.
                $repository = $em->getRepository('estarRdaBundle:Campo');
                if (get_class($entity) != 'estar\rda\RdaBundle\Entity\Categoria') {
                    $campoCheck = $repository->find($campo['idcampo']);
                    //DEM 20160520 I campi che hanno una data dismissione precedenti ad oggi non si vedono!
                    if (!is_null($campoCheck->getDatadismissione())) {
                        if($datarichiesta < $campoCheck->getDataattivazione() && $datarichiesta > $campoCheck->getDatadismissione()) continue;
                    }
                    if (!($diritti->campoVisualizzabile($diritti, $campoCheck))) continue;
                } else {
                    $campo['valore'] = '';
                }
//            if ($campo->getTipo() == 'choice') {
                if ($campo['tipo'] == 'choice') {
                    //FG 20170404 perchè questo codice sotto era commentato?

                    if ($campo['padre'] != null) {

                        /**verifico che il campo abbia un valore settato e setto la classe appropriata per permettere
                         * al jquery di visualizzarlo in edit
                         * */
                        if (isset($campo['valore'])) {
                            $class = array('class' => 'secondLevel valorizzato');

                        } else {
                            $class = array('class' => 'secondLevel ');
                        }
                        //fine modifica per jquery
                        $padri = $this->getFirstLevel($campo['padre'], $campo['idcampo']);

                        if (array_key_exists($this->getFather($campo['padre']), $firstLevels)) {
                            array_push($firstLevels[$this->getFather($campo['padre'])], $padri);
                        } else {
                            $firstLevels[$this->getFather($campo['padre'])] = $padri;
                        }
                    } else
                        $class = array('class' => 'firstLevel'); //è un first level
                    //FG20170404 END

                    //discrimino il caso della stampa
                    if ($mode == FormTemplateService::MODE_PRINT or !$permessoscrittura) {
                        //$descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                        $options = $this->getChoicesOptions($campo['fieldset']);
                        $builder->add($campo['nome'] . '-' . $campo['idcampo'], 'text', array(
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'read_only' => true,
                            'disabled' => "disabled",
                            'attr' => $class
                        ));


                    } else {
                        //TODO controllo del tipo di utente!!!!

                        $options = $this->getChoicesOptions($campo['fieldset']);
                        $builder->add($campo['nome'] . '-' . $campo['idcampo'], 'choice', array(
                            'choices' => $options,
                            'expanded' => true,
                            'multiple' => false,
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'attr' => $class
                        ));
                    }

                    $builder->get($campo['nome'] . '-' . $campo['idcampo'])
                        ->addModelTransformer(new CallbackTransformer(
                            function ($originalValue) {
                                if ("" === $originalValue) return null;
                                if (is_numeric($originalValue)) {
                                    return intval($originalValue);
                                } else {
                                    return $originalValue;
                                }
                            },
                            function ($submittedValue) {
                                return $submittedValue;
                            }
                        ));

                } else {
                    //discrimino il caso della stampa
                    if ($mode == FormTemplateService::MODE_PRINT or !$permessoscrittura) {
                        $builder->add($campo['nome'] . '-' . $campo['idcampo'], $campo['tipo'], array(
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'read_only' => true,
                            'disabled' => "disabled"
                        ));
                    } else {
                        //TODO controllo del tipo di utente!!!!
                        $class = array();
                        $label = $campo['descrizione'];
                        if ($campo['padre'] != null) {

                            /**verifico che il campo abbia un valore settato e setto la classe appropriata per permettere
                             * al jquery di visualizzarlo in edit
                             * */
                            if(isset($campo['valore'])){
                                $class = array('class' => 'secondLevel valorizzato');

                            } else{
                                $class = array('class' => 'secondLevel ');
                            }
                            //fine modifica per jquery
                            $padri = $this->getFirstLevel($campo['padre'], $campo['idcampo']);

                            if (array_key_exists($this->getFather($campo['padre']), $firstLevels)) {
                                array_push($firstLevels[$this->getFather($campo['padre'])], $padri);
                            } else {
                                $firstLevels[$this->getFather($campo['padre'])] = $padri;
                            }


                        }
                        $builder->add($campo['nome'] . '-' . $campo['idcampo'], $campo['tipo'], array(
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'attr' => $class
                        ));
                    }
                    $builder->get($campo['nome'] . '-' . $campo['idcampo'])
                        ->addModelTransformer(new CallbackTransformer(

                            function ($originalValue) {

                                if ("" === $originalValue) return null;

                                if (is_numeric($originalValue)) {
                                    return intval($originalValue);
                                } else {
                                    return $originalValue;
                                }


                            },
                            function ($submittedValue) {

                                return $submittedValue;

                            }
                        ));

                }
            }

//            $em = $this->getDoctrine()->getManager();
//            $entity = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);


//        if (!$entity) {
//            throw $this->createNotFoundException('Unable to find FormTemplate entity.');
//        }
            if ($mode != FormTemplateService::MODE_PRINT) {
                if (get_class($entity) != 'estar\rda\RdaBundle\Entity\Categoria') {
                    $builder->setAction($this->router->generate('formtemplate_update', array('idCategoria' => $idCategoria, 'idRichiesta' => $idRichiesta)));
                } else {
                    $builder->setAction($this->router->generate('categoria_update', array('id' => $idCategoria)));
                }
                $richiesta = $em->getRepository('estarRdaBundle:Richiesta')->find($idRichiesta);
                //TODO non riesco a tirare su la statemachine e quindi ho preso l'ultimo stato dalla richiesta
                $stato = $richiesta->getStatus();
                if ( !$permessoscrittura or $stato =='rigetto_ESTAR') {
                    //if(!$entity->isCp()){
                    //}
                    $builder->add('submit', 'submit', array('label' => ' Salva e chiudi', 'attr' => array('class' => 'bottoniera btn btn-success', 'disabled' => 'disabled', 'icon' => 'glyphicon glyphicon-ok')));
                } else {
                    $builder->add('submit', 'submit', array('label' => ' Salva e chiudi', 'attr' => array('class' => 'bottoniera btn btn-success', 'icon' => 'glyphicon glyphicon-ok')));
                }
            }
            return array(0 => $builder->getForm(), 1 => $firstLevels);
        }


    }


    /**
     * @param OptionsResolverInterface $resolver
     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'estar\rda\RdaBundle\Entity\FormTemplate'
//        ));
//    }

    /**
     * @return string
     */
    public
    function getName()
    {
        return 'estar_rda_rdabundle_FormTemplate';
    }

    public function getAllAzienda(){
        $aziende = new ArrayCollection();
        $azienda = $this->em->getRepository('estarRdaBundle:Azienda')->findBy(array(),array('nome'=>'ASC'));
        foreach ($azienda as $item){
            $aziende->set($item->getId(),$item->getNome());
        }
        return $aziende;
    }
    function ricercaAzienda($obj){
        $richiesteAggregate = $this->em->getRepository('estarRdaBundle:Richiestaaggregazione')->findBy( array('idrichiesta' => $this->idRichiestaG));
        foreach ($richiesteAggregate as $richiesta){
            if ($richiesta->getIdazienda()->getId() == $obj)
                return true;
            else
                continue;
        }

    }

}
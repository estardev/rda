<?php

namespace estar\rda\RdaBundle\Form;

use estar\rda\RdaBundle\Entity\FormTemplate;
use \Doctrine\ORM\EntityManager;
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


    const MODE_INSERT = 0;
    const MODE_EDIT = 1;
    const MODE_PRINT = 2;

    public function __construct($user, Router $router, EntityManager $em)
    {
        $this->user = $user;
        $this->router = $router;
        $this->em = $em;

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

        if ($mode == FormTemplateService::MODE_INSERT) {

            $campi = $entity->getCampi();
            //sono in modalita NEW

            $builder->add("titolo", "text", array(
                'label' => "Titolo",
                'data' => "Specificare un oggetto per la propria richiesta"
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
                'data' => "indicare descrizione, azienda sanitaria e UOC destinataria"
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

            $firstLevels = array();
            foreach ($campi as $campo) {
                //FG 20151027 modifica per campi visualizzabili a seconda dei diritti
                if (!($diritti->campoVisualizzabile($diritti, $campo))) continue;

                $obbligatorio = $campo->getObbligatorioinserzione();
                if ($campo->getTipo() == 'choice') {

                    if ($campo->getPadre() != null) {
                        $class = array('class' => 'secondLevel');
                        $padri = $this->getFirstLevel($campo->getPadre(), $campo->getId());

                        if (array_key_exists($this->getFather($campo->getPadre()), $firstLevels)) {
                            array_push($firstLevels[$this->getFather($campo->getPadre())], $padri);
                        } else {
                            $firstLevels[$this->getFather($campo->getPadre())] = $padri;
                        }

                    } else {
                        $class = array('class' => 'firstLevel');
                    }
                    $options = $this->getChoicesOptions($campo->getFieldset());

                    if ($obbligatorio) {
                        $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                            'choices' => $options,
                            'expanded' => true,
                            'multiple' => false,
                            'label' => $campo->getDescrizione(),
                            'constraints' => new NotNull(),
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

                    } else {
                        $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                            'choices' => $options,
                            'expanded' => true,
                            'multiple' => false,
                            'label' => $campo->getDescrizione(),
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
                $idCategoria = $idCategoria->getId();

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


            //FG 20151016 gestione dei campi della richiesta

            if (get_class($entity) != 'estar\rda\RdaBundle\Entity\Categoria') {
                if ($mode == FormTemplateService::MODE_PRINT) {
                    $builder->add("titolo", "text", array(
                        'label' => "Titolo",
                        'data' => $entity->getTitolo(),
                        'read_only' => true,
                        'disabled' => "disabled"
                    ));
                }
                else{
                    $builder->add("titolo", "text", array(
                        'label' => "Titolo",
                        'data' => $entity->getTitolo()
                    ));
                }
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
                if ($mode == FormTemplateService::MODE_PRINT) {
                    $builder->add("descrizione", "textarea", array(
                        'label' => "Descrizione",
                        'data' => $entity->getDescrizione(),
                        'read_only' => true,
                        'disabled' => "disabled"
                    ));
                }
                else{
                    $builder->add("descrizione", "textarea", array(
                        'label' => "Descrizione",
                        'data' => $entity->getDescrizione()
                    ));
                }
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
            }
            //        $fieldsetVisitati = array();
            $firstLevels = array();
            foreach ($campiValorizzati as $campovalorizzato) {
//            $campo = $campovalorizzato->getIdcampo();
                $campo = $campovalorizzato;
                //FG20151028 se il campo non è visualizzabile, skip.
                $repository = $em->getRepository('estarRdaBundle:Campo');
                if (get_class($entity) != 'estar\rda\RdaBundle\Entity\Categoria') {

                    $campoCheck = $repository->find($campo['idcampo']);
                    if (!($diritti->campoVisualizzabile($diritti, $campoCheck))) continue;
                } else {

                    $campo['valore'] = '';
                }
//            if ($campo->getTipo() == 'choice') {
                if ($campo['tipo'] == 'choice') {
                    $class = array('class' => 'firstLevel');

                    //discrimino il caso della stampa
                    if ($mode == FormTemplateService::MODE_PRINT) {
                        //$descrizioneValore = $this->selectedOption($this->getChoicesOptions($campoCheck->getFieldset()), $campo['valore']);
                        $options = $this->getChoicesOptions($campo['fieldset']);
                        $builder->add($campo['nome'] . '-' . $campo['idcampo'], 'text', array(
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'read_only' => true,
                            'disabled' => "disabled"
                        ));


                    } else {


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
                    if ($mode == FormTemplateService::MODE_PRINT) {
                        $builder->add($campo['nome'] . '-' . $campo['idcampo'], $campo['tipo'], array(
                            'label' => $campo['descrizione'],
                            'data' => $campo['valore'],
                            'read_only' => true,
                            'disabled' => "disabled"
                        ));
                    } else {

                        $class = array();
                        $label = $campo['descrizione'];
                        if ($campo['padre'] != null) {
                            $class = array('class' => 'secondLevel');
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
                if ($stato == 'inviata_ABS' or $stato =='rigetto_ABS') {
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
}
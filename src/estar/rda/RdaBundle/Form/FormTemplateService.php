<?php

namespace estar\rda\RdaBundle\Form;

use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class FormTemplateService
{

    private $user;
    private $router;


    public function __construct($user, $router)
    {
        $this->user = $user;
        $this->router = $router;
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

    function getFirstLevel($string)
    {
        $options = explode(FormTemplateService::SEPARATORE_CAMPI, $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode(FormTemplateService::SEPARATORE_VALORI, $option);
            array_push($returnOptions, $subOption[1]);
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
     * @return \Symfony\Component\Form\Form
     *
     */
    public function build(FormBuilderInterface $builder, FormTemplate $entity)
    {

        $campi = $entity->getCampi();

        $diritti = $this->user->allRole($entity->getIdCategoria());

        $builder->add("titolo", "text", array(
            'label' => "Titolo",
            'data' => "Specificare un oggetto per la propria richiesta"
        ));
        $builder->add("descrizione", "textarea", array(
            'label' => "Descrizione",
            'data' => "indicare descrizione, azienda sanitaria e UOC destinataria"
        ));

        $firstLevels = array();
        foreach ($campi as $campo) {
            //FG 20151027 modifica per campi visualizzabili a seconda dei diritti
            if (!($diritti->campoVisualizzabile($diritti, $campo))) continue;

            $obbligatorio = $campo->getObbligatorioinserzione();
            if ($campo->getTipo() == 'choice') {
                $class = array('class' => 'firstLevel');

                $options = $this->getChoicesOptions($campo->getFieldset());

                if ($obbligatorio) {
                    $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                        'choices' => $options,
                        'expanded' => true,
                        'multiple' => false,
                        'label' => $campo->getDescrizione(),
                        'constraints' => new NotBlank(),
                        'attr' => $class
                    ));
                } else {
                    $builder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                        'choices' => $options,
                        'expanded' => true,
                        'multiple' => false,
                        'label' => $campo->getDescrizione(),
                        'attr' => $class
                    ));
                }

            } else {
                $class = array();
                $label = $campo->getDescrizione();

                if ($campo->getPadre() != null) {
                    $class = array('class' => 'secondLevel');
                    $padri = $this->getFirstLevel($campo->getPadre());
                    $firstLevels[$this->getFather($campo->getPadre())] = $padri;

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
            }
        }
        $builder->setAction($this->router->generate('formtemplate_create', array('idCategoria' => $entity->getIdcategoria())));
        $builder->setMethod('POST');
        $builder->add('submit', 'submit', array('label' => 'Salva e chiudi', 'attr' => array('class' => 'bottoniera')));


        return array(0 => $builder->getForm(), 1 => $firstLevels);
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
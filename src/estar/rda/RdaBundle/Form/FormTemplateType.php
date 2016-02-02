<?php

namespace estar\rda\RdaBundle\Form;

use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class FormTemplateType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $campi = '';
        $formFactory = $builder->getFormFactory();
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($formFactory) {
            $form = $event->getForm();
            $data = $event->getData();
            $campi = $data->getCampi();

            if ($data instanceof FormTemplate) {
                $form->add($formFactory->createNamed('value', $data->getType()));

                $form->add("titolo", "text", array(
                    'label' => "Titolo",
                    'data' => "Specificare un oggetto per la propria richiesta"
                ));
                $form->add("descrizione", "textarea", array(
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
                            $form->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                                'choices' => $options,
                                'expanded' => true,
                                'multiple' => false,
                                'label' => $campo->getDescrizione(),
                                'constraints' => new NotBlank(),
                                'attr' => $class
                            ));
                        } else {
                            $form->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
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
                            $form->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                                'label' => $label,
                                'constraints' => new NotNull(),
                                'attr' => $class
                            ));
                        } else {
                            $form->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                                'label' => $label,
                                'attr' => $class
                            ));
                        }
                    }
                }

            }

        });

    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\FormTemplate'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_FormTemplate';
    }
}
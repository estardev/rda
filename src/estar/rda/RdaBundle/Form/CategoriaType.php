<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', null, array('label' => 'Nome'))
            ->add('descrizione', null, array('label' => 'Descrizione'))
            ->add('idarea', 'entity', array(
        'class' => 'estar\rda\RdaBundle\Entity\Area',
        'choice_label' => 'descrizione',
        'label' => 'Area',
    ));




//        $builder->add('campi', null, array('label' => 'Campi', 'type' => new CampoType(), 'mapped' => false, 'options' => array('data_class' => 'estar\rda\RdaBundle\Entity\Campo')));
        $builder->add('campi', 'collection', array(
            'type' => new CampoType(),
            'allow_add' => true,
            'allow_delete' => true,
            'by_reference' => false
//            'mapped' => false
//            'prototype' => true,

        ));
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Categoria'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_categoria';
    }
}

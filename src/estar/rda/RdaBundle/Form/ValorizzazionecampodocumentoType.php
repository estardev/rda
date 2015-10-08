<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ValorizzazionecampodocumentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('valore',null, array('label' => 'Valore'))
            ->add('idrichiestadocumento',null, array('label' => 'Richiesta Documento'))
            ->add('idcampodocumento',null, array('label' => 'Campo Documento'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Valorizzazionecampodocumento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_valorizzazionecampodocumento';
    }
}

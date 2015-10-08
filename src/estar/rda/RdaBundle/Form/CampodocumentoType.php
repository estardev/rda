<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampodocumentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('iddocumento', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Documento',
                'choice_label' => 'nomedescrizione',
                'label' => 'Documento',
            ))
            ->add('idcampo', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Campo',
                'choice_label' => 'nome',
                'label' => 'Campo',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Campodocumento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_campodocumento';
    }
}

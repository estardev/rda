<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoliberoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('descrizione',null, array('label' => 'Descrizione', 'constraints' => new NotNull()))
            ->add('image_file','file', array('label' => 'File', 'constraints' => new NotNull()))

        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Richiestadocumentolibero'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_documentolibero';
    }
}

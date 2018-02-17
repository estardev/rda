<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class UtentegruppoutenteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('amministratore', CheckboxType::class, array('label' => 'Amministratore'))
            ->add('idutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Utente',
                'choice_label' => 'utenteldap',
                'label' => 'Utente',
            ))
            ->add('idgruppoutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
                'choice_label' => 'nome',
                'label' => 'Gruppo Utente',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Utentegruppoutente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_utentegruppoutente';
    }
}

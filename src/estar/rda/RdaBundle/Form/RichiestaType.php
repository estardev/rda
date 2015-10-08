<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RichiestaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeropratica',null, array('label' => 'Numero Pratica'))
            ->add('status',null, array('label' => 'Stato Pratica'))
            ->add('numeroprotocollo',null, array('label' => 'Numero Protocollo'))
            ->add('idcategoria', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Categoria',
                'choice_label' => 'descrizione',
                'label' => 'Categoria',
            ))
            ->add('idazienda', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Azienda',
                'choice_label' => 'nome',
                'label' => 'Azienda',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Richiesta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_richiesta';
    }
}

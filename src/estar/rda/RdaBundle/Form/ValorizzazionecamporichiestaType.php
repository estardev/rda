<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ValorizzazionecamporichiestaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /**
         * David: aggiunto il metodo per recuperare il campo descrizione di cateogoria nel menu a tendina
         */
        $builder
            ->add('valore')
            ->add('idcategoria', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Categoria',
                'choice_label' => 'descrizione',
                'label' => 'Categoria',
            ))
            ->add('idrichiesta', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Richiesta',
                'choice_label' => 'numeropratica',
                'label' => 'Richiesta (Numero pratica)',
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
            'data_class' => 'estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_valorizzazionecamporichiesta';
    }
}

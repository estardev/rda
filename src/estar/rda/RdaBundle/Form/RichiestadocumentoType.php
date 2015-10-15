<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RichiestadocumentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datainvio',null, array('label' => 'Data Invio'))
            ->add('numeroprotocollo',null, array('label' => 'Numero Protocollo'))
            ->add('filepath',null, array('label' => 'Percorso File'))
            ->add('idrichiesta', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Richiesta',
                'choice_label' => 'numeropratica',
                'label' => 'Richiesta (Numero pratica)',
            ))
            ->add('iddocumento', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Documento',
                'choice_label' => 'nomedescrizione',
                'label' => 'Documento',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Richiestadocumento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_richiestadocumento';
    }
}

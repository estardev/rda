<?php

namespace estar\rda\RdaBundle\Form;

use estar\rda\RdaBundle\Entity\Campo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampoFiglioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('nome')
            ->add('descrizione')
            ->add('tipo','choice',array('choices'=>Campo::getPossibleEnumValuesFiglio()))
            ->add('padre')
//           ->add('obbligatoriovalidazioneamministrativa')
//            ->add('obbligatorioinserzione')
//            ->add('obbligatoriovalidazionetecnica')
//            ->add('ordinamento')
//            ->add('dataattivazione')
//            ->add('datadismissione')
//            ->add('idcategoria')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Campo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_campo';
    }
}

<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RichiestautenteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('creatore',null, array('label' => 'Creatore'))
            ->add('validatoretecnico',null, array('label' => 'Validatore Tecnico'))
            ->add('validatoreamministrativo',null, array('label' => 'Validatore Amministrativo'))
            ->add('referenteabs',null, array('label' => 'Referente ABS'))
            ->add('idutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Utente',
                'choice_label' => 'utenteldap',
                'label' => 'Utente',
            ))
            ->add('idrichiesta', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Richiesta',
                'choice_label' => 'numeropratica',
                'label' => 'Richiesta (Numero pratica)',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Richiestautente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_richiestautente';
    }
}

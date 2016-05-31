<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UtenteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("email", "text", array(
            'label' => "Indirizzo Email",
        ));
        $builder->add("username", "text", array(
            'label' => "Username",
        ));
        $builder->add("nomecognome", "text", array(
            'label' => "Nome e Cognome",
        ));
        $builder->add("utentecartaoperatore", "text", array(
            'label' => "Codice fiscale carta operatore",
            'required' => false,
        ));

        $builder->add('idazienda', 'entity', array(
            'class' => 'estar\rda\RdaBundle\Entity\Azienda',
            'choice_label' => 'nome',
            'label' => 'Azienda',
        ));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Utente'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_utente';
    }
}

<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Indirizzo Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'Username', 'translation_domain' => 'FOSUserBundle'))
             ->add('nomecognome',null, array('label' => 'Nome e Cognome'))
            ->add('codicefiscale',null, array('label' => 'Codice Fiscale ho detto'))
            ->add('idazienda', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Azienda',
                'choice_label' => 'nome',
                'label' => 'Azienda',
            ))
            ->add('gruppiutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
                'property' => 'nome',
                'multiple' => true,
                'expanded' => true,
                'attr' => array('class'=>'gruppiutenteCheckbox'),
                'label' => 'Gruppi Utente',
            ))
        ;
    }


    public function getParent()
    {
        return 'fos_user_profile';
    }

    public function getName()
    {
        return 'app_user_profile';
    }


}

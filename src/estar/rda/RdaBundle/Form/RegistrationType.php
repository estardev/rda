<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'email', array('label' => 'Indirizzo Email', 'translation_domain' => 'FOSUserBundle'))
            ->add('username', null, array('label' => 'Username', 'translation_domain' => 'FOSUserBundle'))
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Conferma Password'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
             ->add('nomecognome',null, array('label' => 'Nome e Cognome'))
            ->add('codicefiscale',null, array('label' => 'Codice Fiscale'))
            ->add('idazienda', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Azienda',
                'choice_label' => 'nome',
                'label' => 'Azienda',
            ))
            ->add('gruppiutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
                'choice_label' => function ($gruppoutente) {
                    return $gruppoutente->getNome().' ('.$gruppoutente->getDescrizione().')';
                },
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
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_user_registration';
    }
}

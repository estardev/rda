<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use estar\rda\RdaBundle\Entity\GenericDoctrine;

class RegistrationType extends AbstractType
{
    public function __construct($em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*$repository = $this->em->getRepository('estarRdaBundle:Azienda');
        $aziende = $repository->findAll();

        foreach($aziende as $azienda){

        }*/

        $builder
            ->add('nomecognome',null, array('label' => 'Nome e Cognome'))
            ->add('codicefiscale',null, array('label' => 'Codice Fiscale'))
            ->add('idazienda', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Azienda',
                'choice_label' => 'nome',
                'label' => 'Azienda',
            ))
            ->add('idgruppoutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
                'choice_label' => 'nome',
                'label' => 'Gruppo Utente',
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

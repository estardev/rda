<?php

namespace estar\rda\RdaBundle\Form;

use estar\rda\RdaBundle\Entity\Categoriagruppo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoriagruppoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('abilitatoinserimentorichieste','choice', array('label' => 'Abilitato all\'inserimento Richieste',
                'choices' => Categoriagruppo::getPossibleEnumAbilitazioni()))
            ->add('validatoretecnico','choice', array('label' => 'Validatore Tecnico',
                'choices' => Categoriagruppo::getPossibleEnumAbilitazioni()))
            ->add('validatoreamministrativo','choice', array('label' => 'Validatore Amministrativo',
                'choices' => Categoriagruppo::getPossibleEnumAbilitazioni()))
            ->add('referenteabs','choice', array('label' => 'Referente ABS',
                'choices' => Categoriagruppo::getPossibleEnumAbilitazioni()))
            ->add('idgruppoutente', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Gruppoutente',
                'choice_label' => 'nome',
                'label' => 'Gruppo Utente',
            ))
            ->add('idcategoria', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Categoria',
                'choice_label' => 'descrizione',
                'label' => 'Categoria',
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'estar\rda\RdaBundle\Entity\Categoriagruppo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_categoriagruppo';
    }
}

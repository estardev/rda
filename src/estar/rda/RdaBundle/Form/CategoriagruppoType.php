<?php

namespace estar\rda\RdaBundle\Form;

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
            ->add('abilitatoinserimentorichieste',null, array('label' => 'Abilitato all\'inserimento Richieste'))
            ->add('validatoretecnico',null, array('label' => 'Validatore Tecnico'))
            ->add('validatoreamministrativo',null, array('label' => 'Validatore Amministrativo'))
            ->add('referenteabs',null, array('label' => 'Referente ABS'))
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

<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CampoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome',null, array('label' => 'Nome'))
            ->add('descrizione',null, array('label' => 'Descrizione'))
            ->add('tipo',null, array('label' => 'Tipo'))
            ->add('obbligatorioinserzione',null, array('label' => 'Inserzione Obbligatoria'))
            ->add('obbligatoriovalidazione',null, array('label' => 'Validazione Obbligatoria'))
            ->add('ordinamento',null, array('label' => 'Ordinamento del Campo'))
            ->add('fieldset',null, array('label' => 'Raggruppamento di Appartenenza'))
            ->add('ordinamentofieldset',null, array('label' => 'Ordinamento del Raggruppamento'))
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

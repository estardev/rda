<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class CategoriadocumentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('necessarioperabs',null, array('label' => 'Necessario per ABS'))
            ->add('iddocumento', 'entity', array(
                'class' => 'estar\rda\RdaBundle\Entity\Documento',
                'choice_label' => 'nomedescrizione',
                'label' => 'Documento',
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
            'data_class' => 'estar\rda\RdaBundle\Entity\Categoriadocumento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'estar_rda_rdabundle_categoriadocumento';
    }
}

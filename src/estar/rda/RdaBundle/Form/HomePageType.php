<?php

namespace estar\rda\RdaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Form\FormTemplateType;
use estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomePageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('idcategoria', 'entity', array(
        'class' => 'estar\rda\RdaBundle\Entity\Categoria',
        'choice_label' => 'descrizione',
        'label' => 'Categoria',
    ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'estar_rda_bundle_home_page_type';
    }
}

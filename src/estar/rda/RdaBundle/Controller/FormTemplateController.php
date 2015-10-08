<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use estar\rda\RdaBundle\Form\FormTemplateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\FormTemplate;

class FormTemplateController extends Controller
{


    /**
     * Displays a form to create a new FormTemplate entity.
     *
     */
    public function newAction($idCategoria)
    {
        $campi = new ArrayCollection();

        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()
            ->getRepository('estarRdaBundle:Campo');


        $query = $repository->createQueryBuilder('c')
            ->where('c.idcategoria = :idcategoria')
            ->orderBy('c.ordinamentofieldset,c.ordinamento ', 'ASC')
            ->setParameter('idcategoria', $idCategoria)
            ->getQuery();


        $campi = $query->getResult();

        $entity = new FormTemplate($idCategoria, $campi);
        $form = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),

        ));
    }

    /**
     * Creates a form to create a FormTemplate entity.
     *
     * @param FormTemplate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(FormTemplate $entity)
    {
        $form = $this->createForm(new FormTemplateType(), $entity, array(
            'action' => $this->generateUrl('formtemplate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
}

<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use estar\rda\RdaBundle\Entity\Campo;
use estar\rda\RdaBundle\Entity\Richiesta;
use estar\rda\RdaBundle\Form\FormTemplateType;
use Proxies\__CG__\estar\rda\RdaBundle\Entity\Categoria;
use Proxies\__CG__\estar\rda\RdaBundle\Entity\Valorizzazionecamporichiesta;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use estar\rda\RdaBundle\Entity\FormTemplate;
use Symfony\Component\HttpFoundation\Request;

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

        $formbuilder = $this->createFormBuilder();
        $fieldsetVisitati = array();

        foreach ($campi as $campo) {

            if ($campo->getTipo() == 'radio') {
                $fieldsetName = $campo->getFieldset();
                if (in_array($fieldsetName, $fieldsetVisitati)) {
                    continue;
                }

                array_push($fieldsetVisitati, $fieldsetName);
                $options = array();
                foreach ($campi as $item) {
                    if ($item->getTipo() == 'radio' and $item->getFieldset() == $fieldsetName)
                        array_push($options, $item->getDescrizione());

                }
                $nome = $campo->getNome() . '-' . $campo->getId();
                $formbuilder->add($nome, 'choice', array(
                    'choices' => $options,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => $fieldsetName
                ));
            } else {
                $nome2 = $campo->getNome() . '-' . $campo->getId();
                $formbuilder->add($nome2, $campo->getTipo(), array(
                    'label' => $campo->getDescrizione()
                ));
            }
        }

        $formbuilder->setAction($this->generateUrl('formtemplate_create', array('idCategoria' => $idCategoria)));
        $form = $formbuilder->getForm();

        $form->add('submit', 'submit', array('label' => 'Create'));
        return $this->render('estarRdaBundle:FormTemplate:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),

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


    public function createAction(Request $request, $idCategoria)
    {
        dump($request);
        $form = $this->createForm(new FormTemplateType());
        $form->handleRequest($request);
        dump($idCategoria);


        $em = $this->getDoctrine()->getManager();


        $categoria = $em->getRepository('estarRdaBundle:Categoria')->find($idCategoria);
        $richiesta = new Richiesta();
        $richiesta->setIdcategoria($categoria);
        $em->persist($richiesta);

        $campi = $request->request->getIterator();
        dump($campi);


        foreach ($campi->current() as $key => $value) {
            if (!strrpos($key, "-")) {
                continue;
            }
            $a = explode('-', $key);
            $idCampo = $a[1];

            $campo = $em->getRepository('estarRdaBundle:Campo')->find($idCampo);
            $vcr = new Valorizzazionecamporichiesta();
            $vcr->setIdcampo($campo);
            $vcr->setIdcategoria($categoria);
            $vcr->setIdrichiesta($richiesta);
            $vcr->setValore($value);
            $em->persist($vcr);

        }

        $em->flush();


        return $this->render('estarRdaBundle:FormTemplate:prova.html.twig', array(
            'request' => $request
        ));

    }
}
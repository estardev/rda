<?php

namespace estar\rda\RdaBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use estar\rda\RdaBundle\Entity\Campo;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use estar\rda\RdaBundle\Entity\Categoria;
use estar\rda\RdaBundle\Form\CategoriaType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

/**
 * Categoria controller.
 *
 */
class CategoriaController extends Controller
{
    public function getChoicesOptions($string)
    {
        $options = explode('||', $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode('|', $option);
            if (count($subOption) > 1) {
                $returnOptions[$subOption[0]] = $subOption[1];
            } else {
                $returnOptions[$subOption[0]] = $subOption[0];
            }
        }


        return $returnOptions;
    }

    function selectedOption($options, $key)
    {
        return $options[$key];
    }

    function getFirstLevel($string)
    {
        $options = explode('||', $string);
        $returnOptions = array();
        foreach ($options as $option) {
            $subOption = explode('|', $option);
            array_push($returnOptions, $subOption[1]);
        }

        return $returnOptions;
    }

    function getFather($string)
    {
        $options = explode('||', $string);
        $subOption = explode('|', $options[0]);

        return $subOption[0];
    }

    /**
     * Lists all Categoria entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('estarRdaBundle:Categoria')->findAll();

        return $this->render('estarRdaBundle:Categoria:index.html.twig', array(
            'entities' => $entities,
        ));
    }

    /**
     * Creates a new Categoria entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Categoria();
        $entity->setCampi(new ArrayCollection());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('categoria_show', array('id' => $entity->getId())));
        }

        return $this->render('estarRdaBundle:Categoria:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Categoria entity.
     *
     * @param Categoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Categoria $entity)
    {
        $form = $this->createForm(new CategoriaType(), $entity, array(
            'action' => $this->generateUrl('categoria_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Categoria entity.
     *
     */
    public function newAction()
    {
        $entity = new Categoria();
//        $campo1= new Campo();
//        $campo1->setNome('Pippo');
//        $entity->getCampi()->add($campo1);
//        $campo2= new Campo();
//        $campo2->setNome('Pluto');
//        $entity->getCampi()->add($campo2);

        $form = $this->createCreateForm($entity);

        return $this->render('estarRdaBundle:Categoria:new.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Categoria entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('estarRdaBundle:Categoria:show.html.twig', array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Categoria entity.
     *
     */
    public function editAction($id)
    {
        $idCategoria = $id;
        //TODO fg aggiungere il passaggio alla form della obbligatoriet� o meno dei campi (manca! � tutto obbligatorio)

        $repository = $this->getDoctrine()->getRepository('estarRdaBundle:Campo');

        //FG20151027 modifica per i diritti: prendiamo i diritti
        $usercheck = $this->get("usercheck.notify");
        $diritti = $usercheck->allRole($idCategoria);

        $campi = $repository->findBy(
            array('idcategoria' => $idCategoria),
            array('ordinamento' => 'ASC')
        );

        $formbuilder = $this->createFormBuilder();
//        $formbuilder->add("titolo", "text", array(
//            'label' => "Titolo",
//            'data' => "Specificare un oggetto per la propria richiesta"
//        ));
//        $formbuilder->add("descrizione", "textarea", array(
//            'label' => "Descrizione",
//            'data' => "indicare descrizione, azienda sanitaria e UOC destinataria"
//        ));

        $firstLevels = array();
        foreach ($campi as $campo) {
            //FG 20151027 modifica per campi visualizzabili a seconda dei diritti
//            if (!($diritti->campoVisualizzabile($diritti, $campo))) continue;

            $obbligatorio = $campo->getObbligatorioinserzione();
            if ($campo->getTipo() == 'choice') {
                $class = array('class' => 'firstLevel');

                $options = $this->getChoicesOptions($campo->getFieldset());

                if ($obbligatorio) {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                        'choices' => $options,
                        'expanded' => true,
                        'multiple' => false,
                        'label' => $campo->getOrdinamento() . '-' . $campo->getDescrizione(),
                        'constraints' => new NotBlank(),
                        'attr' => $class
                    ));
                } else {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), 'choice', array(
                        'choices' => $options,
                        'expanded' => true,
                        'multiple' => false,
                        'label' => $campo->getOrdinamento() . '-' . $campo->getDescrizione(),
                        'attr' => $class
                    ));
                }

            } else {
                $class = array();
                $label = $campo->getOrdinamento() . '-' . $campo->getDescrizione();

//                if ($campo->getPadre() != null) {
                if ($repository->findBy(array('figlio' => $campo->getId())) or $campo->getPadre() != null) {
                    $class = array('class' => 'secondLevel');
                    if ($campo->getPadre() != null) {
                        $padri = $this->getFirstLevel($campo->getPadre());
                        $firstLevels[$this->getFather($campo->getPadre())] = $padri;
                    }
                }

                if ($obbligatorio) {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                        'label' => $label,
                        'constraints' => new NotNull(),
                        'attr' => $class
                    ));
                } else {
                    $formbuilder->add($campo->getNome() . '-' . $campo->getId(), $campo->getTipo(), array(
                        'label' => $label,
                        'attr' => $class
                    ));
                }
            }
        }
        $form = $formbuilder->getForm();
//        $editForm = $this->createEditForm($entity);
//        $deleteForm = $this->createDeleteForm($id);

//        return $this->render('estarRdaBundle:Categoria:edit.html.twig', array(
//            'entity' => $entity,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));

        return $this->render('estarRdaBundle:Categoria:edit.html.twig', array(
            'idCategoria' => $idCategoria,
            'form' => $form->createView(),
            'firstLevels' => $firstLevels,
//            'back_form' => $backForm->createView()

        ));
    }

    /**
     * Creates a form to edit a Categoria entity.
     *
     * @param Categoria $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Categoria $entity)
    {
        $form = $this->createForm(new CategoriaType(), $entity, array(
            'action' => $this->generateUrl('categoria_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Categoria entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('estarRdaBundle:Categoria')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Categoria entity.');
        }
        $campiDiOrigine = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($task->getCampi() as $campo) {
            $campiDiOrigine->add($campo);
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        if ($editForm->isValid()) {
            // remove the relationship between the tag and the Task
            foreach ($campiDiOrigine as $cdo) {
                if (false === $entity->getCampi()->contains($cdo)) {
                    $cdo->setIdCategoria(null);

                    // if it was a many-to-one relationship, remove the relationship like this
                    // $tag->setTask(null);

                    $em->persist($cdo);

                    // if you wanted to delete the Tag entirely, you can also do that
                    // $em->remove($cdo);
                }
            }

            $em->persist($entity);
            $em->flush();

            // redirect back to some edit page
            return $this->redirect($this->generateUrl('categoria_edit', array('id' => $id)));
        }

        return $this->render('estarRdaBundle:Categoria:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Categoria entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('estarRdaBundle:Categoria')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Categoria entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('categoria'));
    }

    /**
     * Creates a form to delete a Categoria entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('categoria_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }


}

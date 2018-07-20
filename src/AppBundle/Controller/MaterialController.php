<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Material;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use AppBundle\Form\MaterialType;

/**
 * Material controller.
 *
 */
class MaterialController extends Controller
{
    /**
     * Lists all material entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materials = $em->getRepository('AppBundle:Material')->findAll();

        return $this->render('material/index.html.twig', array(
            'materials' => $materials,
        ));
    }

    /**
     * Creates a new material entity.
     *
     */
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        /*
        $this->addFlash('danger', 'Brak grupy materiałów lub jednostki');

        return $this->redirectToRoute('jednostka_index');


        return $this->redirectToRoute('');
        */

                $material = new Material();
                $form = $this->createForm(MaterialType::class, $material);

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {

                    $em->persist($material);
                    $em->flush();

                    return $this->redirectToRoute('material_show', array('id' => $material->getId()));
                }

                return $this->render('material/new.html.twig', array(
                    'material' => $material,
                    'form' => $form->createView(),
                ));






      }

    /**
     * Finds and displays a material entity.
     *
     */
    public function showAction(Material $material)
    {
        $deleteForm = $this->createDeleteForm($material);

        return $this->render('material/show.html.twig', array(
            'material' => $material,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing material entity.
     *
     */
    public function editAction(Request $request, Material $material)
    {

      $em = $this->getDoctrine()->getManager();

      $deleteForm = $this->createDeleteForm($material);

      $editForm = $this->createForm('AppBundle\Form\MaterialType', $material);

      $editForm->handleRequest($request);

      if ($editForm->isSubmitted() && $editForm->isValid()) {

        $em->flush();

        $this->addFlash('success', 'Zaaktualizowano');

        return $this->redirectToRoute('material_edit', ['id' => $material->getId()  ] );
      }

        return $this->render('material/edit.html.twig', array(
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a material entity.
     *
     */
    public function deleteAction(Request $request, Material $material)
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('material_delete', array('id' => $material->getId())))
            ->setMethod('DELETE')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($material);
            $em->flush();

            $this->addFlash('success', 'Skasowano');
        }

        return $this->redirectToRoute('material_index');
    }

    private function createDeleteForm(Material $material)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('material_delete', array('id' => $material->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


}

<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Grupa;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use AppBundle\Form\GrupaType;

/**
 * Grupa controller.
 *
 */
class GrupaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        //wszystkie grupy
        $grupas = $em->getRepository('AppBundle:Grupa')->findAll();

        $tmp = $em->getRepository('AppBundle:Grupa')->findBy(array('parent' => null));

        $tree = [];

        for($i=0; $i<count($tmp); $i++) {

          $tree[$i][0] = $tmp[$i];

          $tmp2 = $em->getRepository('AppBundle:Grupa')->findBy(array('parent' => $tree[$i][0]->getId()  ));

          if (count($tmp2) > 0 )
          {

            for($j=0; $j < count($tmp2); $j++) {

                      $tree[$i][$j+1] = $tmp2[$j];

                      $tmp3 = $em->getRepository('AppBundle:Grupa')->findBy(array('parent' => $tree[$i][$j+1]->getId()  ));

                      if (count($tmp3) > 0 )
                      {


                          for($k=0; $k < count($tmp3); $k++) {
                          //  print_r($tmp3[0]);

                          //  $tree[$i][$j+1][$k+1] = 'ok';
                          }


                      }


            }


          }

        }



        //główne drzewo

        return $this->render('grupa/index.html.twig', array(
                                                      'grupas' => $grupas,
                                                      'tree' => $tree
        ));
    }

    /**
     * Creates a new grupa entity.
     *
     */
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $grupa = new Grupa();

        $form = $this->createForm(GrupaType::class, $grupa, ['em' => $em]) ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $parent = $em->getRepository('AppBundle:Grupa')->find($grupa->getParent()  );

            $grupa->setparent($parent);

            $em->persist($grupa);
            $em->flush();

            return $this->redirectToRoute('grupa_show', array('id' => $grupa->getId() ));
        }

        return $this->render('grupa/new.html.twig', array(
            'grupa' => $grupa,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a grupa entity.
     *
     */
    public function showAction(Grupa $grupa)
    {
        $deleteForm = $this->createDeleteForm($grupa);

        return $this->render('grupa/show.html.twig', array(
            'grupa' => $grupa,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing grupa entity.
     *
     */
    public function editAction(Request $request, Grupa $grupa)
    {
      $em = $this->getDoctrine()->getManager();

      $deleteForm = $this->createDeleteForm($grupa);

      if ($grupa->getparent() == null)
        $parent_id = 0; else $parent_id = $grupa->getparent()->getId();

      $editForm = $this->createForm('AppBundle\Form\GrupaType', $grupa, ['em' => $em]);

      $editForm->handleRequest($request);

      if ($editForm->isSubmitted() && $editForm->isValid()) {

        $parent = $em->getRepository('AppBundle:Grupa')->find($grupa->getparent()  );

        $grupa->setparent($parent);
        $em->flush();


          return $this->redirectToRoute('grupa_edit', array('id' => $grupa->getId()));
      }

        return $this->render('grupa/edit.html.twig', array(
            'grupa' => $grupa,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a grupa entity.
     *
     */
    public function deleteAction(Request $request, Grupa $grupa)
    {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createDeleteForm($grupa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

          $is_material = $em->getRepository('AppBundle:Material')->findOneBy(['grupaId' => $grupa->getId() ]);

          if (!($is_material)) { //sprawdzenie czy do grupy jest przypisany materiał

            $is_grupa = $em->getRepository('AppBundle:Grupa')->findOneBy(['parent' => $grupa->getId() ]);

            if (!($is_grupa)) {
                $em->remove($grupa);
                $em->flush();
                $this->addFlash('success', 'Usunięto');

              } else $this->addFlash('warning', 'Aby usunąć grupę, usuń podgrupy które są do niej przypisane');
            } else $this->addFlash('warning', 'Aby usunać grupę, usuń materiały które są do niej przypisane');

            }


        return $this->redirectToRoute('grupa_index');
    }


    private function createDeleteForm(Grupa $grupa)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grupa_delete', array('id' => $grupa->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }


}

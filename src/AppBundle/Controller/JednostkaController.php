<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Jednostka;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Form\JednostkaType;

/**
 * Jednostka controller.
 *
 */
class JednostkaController extends Controller
{

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $jednostkas = $em->getRepository('AppBundle:Jednostka')->findAll();

        return $this->render('jednostka/index.html.twig', array(
            'jednostkas' => $jednostkas,
        ));
    }

    public function newAction(Request $request)
    {
        $jednostka = new Jednostka();
        $form = $this->createForm('AppBundle\Form\JednostkaType', $jednostka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $is_nazwa_exist = $em->getRepository('AppBundle:Jednostka')->findBy(['nazwa' => $jednostka->getNazwa()]);
            $is_skrot_exist = $em->getRepository('AppBundle:Jednostka')->findBy(['skrot' => $jednostka->getSkrot()]);

            if (  (count($is_nazwa_exist) == 0) && (count($is_skrot_exist) == 0)  ) {
              $em->persist($jednostka);
              $em->flush();
            }
            else {
              $this->addFlash('danger', 'Istnieje jednostka o takiej nazwie lub skrócie');
              return $this->redirectToRoute('jednostka_index');
            }

            return $this->redirectToRoute('jednostka_show', array('id' => $jednostka->getId()));
        }

        return $this->render('jednostka/new.html.twig', array(
            'jednostka' => $jednostka,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jednostka entity.
     *
     */
    public function showAction(Jednostka $jednostka)
    {
        $deleteForm = $this->createDeleteForm($jednostka);

        return $this->render('jednostka/show.html.twig', array(
            'jednostka' => $jednostka,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jednostka entity.
     *
     */
    public function editAction(Request $request, Jednostka $jednostka)
    {
        $deleteForm = $this->createDeleteForm($jednostka);


        $editForm = $this->createForm(JednostkaType::class, $jednostka);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Zmieniono');
            return $this->redirectToRoute('jednostka_edit', array('id' => $jednostka->getId()));
        }

        return $this->render('jednostka/edit.html.twig', array(
            'jednostka' => $jednostka,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a jednostka entity.
     *
     */
    public function deleteAction(Request $request, Jednostka $jednostka)
    {
      $em = $this->getDoctrine()->getManager();

        //sprawdzanie, czy materiał korzysta z danej jednostki
        $material_exist = $em->getRepository('AppBundle:Material')
                             ->findOneBy(['jednostkaId' => $jednostka->getId() ]);


        if (!($material_exist)) {
        $form = $this->createDeleteForm($jednostka);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->remove($jednostka);
            $em->flush();

            $this->addFlash('success', 'Skasowano');
        }

      } else $this->addFlash('danger', 'Nie można usunąć jednostki. Jest ona przypisana co najmniej do jednego materiału');

      return $this->redirectToRoute('jednostka_index');
    }


    private function createDeleteForm(Jednostka $jednostka)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('jednostka_delete', array('id' => $jednostka->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

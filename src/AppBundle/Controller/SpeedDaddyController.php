<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\SpeedDaddy;
use AppBundle\Form\SpeedDaddyType;

/**
 * SpeedDaddy controller.
 *
 * @Route("/speeddaddy")
 */
class SpeedDaddyController extends Controller
{
    /**
     * Lists all SpeedDaddy entities.
     *
     * @Route("/", name="speeddaddy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $speedDaddies = $em->getRepository('AppBundle:SpeedDaddy')->findAll();

        return $this->render('speeddaddy/index.html.twig', array(
            'speedDaddies' => $speedDaddies,
        ));
    }

    /**
     * Creates a new SpeedDaddy entity.
     *
     * @Route("/new", name="speeddaddy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $speedDaddy = new SpeedDaddy();
        $form = $this->createForm('AppBundle\Form\SpeedDaddyType', $speedDaddy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($speedDaddy);
            $em->flush();

            return $this->redirectToRoute('speeddaddy_show', array('id' => $speedDaddy->getId()));
        }

        return $this->render('speeddaddy/new.html.twig', array(
            'speedDaddy' => $speedDaddy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a SpeedDaddy entity.
     *
     * @Route("/{id}", name="speeddaddy_show")
     * @Method("GET")
     */
    public function showAction(SpeedDaddy $speedDaddy)
    {
        $deleteForm = $this->createDeleteForm($speedDaddy);

        return $this->render('speeddaddy/show.html.twig', array(
            'speedDaddy' => $speedDaddy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing SpeedDaddy entity.
     *
     * @Route("/{id}/edit", name="speeddaddy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SpeedDaddy $speedDaddy)
    {
        $deleteForm = $this->createDeleteForm($speedDaddy);
        $editForm = $this->createForm('AppBundle\Form\SpeedDaddyType', $speedDaddy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($speedDaddy);
            $em->flush();

            return $this->redirectToRoute('speeddaddy_edit', array('id' => $speedDaddy->getId()));
        }

        return $this->render('speeddaddy/edit.html.twig', array(
            'speedDaddy' => $speedDaddy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SpeedDaddy entity.
     *
     * @Route("/{id}", name="speeddaddy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SpeedDaddy $speedDaddy)
    {
        $form = $this->createDeleteForm($speedDaddy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($speedDaddy);
            $em->flush();
        }

        return $this->redirectToRoute('speeddaddy_index');
    }

    /**
     * Creates a form to delete a SpeedDaddy entity.
     *
     * @param SpeedDaddy $speedDaddy The SpeedDaddy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SpeedDaddy $speedDaddy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('speeddaddy_delete', array('id' => $speedDaddy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

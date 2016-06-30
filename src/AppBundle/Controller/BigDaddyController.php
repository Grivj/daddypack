<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\BigDaddy;
use AppBundle\Form\BigDaddyType;

/**
 * BigDaddy controller.
 *
 * @Route("/bigdaddy")
 */
class BigDaddyController extends Controller
{
    /**
     * Lists all BigDaddy entities.
     *
     * @Route("/", name="bigdaddy_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bigDaddies = $em->getRepository('AppBundle:BigDaddy')->findAll();

        return $this->render('bigdaddy/index.html.twig', array(
            'bigDaddies' => $bigDaddies,
        ));
    }

    /**
     * Creates a new BigDaddy entity.
     *
     * @Route("/new", name="bigdaddy_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $bigDaddy = new BigDaddy();
        $form = $this->createForm('AppBundle\Form\BigDaddyType', $bigDaddy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bigDaddy);
            $em->flush();

            return $this->redirectToRoute('bigdaddy_show', array('id' => $bigDaddy->getId()));
        }

        return $this->render('bigdaddy/new.html.twig', array(
            'bigDaddy' => $bigDaddy,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a BigDaddy entity.
     *
     * @Route("/{id}", name="bigdaddy_show")
     * @Method("GET")
     */
    public function showAction(BigDaddy $bigDaddy)
    {
        $deleteForm = $this->createDeleteForm($bigDaddy);

        return $this->render('bigdaddy/show.html.twig', array(
            'bigDaddy' => $bigDaddy,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing BigDaddy entity.
     *
     * @Route("/{id}/edit", name="bigdaddy_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BigDaddy $bigDaddy)
    {
        $deleteForm = $this->createDeleteForm($bigDaddy);
        $editForm = $this->createForm('AppBundle\Form\BigDaddyType', $bigDaddy);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($bigDaddy);
            $em->flush();

            return $this->redirectToRoute('bigdaddy_edit', array('id' => $bigDaddy->getId()));
        }

        return $this->render('bigdaddy/edit.html.twig', array(
            'bigDaddy' => $bigDaddy,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BigDaddy entity.
     *
     * @Route("/{id}", name="bigdaddy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BigDaddy $bigDaddy)
    {
        $form = $this->createDeleteForm($bigDaddy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($bigDaddy);
            $em->flush();
        }

        return $this->redirectToRoute('bigdaddy_index');
    }

    /**
     * Creates a form to delete a BigDaddy entity.
     *
     * @param BigDaddy $bigDaddy The BigDaddy entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BigDaddy $bigDaddy)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bigdaddy_delete', array('id' => $bigDaddy->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Package;
use AppBundle\Form\PackageType;

/**
 * Package controller.
 *
 * @Route("/package")
 */
class PackageController extends Controller
{
    /**
     * Lists all Package entities.
     *
     * @Route("/", name="package_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $packages = $em->getRepository('AppBundle:Package')->findAll();

        return $this->render('package/index.html.twig', array(
            'packages' => $packages,
        ));
    }

    /**
     * Creates a new Package entity.
     *
     * @Route("/new", name="package_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $package = new Package();
        $form = $this->createForm('AppBundle\Form\PackageType', $package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // selectionne BigDaddy en fonction de sa capacité actuelle
            // TODO : si aucun bdaddy dispo, mise en attente de la commande (statut ?)

            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT bd FROM AppBundle\Entity\BigDaddy bd WHERE bd.curCapacity > ?1');
            $query->setParameter(1, $package->getWeight())
                ->setMaxResults(1);
            $bigdaddy = $query->getResult();

            $package->setStatut('En attente de speed daddy');
            $package->setBigDaddy($bigdaddy[0]->getId());

            $bigdaddy[0]->setcurCapacity($bigdaddy[0]->getcurCapacity() - $package->getWeight());
            var_dump($bigdaddy[0]);
            $em->persist($package);
            $em->flush();

            $em->persist($bigdaddy[0]);
            $em->flush();

            return $this->redirectToRoute('package_show', array('id' => $package->getId()));
        }

        return $this->render('package/new.html.twig', array(
            'package' => $package,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Package entity.
     *
     * @Route("/{id}", name="package_show")
     * @Method("GET")
     */
    public function showAction(Package $package)
    {
        $deleteForm = $this->createDeleteForm($package);

        return $this->render('package/show.html.twig', array(
            'package' => $package,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Package entity.
     *
     * @Route("/{id}/edit", name="package_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Package $package)
    {
        $deleteForm = $this->createDeleteForm($package);
        $editForm = $this->createForm('AppBundle\Form\PackageType', $package);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($package);
            $em->flush();

            return $this->redirectToRoute('package_edit', array('id' => $package->getId()));
        }

        return $this->render('package/edit.html.twig', array(
            'package' => $package,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Package entity.
     *
     * @Route("/{id}", name="package_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Package $package)
    {
        $form = $this->createDeleteForm($package);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($package);
            $em->flush();
        }

        return $this->redirectToRoute('package_index');
    }

    /**
     * Creates a form to delete a Package entity.
     *
     * @param Package $package The Package entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Package $package)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('package_delete', array('id' => $package->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}

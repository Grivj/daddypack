<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Package;
use AppBundle\Form\PackageType;
use AppBundle\Form\Step2Type;

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
        $packages = $em->getRepository('AppBundle:Package')
            ->findBy(
                array('user' => $this->getUser()->getID()),
                array('statut' => 'ASC')
            );

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

            $package->setStatut(1);
            $package->setBigDaddy($bigdaddy[0]->getId());

            $bigdaddy[0]->setcurCapacity($bigdaddy[0]->getcurCapacity() - $package->getWeight());
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
        $statut = $package->getStatut();

        $formS2 = $this->createForm('AppBundle\Form\Step2Type', $package);

        if ($form->isSubmitted() && $form->isValid()) {
            
        }
        return $this->render('package/steps/step' . $statut . '.html.twig', array(
            'package' => $package,
            'form' => $formS2->createView()
        ));
    }
}

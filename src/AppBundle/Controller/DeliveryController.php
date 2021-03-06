<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Delivery controller.
 *
 * @Route("/commandes")
 */
class DeliveryController extends Controller
{

    /**
     * @Route("/", name="commandes")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $bdaddies = $em->getRepository('AppBundle:BigDaddy')->findAll();

        $packages = $em->getRepository('AppBundle:Package')->findAll();

        return $this->render('default/index.html.twig', array(
            "bdaddies" => $bdaddies,
            "packages" => $packages
        ));
    }
}

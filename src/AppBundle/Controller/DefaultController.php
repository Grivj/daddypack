<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\Geocoder;
use AppBundle\Entity\Daddy;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $daddies = $em->getRepository('AppBundle:Daddy')->findAll();

        

        return $this->render('default/index.html.twig', array(
            "daddies" => $daddies
        ));
    }
}

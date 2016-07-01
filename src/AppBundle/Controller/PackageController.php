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
     * @Method({"GET", "POST"})
     */
    public function showAction(Request $request, Package $package)
    {

        $distance = null;

        $em = $this->getDoctrine()->getManager();

        $statut = $package->getStatut();

        if($statut === 1){
            if ($request->isMethod('POST')) {
                $package->setStatut(2);
                $em->persist($package);
                $em->flush();

                return $this->redirectToRoute('package_show', array('id' => $package->getId()));
            }
        }
        if($statut === 3){ // search for speed daddies
            $package->getBigDaddy();
            $bdaddy = $em->getRepository('AppBundle:BigDaddy')->findById(1);


            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery('SELECT sd FROM AppBundle\Entity\SpeedDaddy sd WHERE sd.capacity > ?1');
            $query->setParameter(1, $package->getWeight())
                ->setMaxResults(1);
            $speeddaddy = $query->getResult();
            if(!empty($speeddaddy)){
                $package->setSpeedDaddy($speeddaddy[0]->getId());
                $package->setStatut(4);

                $em->persist($package);
                $em->flush();

                return $this->redirectToRoute('package_show', array('id' => $package->getId()));
            }
        }
        if($statut === 4){
            $bdaddy = $em->getRepository('AppBundle:BigDaddy')->findById(1);
            $bdaddy_ad = $bdaddy[0]->getAddress();
            $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".urlencode($bdaddy_ad)."&destinations=".urlencode($package->getAddressRecep())."&mode=driving&language=fr-FR&key=AIzaSyA80t-bsiDq6n5Cd7puziEpaF-ITzS463Y";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            $response = curl_exec($ch);
            curl_close($ch);
            $response_a = json_decode($response, true);
            $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
            $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

            $distance = array(
                'distance' => $dist,
                'time' => $time
            );
        }


        $formS2 = $this->createForm('AppBundle\Form\Step2Type', $package);
        $formS2->handleRequest($request);

        if ($formS2->isSubmitted() && $formS2->isValid()) {
            $package->setStatut(3);
            $em->persist($package);
            $em->flush();

            return $this->redirectToRoute('package_show', array('id' => $package->getId()));
        }
        return $this->render('package/steps/step' . $statut . '.html.twig', array(
            'package' => $package,
            'form' => $formS2->createView(),
            'dist' => $distance
        ));
    }
}

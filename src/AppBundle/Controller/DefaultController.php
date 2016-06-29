<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\Geocoder;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $daddies[] = array(
            "username" => "",
            "lastname" => "",
            "firstname" => "",
            "phone" => "",
            "email" => "",
            "lat" => "48.847443",
            "lng" => "2.340592",
            "address" => "4 Place Edmond Rostand, 75006 Paris"
        );
        $daddies[] = array(
            "username" => "",
            "lastname" => "",
            "firstname" => "",
            "phone" => "",
            "email" => "",
            "lat" => "48.847443",
            "lng" => "2.340592",
            "address" => "15 Rue de la Parcheminerie, 75005 Paris"
        );
        $daddies[] = array(
            "username" => "",
            "lastname" => "",
            "firstname" => "",
            "phone" => "",
            "email" => "",
            "lat" => "48.847443",
            "lng" => "2.340592",
            "address" => "16 Rue de l'Ancienne Comédie, 75006 Paris"
        );

        echo '<pre>';
        print_r($daddies);
        echo '</pre>';

        $address = urlencode("16 Rue de l'Ancienne Comédie, 75006 Paris");
        $loc = geocoder::getLocation($address);

        var_dump($loc);


        return $this->render('default/index.html.twig');



    }
}

<?php

namespace App\Controller;

use App\Entity\Coffe;
use App\Entity\Flowers;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourierController extends AbstractController
{
    /**
     * @Route("/courier", name="courier_home")
     */
    public function index()
    {
        return $this->render('courier/index.html.twig', []);
    }

    /**
     * @Route("/courier/{type}", name="courier_dataformatted")
     */
    public function dataFormatted($type)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $conn = $entityManager->getConnection();

        //coffe orders query
        $coffe_orders = 'SELECT location, deliver_on as deliver FROM coffe';
        $c_orders = $conn->prepare($coffe_orders);
        $c_orders->execute();

        //flowers orders query
        $flowers_orders = 'SELECT address as location, deliver_on as deliver FROM flowers';
        $f_orders = $conn->prepare($flowers_orders);
        $f_orders->execute();

        // returns an array of orders
        $coffe_orders_array = $c_orders->fetchAll();
        $flowers_orders_array = $f_orders->fetchAll();

        //content for json
        $all_orders =  array_merge($coffe_orders_array, $flowers_orders_array);

        //content for xml
        $xml_content = '';
        foreach ($all_orders as $order) {
            $xml_content .= '
            <order>
                <location>' . $order['location'] . '</location>
                <deliver>' . $order['deliver'] . '</deliver>
            </order>';
        }

        //responses
        if ($type == 'json') {
            $myresponse = array(
                'success' => true,
                'content' => $all_orders
            );

            return new JsonResponse($myresponse);
        }
        if ($type == 'xml') {
            $xml = '
            <mynode>
                <orders>' . $xml_content . '</orders>
            </mynode>
            ';

            $response = new Response($xml);
            $response->headers->set('Content-Type', 'application/xml; charset=utf-8');

            return $response;
        }
    }
}

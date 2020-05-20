<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Strategy\Format;

class CourierController extends AbstractController
{
    private $format;

    public function __construct(Format $format)
    {
        $this->format = $format;
    }


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

        //returns an array of orders
        $coffe_orders_array = $c_orders->fetchAll();
        $flowers_orders_array = $f_orders->fetchAll();

        //merged coffe orders and flowers orders
        $all_orders =  array_merge($coffe_orders_array, $flowers_orders_array);

        //returns response
        $response = $this->format->handle($type, $all_orders);
        return $response;
    }
}

<?php

namespace App\Controller;

use App\Entity\Coffe;
use App\Entity\Flowers;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourierController extends AbstractController
{
    /**
     * @Route("/courier", name="courier_home")
     */
    public function index()
    {
        return $this->render('courier/index.html.twig', []);
    }
}

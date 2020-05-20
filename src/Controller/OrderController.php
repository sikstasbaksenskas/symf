<?php

namespace App\Controller;

use App\Entity\Coffe;
use App\Entity\Flowers;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrderController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * 
     * orders form both tables
     */
    public function index()
    {
        $coffe_orders = $this->getDoctrine()->getRepository(Coffe::class)->findAll();
        $flowers_orders = $this->getDoctrine()->getRepository(Flowers::class)->findAll();
        return $this->render('orders/index.html.twig', [
            'coffe_orders' => $coffe_orders,
            'flowers_orders' => $flowers_orders
        ]);
    }

    /**
     * @Route("/newflowersorder", name="new_f_order")
     * @Method({"GET", "POST"})
     */
    public function newFlowersOrder(Request $request)
    {
        $flowers = new Flowers();

        $form = $this->createFormBuilder($flowers)
            ->add('address', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('name', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('deliver_on', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => ['class' => 'btn btn-primary mt-3 float-right']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $flowers = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($flowers);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('orders/new_flowers_order.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/newcoffeorder", name="new_c_order")
     * @Method({"GET", "POST"})
     */
    public function newCofeeOrder(Request $request)
    {
        $coffe = new Coffe();

        $form = $this->createFormBuilder($coffe)
            ->add('milk', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Yes' => true,
                    'No' => false
                ],
            ])
            ->add('milk_type', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Organic' => 'organic_milk',
                    'Fat-free' => 'fat_free_milk'
                ],
            ])
            ->add('cup_size', ChoiceType::class, [
                'attr' => ['class' => 'form-control'],
                'choices'  => [
                    'Large' => 'L',
                    'Medium' => 'M',
                    'Small' => 'S'
                ],
            ])
            ->add('location', TextType::class, ['attr' => ['class' => 'form-control']])
            ->add('save', SubmitType::class, [
                'label' => 'Create',
                'attr' => ['class' => 'btn btn-primary mt-3 float-right']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $coffe = $form->getData();
            //if coffee without milk
            if ($coffe->getMilk() == false) {
                $coffe->setMilkType('none');
            }

            $coffe->setDeliverOn(new \DateTime(date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +30 minutes"))));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coffe);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('orders/new_coffe_order.html.twig', array(
            'form' => $form->createView()
        ));
    }
}

<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use App\Repository\SmartphoneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EstimateController extends AbstractController
{
    #[Route('/estimate', name: 'app_estimate')]
    public function index(SmartphoneRepository $smartphoneRepository, Request $request): Response
    {
        $smartphone = new Smartphone();
        $form = $this->createForm(SmartphoneType::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ram = $smartphone->getRam()->getValue();
            $stockage = $smartphone->getStockage()->getValue();
            $brand = $smartphone->getBrand()->getValue();
            $model = $smartphone->getModel()->getValue();
            $status = $smartphone->getStatus()->getValue();

            $priceTotal = 0;
            $priceTotal += $ram;
            $priceTotal += $stockage;
            $priceTotal += $brand;
            $priceTotal += $model;
            $priceTotal += $status;

            $smartphone->setPrice($priceTotal);
        }

        return $this->render('estimate/index.html.twig', [
            'smartphones' => $smartphoneRepository->findAll(),
            'form' => $form,
            'smartphone' => $smartphone
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Smartphone;
use App\Form\SmartphoneType;
use App\Repository\SmartphoneRepository;
use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class EstimateController extends AbstractController
{
    #[Route('/estimate', name: 'app_estimate')]
    public function index(SmartphoneRepository $smartphoneRepository, Request $request): Response
    {
        $smartphone = new Smartphone();
        $form = $this->createForm(SmartphoneType::class, $smartphone, ['action' => $this->generateUrl('app_estimate')]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $priceTotal = $this->calculateTotalPrice($smartphone);

                $smartphone->setPrice($priceTotal);
            } catch (\Exception $e) {
                // Handle exception, probably return a response with error status and message
            }
        }

        return $this->render('estimate/index.html.twig', [
            'smartphones' => $smartphoneRepository->findAll(),
            'form' => $form,
            'smartphone' => $smartphone
        ]);
    }

    private function calculateTotalPrice(Smartphone $smartphone): int
    {
        $properties = ['getRam', 'getStockage', 'getBrand', 'getModel', 'getStatus'];
        $priceTotal = 0;

        foreach ($properties as $property) {
            $value = $smartphone->$property();
            if (!is_object($value) || !method_exists($value, 'getValue')) {
                throw new Exception("Invalid property or value in smartphone");
            }

            $priceTotal += $value->getValue();
        }

        return $priceTotal;
    }
}

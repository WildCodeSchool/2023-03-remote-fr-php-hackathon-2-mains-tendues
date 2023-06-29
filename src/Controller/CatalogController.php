<?php

namespace App\Controller;

use App\Repository\SmartphoneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog', methods: ['GET'])]
    public function index(
        SmartphoneRepository $smartphoneRepository,
        Request $request,
        PaginatorInterface $paginator,
    ): Response {
        {
            $form = $this->createFormBuilder(null, [
                'method' => 'get'
            ])
                ->add('Recherche', SearchType::class)
                ->getForm();

            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $search = $form->get('Recherche')->getData();
                $query = $smartphoneRepository->findLikeName($search);
        } else {
                $query = $smartphoneRepository->queryFindAll();
        }

            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                5
            );

            return $this->render('catalog/index.html.twig', [
                'controller_name' => 'CatalogController',
                'form' => $form,
                'smartphones' => $pagination,

            ]);
        }
    }
}

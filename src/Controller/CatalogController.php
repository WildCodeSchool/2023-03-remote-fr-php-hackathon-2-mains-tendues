<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Model;
use App\Entity\Ram;
use App\Entity\Status;
use App\Entity\Stockage;
use App\Repository\BrandRepository;
use App\Repository\ModelRepository;
use App\Repository\RamRepository;
use App\Repository\SmartphoneRepository;
use App\Repository\StatusRepository;
use App\Repository\StockageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
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
                'method' => 'get',
                'csrf_protection' => false,
            ])
                ->add('Recherche', SearchType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
                ])
                ->add('brand', EntityType::class, [
                    "class" => Brand::class ,
                    "choice_label" => 'name',
                    'required' => false,
                    'query_builder' => function (BrandRepository $repository) {
                        return $repository->createQueryBuilder('b')
                            ->orderBy('b.name', 'ASC');
                    },
                    'label' => 'Marque',
                ])
                ->add('stockage', EntityType::class, [
                    "class" => Stockage::class,
                    'required' => false,
                    "choice_label" => 'size',
                    'query_builder' => function (StockageRepository $repository) {
                        return $repository->createQueryBuilder('st')
                            ->orderBy('st.size', 'ASC');
                    },
                    'label' => 'Capacité de stockage',
                ])
                ->add('status', EntityType::class, [
                    "class" => Status::class,
                    'required' => false,
                    "choice_label" => 'status',
                    'query_builder' => function (StatusRepository $repository) {
                        return $repository->createQueryBuilder('sta')
                            ->orderBy('sta.status', 'ASC');
                    },
                    'label' => 'Etat',
                ])
                ->add('ram', EntityType::class, [
                    "class" => Ram::class,
                    'required' => false,
                    "choice_label" => 'ram',
                    'query_builder' => function (RamRepository $repository) {
                        return $repository->createQueryBuilder('r')
                            ->orderBy('r.ram', 'ASC');
                    },
                    'label' => 'RAM',
                ])
                ->add('model', EntityType::class, [
                    "class" => Model::class,
                    'required' => false,
                    "choice_label" => 'name',
                    'query_builder' => function (ModelRepository $repository) {
                        return $repository->createQueryBuilder('m')
                            ->orderBy('m.name', 'ASC');
                    },
                    'label' => 'Modèle',
                ])
                ->getForm();

            $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $search = $form->get('Recherche')->getData();
                $brand = $form->get('brand')->getData();
                $status = $form->get('status')->getData();
                $ram = $form->get('ram')->getData();
                $model = $form->get('model')->getData();
                $stockage = $form->get('stockage')->getData();
                $query = $smartphoneRepository->findForPagination($brand, $stockage, $status, $ram, $model, $search);
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

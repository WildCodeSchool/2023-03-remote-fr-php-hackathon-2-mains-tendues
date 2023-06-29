<?php

namespace App\Controller\Admin;

use App\Entity\Smartphone;
use App\Form\Smartphone1Type;
use App\Repository\SmartphoneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/smartphone')]
class AdminSmartphoneController extends AbstractController
{
    #[Route('/', name: 'app_admin_smartphone_index', methods: ['GET'])]
    public function index(
        SmartphoneRepository $smartphoneRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $smartphoneRepository->createQueryBuilder('s')->getQuery();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('admin/admin_smartphone/index.html.twig', [
            'smartphones' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_smartphone_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SmartphoneRepository $smartphoneRepository): Response
    {
        $smartphone = new Smartphone();
        $form = $this->createForm(Smartphone1Type::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smartphoneRepository->save($smartphone, true);
            $this->addFlash('info', 'Smartphone créé.');

            return $this->redirectToRoute('app_admin_smartphone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_smartphone/new.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_smartphone_show', methods: ['GET'])]
    public function show(Smartphone $smartphone): Response
    {
        return $this->render('admin_smartphone/show.html.twig', [
            'smartphone' => $smartphone,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_smartphone_edit', methods: ['GET', 'POST'])]
    public function edit(
        Request $request,
        Smartphone $smartphone,
        SmartphoneRepository $smartphoneRepository
    ): Response {
        $form = $this->createForm(Smartphone1Type::class, $smartphone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $smartphoneRepository->save($smartphone, true);
            $this->addFlash('info', 'Smartphone modifié.');

            return $this->redirectToRoute('app_admin_smartphone_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_smartphone/edit.html.twig', [
            'smartphone' => $smartphone,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_smartphone_delete', methods: ['POST'])]
    public function delete(
        Request $request,
        Smartphone $smartphone,
        SmartphoneRepository $smartphoneRepository
    ): Response {
        if ($this->isCsrfTokenValid('delete' . $smartphone->getId(), $request->request->get('_token'))) {
            $smartphoneRepository->remove($smartphone, true);
            $this->addFlash('info', 'Smartphone supprimé.');
        }

        return $this->redirectToRoute('app_admin_smartphone_index', [], Response::HTTP_SEE_OTHER);
    }
}

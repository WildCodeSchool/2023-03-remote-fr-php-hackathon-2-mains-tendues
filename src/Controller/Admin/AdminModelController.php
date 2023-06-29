<?php

namespace App\Controller\Admin;

use App\Entity\Model;
use App\Form\ModelType;
use App\Repository\ModelRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/model')]
class AdminModelController extends AbstractController
{
    #[Route('/', name: 'app_admin_model_index', methods: ['GET'])]
    public function index(
        ModelRepository $modelRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $query = $modelRepository->createQueryBuilder('m')->getQuery();
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('admin/admin_model/index.html.twig', [
            'models' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_model_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ModelRepository $modelRepository): Response
    {
        $model = new Model();
        $form = $this->createForm(ModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modelRepository->save($model, true);
            $this->addFlash('info', 'Modèle créé.');

            return $this->redirectToRoute('app_admin_model_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_model/new.html.twig', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_model_show', methods: ['GET'])]
    public function show(Model $model): Response
    {
        return $this->render('admin/admin_model/show.html.twig', [
            'model' => $model,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_model_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Model $model, ModelRepository $modelRepository): Response
    {
        $form = $this->createForm(ModelType::class, $model);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $modelRepository->save($model, true);
            $this->addFlash('info', 'Modèle modifié.');

            return $this->redirectToRoute('app_admin_model_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/admin_model/edit.html.twig', [
            'model' => $model,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_model_delete', methods: ['POST'])]
    public function delete(Request $request, Model $model, ModelRepository $modelRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $model->getId(), $request->request->get('_token'))) {
            $modelRepository->remove($model, true);
            $this->addFlash('info', 'Modèle supprimé.');
        }

        return $this->redirectToRoute('app_admin_model_index', [], Response::HTTP_SEE_OTHER);
    }
}

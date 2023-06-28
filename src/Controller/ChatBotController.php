<?php

namespace App\Controller;

use App\Service\ChatBotService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatBotController extends AbstractController
{
    #[Route('/chatbot', name: 'app_message')]
    public function index(Request $request, ChatBotService $chatBotService): Response
    {
        $response = '';
        if ($request->isMethod('POST')) {
            $submittedQuestion = $request->request->get('submitted_question');
            $response = $chatBotService->getResponse($submittedQuestion);
        }

        return $this->render('chatbot/index.html.twig', [
            'questions' => $chatBotService->getQuestions(),
            'response' => $response,
        ]);
    }
}

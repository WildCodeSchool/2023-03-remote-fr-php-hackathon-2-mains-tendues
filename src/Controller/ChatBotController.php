<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChatBotController extends AbstractController
{
    #[Route('/chatbot', name: 'app_message')]
    public function index(Request $request): Response
    {
        $questions = [
            'Bonjour' => 'Bonjour ! Comment puis-je vous aider ?',
            'Quel est votre nom ?' => 'Je suis un chatbot ',
            'Autre question' => 'Désolé, je n\'ai pas la réponse',
        ];

        $response = '';
        if ($request->isMethod('POST')) {
            $submittedQuestion = $request->request->get('submitted_question');
            if (array_key_exists($submittedQuestion, $questions)) {
                $response = $questions[$submittedQuestion];
            }
        }

        return $this->render('botman/index.html.twig', [
            'questions' => array_keys($questions),
            'response' => $response,
        ]);
    }
}

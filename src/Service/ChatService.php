<?php

namespace App\Service;

class ChatService
{
    public function getResponseForQuestion(string $question): string
    {
        if ($question === 'Bonjour') {
            return 'Bonjour ! Comment puis-je vous aider ?';
        }

        if ($question === 'Quel est votre nom ?') {
            return 'Je suis le chatbot  !';
        }


        return 'Désolé, je ne peux pas répondre à cette question ';
    }
}

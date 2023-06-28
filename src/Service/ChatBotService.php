<?php

namespace App\Service;

class ChatBotService
{
    private array $questions = [
        'Comment connaître le modèle du téléphone ?' => 'Vous pouvez trouver le modèle du téléphone généralement sur
            le dos du téléphone lui-même. Recherchez le nom du fabricant et le modèle spécifique. Vous pouvez également
            accéder aux paramètres du téléphone (généralement dans le menu "Paramètres" ou "Options") et chercher la
            section "À propos du téléphone" ou "Informations du téléphone". Vous devriez y trouver les détails sur le
            modèle du téléphone.',
        'Quelle est la capacité de stockage du téléphone ?' => 'Accédez aux paramètres du téléphone et recherchez la
             section "Stockage" ou "Stockage interne". Vous y trouverez les informations sur l\'espace de stockage total
              et l\'espace disponible.',
        'Quelle est la quantité de RAM du téléphone ?' => 'Dans les paramètres du téléphone, recherchez la section
            "À propos du téléphone" ou "Informations du téléphone". Vous y trouverez les détails sur la RAM installée.',
        'Comment évaluez l\'état du téléphone ?' => 'Examinez physiquement le téléphone et recherchez des signes
            d\'usure, de rayures, de fissures ou de tout autre dommage visible.',
    ];

    public function __construct()
    {
        $this->questions = $this->questions;
    }

    public function getQuestions(): array
    {
        return array_keys($this->questions);
    }

    public function getResponse(string $submittedQuestion): string
    {
        if (array_key_exists($submittedQuestion, $this->questions)) {
            return $this->questions[$submittedQuestion];
        }

        return '';
    }
}

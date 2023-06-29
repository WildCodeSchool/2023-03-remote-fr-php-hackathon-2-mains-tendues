<?php

namespace App\Service;

class ChatBotService
{
    private array $questions = [
        'Comment transférer mes données d\'un téléphone portable à un autre ?' =>
            'Pour transférer vos données d\'un téléphone portable à un autre, vous pouvez utiliser des options telles
                que la sauvegarde et la restauration via un compte cloud, le transfert via un câble USB ou
            l\'utilisation d\'applications de transfert de données.',
        'Qu\'est-ce que la mémoire interne d\'un téléphone portable et en ai-je besoin d\'une grande capacité ?' =>
            'La mémoire interne d\'un téléphone portable est l\'espace de stockage intégré où sont conservées les
             applications, les fichiers et les données, et une grande capacité peut être nécessaire si vous avez besoin
              de stocker beaucoup de contenu sur votre téléphone.',
        'Quels sont les principaux critères à prendre en compte lors du choix d\'un forfait mobile ?' =>
            'Les principaux critères à prendre en compte lors du choix d\'un forfait mobile sont le volume de données
             inclus, la couverture réseau, les minutes d\'appel et les SMS/MMS illimités, ainsi que le coût mensuel.',
        'Comment connaître le modèle du téléphone ?' =>
            'Vous pouvez trouver le modèle du téléphone généralement sur
            le dos du téléphone lui-même. Recherchez le nom du fabricant et le modèle spécifique. Vous pouvez également
            accéder aux paramètres du téléphone (généralement dans le menu "Paramètres" ou "Options") et chercher la
            section "À propos du téléphone" ou "Informations du téléphone". Vous devriez y trouver les détails sur le
            modèle du téléphone.',
        'Quelle est la capacité de stockage du téléphone ?' => 'Accédez aux paramètres du téléphone et recherchez la
             section "Stockage" ou "Stockage interne". Vous y trouverez les informations sur l\'espace de stockage total
              et l\'espace disponible.',
        'Quelle est la quantité de RAM du téléphone ?' => 'Dans les paramètres du téléphone, recherchez la section
            "À propos du téléphone" ou "Informations du téléphone". Vous y trouverez les détails sur la RAM installée.',
        'Comment évaluer l\'état du téléphone ?' => 'Examinez physiquement le téléphone et recherchez des signes
            d\'usure, de rayures, de fissures ou de tout autre dommage visible.',
        'Choisissez votre question :' => '',
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

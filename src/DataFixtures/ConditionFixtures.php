<?php

namespace App\DataFixtures;

use App\Entity\Condition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ConditionFixtures extends Fixture
{
    public const STATUS = [
        'Excellent état',
        'Bon état',
        'Etat moyen',
        'Mauvais état',
        'Inutilisable'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STATUS as $status) {
            $condition = new Condition();
            $condition->setStatus($status);
            $manager->persist($condition);
        }
        $manager->flush();
    }
}

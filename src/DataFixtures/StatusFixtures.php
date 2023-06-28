<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
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
            $condition = new Status();
            $condition->setStatus($status);
            $this->addReference($status, $condition);
            $manager->persist($condition);
        }
        $manager->flush();
    }
}

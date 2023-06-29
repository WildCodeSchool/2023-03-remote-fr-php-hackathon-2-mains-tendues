<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public const STATUS = [
        ['status' => 'Excellent état', 'value' => 12],
        ['status' => 'Bon état','value' => 8],
        ['status' => 'Etat moyen','value' => 4],
        ['status' => 'Mauvais état', 'value' => 2],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STATUS as $status) {
            $condition = new Status();
            $condition->setStatus($status['status']);
            $condition->setValue($status['value']);
            $this->addReference($status['status'], $condition);
            $manager->persist($condition);
        }
        $manager->flush();
    }
}

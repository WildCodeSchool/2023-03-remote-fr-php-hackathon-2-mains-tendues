<?php

namespace App\DataFixtures;

use App\Entity\Stockage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StockageFixtures extends Fixture
{
    public const STOCKAGE = [
        15,
        32,
        64,
        128,
        256,
        512,
        1000
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STOCKAGE as $size) {
            $stockage = new Stockage();
            $stockage->setSize($size);
            $referenceName = (string) $size;
            $this->addReference($referenceName, $stockage);
            $manager->persist($stockage);
        }

        $manager->flush();
    }
}

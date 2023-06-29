<?php

namespace App\DataFixtures;

use App\Entity\Stockage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StockageFixtures extends Fixture
{
    public const STOCKAGE = [
        ['stockage' => 15,
        'value' => 2],
        ['stockage' => 32,
            'value' => 3],
        ['stockage' => 64,
            'value' => 5],
        ['stockage' => 128,
            'value' => 8],
        ['stockage' => 256,
            'value' => 14],
        ['stockage' => 512,
            'value' => 20],
        ['stockage' => 1000,
            'value' => 30],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::STOCKAGE as $size) {
            $stockage = new Stockage();
            $stockage->setSize($size['stockage']);
            $stockage->setValue($size['value']);
            $referenceName = (string) $size['stockage'];
            $this->addReference($referenceName, $stockage);
            $manager->persist($stockage);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Ram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RamFixtures extends Fixture
{
    public const RAM = [
        ['ram' => 1,
            'value' => 2],
        ['ram' => 2,
            'value' => 3],
        ['ram' => 3,
            'value' => 4],
        ['ram' => 4,
            'value' => 5],
        ['ram' => 6,
            'value' => 6],
        ['ram' => 8,
            'value' => 7],
        ['ram' => 12,
            'value' => 10],
        ['ram' => 16,
            'value' => 14]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::RAM as $size) {
            $ram = new Ram();
            $ram->setRam($size['ram']);
            $ram->setValue($size['value']);
            $referenceName = (string)$size['ram'];
            $this->addReference($referenceName, $ram);
            $manager->persist($ram);
        }

        $manager->flush();
    }
}

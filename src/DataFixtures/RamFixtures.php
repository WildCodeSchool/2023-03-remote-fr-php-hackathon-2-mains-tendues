<?php

namespace App\DataFixtures;

use App\Entity\Ram;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RamFixtures extends Fixture
{
    public const RAM = [
        1,
        2,
        3,
        4,
        6,
        8,
        12,
        16
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::RAM as $size) {
            $ram = new Ram();
            $ram->setRam($size);
            $referenceName = (string) $size;
            $this->addReference($referenceName, $ram);
            $manager->persist($ram);
        }

        $manager->flush();
    }
}

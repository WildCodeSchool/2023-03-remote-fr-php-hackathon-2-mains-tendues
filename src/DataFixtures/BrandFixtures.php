<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRANDS = [
        'Apple',
        'Samsung',
        'Huawei',
        'Nokia',
        'Google',
        'Xiaomi'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::BRANDS as $brandName) {
            $brand = new Brand();
            $brand->setName($brandName);
            $this->addReference($brandName, $brand);
            $manager->persist($brand);
        }
        $manager->flush();
    }
}

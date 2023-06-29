<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public const BRANDS = [
       [ 'brand' => 'Apple', 'value' => 10],
       [ 'brand' => 'Samsung', 'value' => 10],
       [ 'brand' => 'Huawei','value' => 5],
       [ 'brand' => 'Nokia', 'value' => 5],
       [ 'brand' => 'Google', 'value' => 5],
       [ 'brand' => 'Xiaomi','value' => 5],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::BRANDS as $brandData) {
            $brand = new Brand();
            $brand->setName($brandData['brand']);
            $brand->setValue($brandData['value']);
            $this->addReference($brandData['brand'], $brand);
            $manager->persist($brand);
        }
        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\Smartphone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SmartphoneFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $smartphone = new Smartphone();
        $smartphone->setBrand($this->getReference('Nokia'));
        $smartphone->setModel($this->getReference('C32'));
        $smartphone->setRam($this->getReference('12'));
        $smartphone->setStockage($this->getReference('128'));
        $smartphone->setStatus($this->getReference('Excellent état'));
        $smartphone->setPrice(65);
        $smartphone->setIsSold(false);
        $manager->persist($smartphone);

        $smartphone = new Smartphone();
        $smartphone->setBrand($this->getReference('Apple'));
        $smartphone->setModel($this->getReference('Iphone 6'));
        $smartphone->setRam($this->getReference('16'));
        $smartphone->setStockage($this->getReference('32'));
        $smartphone->setStatus($this->getReference('Mauvais état'));
        $smartphone->setPrice(25);
        $smartphone->setIsSold(true);
        $manager->persist($smartphone);

        $smartphone = new Smartphone();
        $smartphone->setBrand($this->getReference('Samsung'));
        $smartphone->setModel($this->getReference('Galaxy A51'));
        $smartphone->setRam($this->getReference('8'));
        $smartphone->setStockage($this->getReference('128'));
        $smartphone->setStatus($this->getReference('Inutilisable'));
        $smartphone->setPrice(0);
        $smartphone->setIsSold(false);
        $manager->persist($smartphone);

        $smartphone = new Smartphone();
        $smartphone->setBrand($this->getReference('Google'));
        $smartphone->setModel($this->getReference('Pixel 4'));
        $smartphone->setRam($this->getReference('4'));
        $smartphone->setStockage($this->getReference('512'));
        $smartphone->setStatus($this->getReference('Bon état'));
        $smartphone->setPrice(25);
        $smartphone->setIsSold(false);
        $manager->persist($smartphone);

        $smartphone = new Smartphone();
        $smartphone->setBrand($this->getReference('Xiaomi'));
        $smartphone->setModel($this->getReference('Redmi 7'));
        $smartphone->setRam($this->getReference('4'));
        $smartphone->setStockage($this->getReference('32'));
        $smartphone->setStatus($this->getReference('Mauvais état'));
        $smartphone->setPrice(65);
        $smartphone->setIsSold(false);
        $manager->persist($smartphone);

        $smartphone = new Smartphone();
        $smartphone->setBrand($this->getReference('Huawei'));
        $smartphone->setModel($this->getReference('P20'));
        $smartphone->setRam($this->getReference('12'));
        $smartphone->setStockage($this->getReference('128'));
        $smartphone->setStatus($this->getReference('Excellent état'));
        $smartphone->setPrice(75);
        $smartphone->setIsSold(true);
        $manager->persist($smartphone);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BrandFixtures::class,
            RamFixtures::class,
            ModelFixtures::class,
            StockageFixtures::class,
            StatusFixtures::class,
        ];
    }
}

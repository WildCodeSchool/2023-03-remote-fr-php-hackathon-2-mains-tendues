<?php

namespace App\DataFixtures;

use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LocationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cities = [
            ['Paris', 'Île-de-France', 'France'],
            ['Marseille', 'Provence-Alpes-Côte d\'Azur', 'France'],
            ['Lyon', 'Auvergne-Rhône-Alpes', 'France'],
            ['Toulouse', 'Occitanie', 'France'],
            ['Nice', 'Provence-Alpes-Côte d\'Azur', 'France'],
            ['Nantes', 'Pays de la Loire', 'France'],
            ['Strasbourg', 'Grand Est', 'France'],
            ['Montpellier', 'Occitanie', 'France'],
            ['Bordeaux', 'Nouvelle-Aquitaine', 'France'],
            ['Lille', 'Hauts-de-France', 'France'],
        ];

        foreach ($cities as $city) {
            $location = new Location();
            $location->setCity($city[0]);
            $location->setDistrict($city[1]);
            $location->setCountry($city[2]);
            $manager->persist($location);
        }

        $manager->flush();
    }
}

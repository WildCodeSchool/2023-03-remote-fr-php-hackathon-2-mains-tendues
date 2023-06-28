<?php

namespace App\DataFixtures;

use App\Entity\Model;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ModelFixtures extends Fixture
{
    public const MODELS = [
        [
            'name' => 'Iphone 6',
            'brand' => 'Apple'
        ],
        [
            'name' => 'Iphone 7',
            'brand' => 'Apple'
        ],
        [
            'name' => 'Iphone 8',
            'brand' => 'Apple'
        ],
        [
            'name' => 'Galaxy A51',
            'brand' => 'Samsung'
        ],
        [
            'name' => 'Galaxy Note 2',
            'brand' => 'Samsung'
        ],
        [
            'name' => 'Galaxy Fold',
            'brand' => 'Samsung'
        ],
        [
            'name' => 'P20',
            'brand' => 'Huawei'
        ],
        [
            'name' => 'P30',
            'brand' => 'Huawei'
        ],
        [
            'name' => 'P40',
            'brand' => 'Huawei'
        ],
        [
            'name' => 'C21',
            'brand' => 'Nokia'
        ],
        [
            'name' => 'C32',
            'brand' => 'Nokia'
        ],
        [
            'name' => 'G11',
            'brand' => 'Nokia'
        ],
        [
            'name' => 'Pixel 4',
            'brand' => 'Google'
        ],
        [
            'name' => 'Pixel 5',
            'brand' => 'Google'
        ],
        [
            'name' => 'Pixel 6',
            'brand' => 'Google'
        ],
        [
            'name' => 'Redmi Note 4',
            'brand' => 'Xiaomi'
        ],
        [
            'name' => 'Redmi 7',
            'brand' => 'Xiaomi'
        ],
        [
            'name' => 'Redmi A1',
            'brand' => 'Xiaomi'
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MODELS as $modelsData) {
            $model = new Model();
            $model->setName($modelsData['name']);
            $model->setBrand($this->getReference($modelsData['brand']));
            $manager->persist($model);
        }

        $manager->flush();
    }
}

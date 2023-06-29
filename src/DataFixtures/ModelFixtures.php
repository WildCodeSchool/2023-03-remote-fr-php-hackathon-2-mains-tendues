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
            'brand' => 'Apple',
            'value' => 10
        ],
        [
            'name' => 'Iphone 7',
            'brand' => 'Apple',
            'value' => 15
        ],
        [
            'name' => 'Iphone 8',
            'brand' => 'Apple',
            'value' => 20
        ],
        [
            'name' => 'Galaxy A51',
            'brand' => 'Samsung',
            'value' => 10
        ],
        [
            'name' => 'Galaxy Note 2',
            'brand' => 'Samsung',
            'value' => 20
        ],
        [
            'name' => 'Galaxy Fold',
            'brand' => 'Samsung',
            'value' => 40
        ],
        [
            'name' => 'P20',
            'brand' => 'Huawei',
            'value' => 10
        ],
        [
            'name' => 'P30',
            'brand' => 'Huawei',
            'value' => 15
        ],
        [
            'name' => 'P40',
            'brand' => 'Huawei',
            'value' => 20
        ],
        [
            'name' => 'C21',
            'brand' => 'Nokia',
            'value' => 10
        ],
        [
            'name' => 'C32',
            'brand' => 'Nokia',
            'value' => 15
        ],
        [
            'name' => 'G11',
            'brand' => 'Nokia',
            'value' => 20
        ],
        [
            'name' => 'Pixel 4',
            'brand' => 'Google',
            'value' => 10
        ],
        [
            'name' => 'Pixel 5',
            'brand' => 'Google',
            'value' => 15
        ],
        [
            'name' => 'Pixel 6',
            'brand' => 'Google',
            'value' => 20
        ],
        [
            'name' => 'Redmi Note 4',
            'brand' => 'Xiaomi',
            'value' => 10
        ],
        [
            'name' => 'Redmi 7',
            'brand' => 'Xiaomi',
            'value' => 15
        ],
        [
            'name' => 'Redmi A1',
            'brand' => 'Xiaomi',
            'value' => 20
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::MODELS as $modelsData) {
            $model = new Model();
            $model->setName($modelsData['name']);
            $model->setBrand($this->getReference($modelsData['brand']));
            $model->setValue($modelsData['value']);
            $this->addReference($modelsData['name'], $model);
            $manager->persist($model);
        }

        $manager->flush();
    }
}

<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private \Faker\Generator $faker;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->faker = \Faker\Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname('User')
            ->setLastname('Test')
            ->setEmail('user@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'userpass'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $admin = new User();
        $admin->setFirstname('Admin')
            ->setLastname('Test')
            ->setEmail('admin@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($admin, 'adminpass'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        for ($i = 0; $i < 20; $i++) {
            $extraUser = new User();
            $extraUser->setFirstname($this->faker->firstName)
                ->setLastname($this->faker->lastName)
                ->setEmail($this->faker->unique()->safeEmail)
                ->setPassword($this->userPasswordHasher->hashPassword($extraUser, 'userpass'))
                ->setRoles(['ROLE_USER']);
            $manager->persist($extraUser);
        }

        $manager->flush();
    }
}

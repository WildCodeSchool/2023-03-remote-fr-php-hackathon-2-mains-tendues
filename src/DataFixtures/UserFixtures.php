<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstname('Benevole')
            ->setLastname('Ema')
            ->setEmail('Benevole@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'benevole'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user);

        $admin = new User();
        $admin->setFirstname('Admin')
            ->setLastname('Ema')
            ->setEmail('Admin@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($user, 'admin'))
            ->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}

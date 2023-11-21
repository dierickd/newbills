<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private Generator $faker;

    public function __construct(private readonly UserPasswordHasherInterface $passwordHasher)
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@bills.fr');
        $user->setFirstname($this->faker->firstName);
        $user->setLastname($this->faker->lastName);
        $user->setRoles(['ROLE_APPUSER']);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'user'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}

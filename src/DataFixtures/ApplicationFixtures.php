<?php

namespace App\DataFixtures;

use App\Entity\Application;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ApplicationFixtures extends Fixture
{
    private const APPLICATIONS = [
        0 => 'Application web',
        1 => 'Application mobile',
        2 => 'Application plateforme',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::APPLICATIONS as $app) {
            $application = new Application();
            $application->setName($app);
            $manager->persist($application);
        }

        $manager->flush();
    }
}

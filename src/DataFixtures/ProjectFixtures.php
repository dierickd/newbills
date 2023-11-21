<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Services\Slugify;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;
use Faker\Factory;
use Faker\Generator;

class ProjectFixtures extends Fixture
{
    const STATUS = [1 => 1, 2 => 2, 3 => 3];
    const SELECTED = [1 => 1, 2 => 2, 3 => 3];
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    /**
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 50; $i++) {
            $name = $this->faker->company();
            $project = new Project();
            $project->setName($name);
            $project->setStatus(array_rand(self::STATUS));
            $project->setDescription($this->faker->realTextBetween(500, 600));
            $project->setCreatedAt(new DateTimeImmutable("{$this->faker->date()}"));
            $project->setSelected(array_rand(self::SELECTED));
            $project->setSlug(Slugify::generate($name));

            $expert = rand(0, 100);
            $confirmed = rand(0, 100 - $expert);

            $project->setExpert($expert);
            $project->setConfirmed($confirmed);
            $project->setJunior(100 - $expert - $confirmed);

            $manager->persist($project);
        }

        $manager->flush();
    }
}

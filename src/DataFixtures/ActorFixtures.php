<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Actor;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i <= 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name);

            $programReferences = [];
            for ($j = 0; $j < 10; $j++) {
                $programReferences[] = $this->getReference('program_' . $faker->numberBetween(0, 50));
            }

            foreach ($programReferences as $program) {
                $actor->addProgram($program);
            }

            $manager->persist($actor);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}

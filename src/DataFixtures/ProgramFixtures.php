<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = 50;

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i <= self::PROGRAMS; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(3));
            $program->setSynopsys($faker->paragraph(3));
            $program->setCountry($faker->country('fr_FR'));
            $program->setYear($faker->year('+10 years'));
            $program->setCategory($this->getReference('category_' . $faker->numberBetween(0, 4)));

            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}

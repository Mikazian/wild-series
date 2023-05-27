<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    // const SAISONS = [
    //     [
    //         'number' => 1,
    //         'year' => 2008,
    //         'description' => 'Description 1',
    //         'program' => 'program_The Breaking Bad'
    //     ], [
    //         'number' => 2,
    //         'year' => 2009,
    //         'description' => 'Description 2',
    //         'program' => 'program_The Breaking Bad'
    //     ], [
    //         'number' => 3,
    //         'year' => 2010,
    //         'description' => 'Description 3',
    //         'program' => 'program_The Breaking Bad'
    //     ], [
    //         'number' => 4,
    //         'year' => 2011,
    //         'description' => 'Description 4',
    //         'program' => 'program_The Breaking Bad'
    //     ], [
    //         'number' => 5,
    //         'year' => 2012,
    //         'description' => 'Description 5',
    //         'program' => 'program_The Breaking Bad'
    //     ]
    // ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // foreach (self::SAISONS as $seasonNumber) {
        //     $season = new Season();
        //     $season->setNumber($seasonNumber['number']);
        //     $season->setYear($seasonNumber['year']);
        //     $season->setDescription($seasonNumber['description']);
        //     $season->setProgram($this->getReference($seasonNumber['program']));

        //     $manager->persist($season);
        //     $this->addReference('season_' . $seasonNumber['number'], $season);
        // }

        for ($i = 0; $i <= 5; $i++) {
            $season = new Season();
            $season->setNumber($i);
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraphs(3, true));

            $season->setProgram($this->getReference('program_' . $faker->numberBetween(1, 50)));

            $manager->persist($season);
            $this->addReference('season_' . $i, $season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}

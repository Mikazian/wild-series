<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            'title' => 'Pilot',
            'number' => 1,
            'synopsis' => 'Synopsis 1',
            'season' => 'season_1',
        ], [
            'title' => 'Cat\'s in the bag',
            'number' => 2,
            'synopsis' => 'Synopsis 2',
            'season' => 'season_1',
        ], [
            'title' => '...And the bag\'s in the river',
            'number' => 3,
            'synopsis' => 'Synopsis 3',
            'season' => 'season_1',
        ], [
            'title' => 'Cancer Man',
            'number' => 4,
            'synopsis' => 'Synopsis 4',
            'season' => 'season_1',
        ], [
            'title' => 'Gray Man',
            'number' => 5,
            'synopsis' => 'Synopsis 5',
            'season' => 'season_1',
        ], [
            'title' => 'Crazy Handful of Nothin',
            'number' => 6,
            'synopsis' => 'Synopsis 6',
            'season' => 'season_1',
        ], [
            'title' => 'Un épisode au pif',
            'number' => 10,
            'synopsis' => 'Synopsis 7',
            'season' => 'season_2',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 1; $i <= 100; ++$i) {
            $episode = new Episode();
            $episode->setTitle($faker->sentence(4));
            $episode->setNumber($faker->numberBetween(1, 10));
            $episode->setSynopsis($faker->paragraph(3));
            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(0, 15)));

            $manager->persist($episode);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}

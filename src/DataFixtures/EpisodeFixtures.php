<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Season;
use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugEpisode;

    public function __construct(SluggerInterface $slugEpisode)
    {
        $this->slugEpisode = $slugEpisode;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $seasons = $manager->getRepository(Season::class)->findAll();

        foreach ($seasons as $season) {
            for ($i = 1; $i <= 10; ++$i) {
                $episode = new Episode();
                $episode->setTitle($faker->sentence(4));
                $episode->setNumber($faker->numberBetween(1, 10));
                $episode->setSynopsis($faker->paragraph(3));
                $episode->setSeason($season);
                $episode->setDuration($faker->time('i'));

                $slug = $this->slugEpisode->slug($episode->getTitle());
                $episode->setSlug($slug);

                $manager->persist($episode);
            }
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

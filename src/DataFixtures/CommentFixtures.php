<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Comment;
use App\Entity\Episode;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    const COMMENTS = 20;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i <= self::COMMENTS; $i++) {
            $comment = new Comment();
            $comment->setAuthor($this->getReference('user_' . $faker->numberBetween(1, 2)));
            $comment->setEpisode($this->getReference('episode_' . $faker->numberBetween(1, 10)));
            $comment->setComment($faker->text(100));
            $comment->setRate($faker->numberBetween(1, 10));

            $manager->persist($comment);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            EpisodeFixtures::class,
            UserFixtures::class,
        ];
    }
}

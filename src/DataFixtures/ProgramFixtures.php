<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Season;
use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = 50;

    private SluggerInterface $slugProgram;

    public function __construct(SluggerInterface $slugProgram)
    {
        $this->slugProgram = $slugProgram;
    }

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

            $slug = $this->slugProgram->slug($program->getTitle());
            $program->setSlug($slug);

            $manager->persist($program);
            $this->addReference('program_' . $i, $program);

            for ($j = 1; $j <= 5; $j++) {
                $season = new Season();
                $season->setNumber($j);
                $season->setProgram($program);

                $manager->persist($season);
            }
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

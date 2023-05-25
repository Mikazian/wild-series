<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Program;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'The Walking Dead',
            'synopsys' => 'Des zombies envahissent la terre',
            'category' => 'category_Action',
        ], [
            'title' => 'Mario Bros The Movie',
            'synopsys' => 'Mario qui doit délivrer la princesse Peach',
            'category' => 'category_Animation',
        ], [
            'title' => 'Scary Movie 4',
            'synopsys' => 'Un tueur en série qui tue ces victimes',
            'category' => 'category_Horreur',
        ], [
            'title' => 'Les Gardiens de la Galaxy 3',
            'synopsys' => 'La dernière missions des mercenaires de l\'espace',
            'category' => 'category_Science-Fiction',
        ], [
            'title' => 'La Tour Montparnasse Infernal',
            'synopsys' => 'Eric et Ramzy affronte des cambioleurs',
            'category' => 'category_Comedie',
        ], [
            'title' => 'Résident Evil',
            'synopsys' => 'Invasion de zombies',
            'category' => 'category_Horreur',
        ], [
            'title' => 'The ring',
            'synopsys' => 'Une cassette VHS étrange qui fait apparaître une entitée tueuse',
            'category' => 'category_Horreur',
        ], [
            'title' => 'L\'éxorciste',
            'synopsys' => 'Une fille qui se fait possèder par un démon',
            'category' => 'category_Horreur',
        ], [
            'title' => 'The Breaking Bad',
            'synopsys' => 'Un professeur de science qui a cancer et qui devient un dealer',
            'category' => 'category_Policier',
        ]
    ];

    // public function load(ObjectManager $manager)
    // {
    //     $faker = Factory::create();

    //     foreach (self::PROGRAMS as $index => $programData) {
    //         $program = new Program();
    //         $program->setTitle($programData['title']);
    //         $program->setSynopsys($programData['synopsys']);
    //         $program->setCategory($this->getReference($programData['category']));

    //         $manager->persist($program);
    //         $this->addReference('program_' . $index, $program);
    //     }
    //     $manager->flush();
    // }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i <= 15; $i++) {
            $program = new Program();
            $program->setTitle($faker->sentence(3));
            $program->setSynopsys($faker->paragraph(3));
            // $program->setPoster($faker->imageUrl);
            $program->setCountry($faker->country('fr_FR'));
            $program->setYear($faker->year('+10 years'));
            $program->setCategory($this->getReference('category_' . $faker->numberBetween(1, 10)));

            $manager->persist($program);
            $this->setReference('program_' . $i, $program);
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

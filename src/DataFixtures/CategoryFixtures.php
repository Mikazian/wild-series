<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class CategoryFixtures extends Fixture
{
    const CATEGORIES = [
        'Action',
        'Aventure',
        'Animation',
        'Comedie',
        'Drame',
        'Fantastique',
        'Horreur',
        'Musical',
        'Policier',
        'Romantique',
        'Science-Fiction',
        'Western',
    ];

    // public function load(ObjectManager $manager)
    // {

    //     $faker = Factory::create();

    //     foreach (self::CATEGORIES as $categoryName) {
    //         $category = new Category();
    //         $category->setName($categoryName);
    //         $manager->persist($category);
    //         // $this->addReference('category_' . $categoryName, $category);
    //         $this->setReference('category_' . $faker->numberBetween(0, 5), $category);
    //     }
    //     $manager->flush();
    // }

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        for ($i = 0; $i <= 10; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $manager->persist($category);
            $this->addReference('category_' . $i, $category);
        }
        $manager->flush();
    }
}

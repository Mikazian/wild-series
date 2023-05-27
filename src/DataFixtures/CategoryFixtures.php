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
        'Animation',
        'Horreur',
        'Policier',
        'Science-Fiction',
    ];

    public function load(ObjectManager $manager)
    {

        $faker = Factory::create();

        foreach (self::CATEGORIES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }
        $manager->flush();
    }

    // public function load(ObjectManager $manager)
    // {

    //     $faker = Factory::create();

    //     for ($i = 0; $i <= 10; $i++) {
    //         $category = new Category();
    //         $category->setName($faker->word());
    //         $manager->persist($category);
    //         $this->addReference('category_' . $i, $category);
    //     }
    //     $manager->flush();
    // }
}

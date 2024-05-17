<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Article;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        // use the factory to create a Faker\Generator instance
        $faker = Factory::create();
        $users = array();
      
        for ($i = 0; $i < 10; $i++) {
            $users[$i] = new User();
            $users[$i] -> setNom($faker->firstName());
            $users[$i] -> setEmail($faker->email());
            $manager->persist($users[$i]);
        }

        $articles = array();

        for ($i = 0; $i < 10; $i++) {
            $articles[$i] = new Article();
            $articles[$i] -> setDatePublication($faker->dateTime());
            $articles[$i] -> setTitre($faker->word());
            $articles[$i] -> setContenu($faker->paragraph());
            $articles[$i] -> setUser($users[$faker->numberBetween(0,9)]);
            $manager->persist($articles[$i]);
        }


        $manager->flush();
    }
}

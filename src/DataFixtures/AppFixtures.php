<?php

namespace App\DataFixtures;

use App\Entity\Argonaute;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('gr_GR');

        for ($i = 0; $i < 50; $i++) {
            $argonautes = new Argonaute();
            $argonautes->setName($faker->firstName());

            $manager->persist($argonautes);
        }

        $manager->flush();
    }
}

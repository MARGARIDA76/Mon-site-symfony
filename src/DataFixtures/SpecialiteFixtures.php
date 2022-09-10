<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Specialite;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SpecialiteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       
        $faker = Factory::create('fr_FR');

        for ($c = 1; $c < 30; $c++) {

         $specialite = new Specialite();
         $specialite->setSpecialite($faker->JobTitle);
         $specialite->setDescription($faker->text);

         $manager->persist($specialite);

        $manager->flush();
       }
    
    }
}

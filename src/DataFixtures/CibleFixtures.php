<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Cible;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CibleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        
        //create 30 cibles! 

        $faker = Factory::create('fr_FR');

        for ($c = 0; $c < 30; $c++) {

          $cible = new Cible();
          $cible->setnom($faker->lastname);
          $cible->setPrenom($faker->firstname);
          $cible->setNomCode($faker->companySuffix);
          $cible->setNationalite($faker->region);
          $manager->persist($cible);
          $manager->flush();
        
       }
       
    }
}


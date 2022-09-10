<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Planque;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PlanqueFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //create 30 planque! 

        $faker = Factory::create('fr_FR');

        for ($p = 1; $p < 30; $p++) {

         $planque = new Planque();
         $planque->setCodePlanque($faker->vat);
         $planque->setAdresse($faker->address);
         $planque->setPays($faker->country);
         $planque->setTypePlanque($faker->word);
         $manager->persist($planque);

        $manager->flush();
        }
    }
}


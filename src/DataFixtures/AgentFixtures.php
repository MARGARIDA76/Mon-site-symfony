<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Agent;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AgentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //create 30 agents! 

        $faker = Factory::create('fr_FR');

        for ($a = 0; $a < 30; $a++) {
      
        $agent = new Agent();
        $agent->setNom($faker->lastname);
        $agent->setPrenom($faker->firstname);
        $agent->setCodeIdentification($faker->vat);
        $agent->setNationalite($faker->region);
        $manager->persist($agent);

       $manager->flush();
       }

    }
}

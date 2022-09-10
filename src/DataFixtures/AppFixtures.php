<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Mission;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ///Creation de 30 Missions

        $faker = Factory::create('fr_FR');

        for ($m = 1; $m < 30; $m++) {
        $mission = new Mission();
        $mission->setTitremission($faker->jobTitle);
        $mission->setDescriptionMission($faker->text);
        $mission->setNomcode($faker->word);
        $mission->setPays($faker->country);
        $mission->setTypemission('Surveillance');
        $mission->setStatutmission('En Preparation');
        $manager->persist($mission);


        $mission2 = new Mission();
        $mission2->setTitremission($faker->jobTitle);
        $mission2->setDescriptionMission($faker->text);
        $mission2->setNomcode($faker->word);
        $mission2->setPays($faker->country);
        $mission2->setTypemission('Assassinat');
        $mission2->setStatutmission('En cours');

        $manager->persist($mission2);


        $mission3 = new Mission();
        $mission3->setTitremission($faker->jobTitle);
        $mission3->setDescriptionMission($faker->text);
        $mission3->setNomcode($faker->word);
        $mission3->setPays($faker->country);
        $mission3->setTypemission('Infiltration');
        $mission3->setStatutmission('Termine');
        
        $manager->persist($mission3);


         
        $mission4 = new Mission();
        $mission4->setTitremission($faker->jobTitle);
        $mission4->setDescriptionMission($faker->text);
        $mission4->setNomcode($faker->word);
        $mission4->setPays($faker->country);
        $mission4->setTypemission('masson');
        $mission4->setStatutmission('En echec');

        $manager->persist($mission4);

        $manager->flush();
        
        }
    }
}


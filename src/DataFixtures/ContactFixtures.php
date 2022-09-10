<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //create 30 contacts! 

        $faker = Factory::create('fr_FR');

        for ($c = 0; $c < 20; $c++) {

         $contact = new Contact();
         $contact->setNom($faker->lastname);
         $contact->setPrenom($faker->firstname);
         $contact ->setDatenaissance(new \DateTimeImmutable('2021-03-02'));
         $contact->setNomcode($faker->word);
         $contact->setNationalite($faker->region);
         $manager->persist($contact);
         $manager->flush();
        
       }
   }
}
       


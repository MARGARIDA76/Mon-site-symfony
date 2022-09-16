<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Utilisateur;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UtilisateurFixtures extends Fixture
{
    
        public function __construct(
        
        private UserPasswordHasherInterface $passwordEncoder,
        private SluggerInterface $slugger
        ) {}
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($u = 1; $u < 10; $u++) {

        $utilisateur = new Utilisateur();
        $utilisateur->setName($faker->name);
        $utilisateur->setEmail($faker->email);
        $utilisateur->setPassword($this->passwordEncoder->hashPassword($utilisateur, 'secret'));
        $utilisateur->setRoles(['ROLE_ADMIN']);
        $manager->persist($utilisateur);

    }

        $manager->flush();
    }
}

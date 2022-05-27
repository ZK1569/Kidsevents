<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    protected $slugger;
    protected $hasher;


    public function __construct(SluggerInterface $slugger, UserPasswordHasherInterface $hasher)
    {
        $this->slogger = $slugger;
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager){

        $admin = new User;
        $cris = new User;
        $vanna = new User;

        $hash = $this->hasher->hashPassword($admin, 'Password');
        $hash_cris = $this->hasher->hashPassword($cris, 'Cris2001');
        $hash_vanna = $this->hasher->hashPassword($vanna, 'Vanna1999');

        $admin->setEmail("admin@gmail.com")
        ->setPassword($hash)
        ->setFirstName("admin")
        ->setLastName("nimda")
        ->setPhone("0666006600")
        ->setAddress("EveryWere");

        $cris->setEmail("cristian.ursu.2001@gmail.com")
        ->setPassword($hash_cris)
        ->setFirstName("Cristian")
        ->setLastName("URSU")
        ->setPhone("0695332229")
        ->setAddress("33 rue des lilas 95150");

        $vanna->setEmail("vanna.1999@gmail.com")
        ->setPassword($hash_vanna)
        ->setFirstName("Vanna")
        ->setLastName("BARDOT")
        ->setPhone("0652551126")
        ->setAddress("00 Rue Sextius Michel Paris");



        $manager->persist($admin);
        $manager->persist($cris);
        $manager->persist($vanna);
        $manager->flush();
        
        



    }
}

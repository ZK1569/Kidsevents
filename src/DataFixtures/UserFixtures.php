<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture{

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

        $hash = $this->hasher->hashPassword($admin, 'Password');
        $hash_cris = $this->hasher->hashPassword($cris, 'Password');

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



        $manager->persist($admin);
        $manager->persist($cris);
        $manager->flush();
        
        



    }
}
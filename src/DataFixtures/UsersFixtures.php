<?php

namespace App\DataFixtures;

use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 10; $i++){
            $user = new Users();
            $user
                ->setPrenom("prenom$i")
                ->setNom("nom$i")
                ->setMail("email$i@email.com")
                ->setIdentifiant("identifiant$i")
                ->setMotdepasse("mdp$i")
                ->setAdresse("$i rue")
                ->setTelephone("06 00 00 00 0$i")
                ->setAdminRight(0)
                ->setInteret(0);
            $manager ->persist($user);
        }
        for($i = 10; $i <= 20; $i++){
            $user = new Users();
            $user
                ->setPrenom("prenom$i")
                ->setNom("nom$i")
                ->setMail("email$i@email.com")
                ->setIdentifiant("identifiant$i")
                ->setMotdepasse("mdp$i")
                ->setAdresse("$i rue")
                ->setTelephone("06 00 00 00 $i")
                ->setAdminRight(0)
                ->setInteret(0);
            $manager ->persist($user);
        }

        $manager->flush();
    }
}

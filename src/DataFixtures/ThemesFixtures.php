<?php

namespace App\DataFixtures;

use App\Entity\Themes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ThemesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i <= 20; $i++){
            $theme = new Themes();
            $theme
                ->setIntitule("truc$i")
                ->setDescriptif("blablabla$i")
                ->setDuree("1"+$i)
                ->setPrix("68"+$i)
                ->setAgeMin("6"+$i)
                ->setAgeMax("10"+$i)
                ->setNbenfantMin("10"+$i)
                ->setNbenfantMax("25"+$i)
                ->setImage("$i.png");
            $manager ->persist($theme);
        }
        $manager -> flush();
    }
}

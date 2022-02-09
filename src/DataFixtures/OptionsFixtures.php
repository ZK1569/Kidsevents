<?php

namespace App\DataFixtures;

use App\Entity\Options;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OptionsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i <= 20; $i++){
            $y = 20-$i;
            $option = new Options();
            $option
                ->setIntitule("machin$i")
                ->setDescriptif("remplissage/$y")
                ->setPrix("15"+$i);
            $manager ->persist($option);
        }
        $manager -> flush();
    }
}
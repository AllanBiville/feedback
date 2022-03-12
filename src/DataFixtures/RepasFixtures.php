<?php

namespace App\DataFixtures;

use App\Entity\TypesRepas;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RepasFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $matin = new TypesRepas();
        $matin->setName('Matin');
        $manager->persist($matin);
        $manager->flush();

        $midi = new TypesRepas();
        $midi->setName('Midi');
        $manager->persist($midi);
        $manager->flush();

        $soir = new TypesRepas();
        $soir->setName('Soir');
        $manager->persist($soir);
        $manager->flush();

    }
}

<?php

namespace App\DataFixtures;

use App\Entity\TypesUsers;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UsersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $etudiant = new TypesUsers();
        $etudiant->setName('Etudiant');
        $manager->persist($etudiant);
        $manager->flush();

        $seconde = new TypesUsers();
        $seconde->setName('Seconde');
        $manager->persist($seconde);
        $manager->flush();

        $premiere = new TypesUsers();
        $premiere->setName('Première');
        $manager->persist($premiere);
        $manager->flush();

        $terminale = new TypesUsers();
        $terminale->setName('Terminale');
        $manager->persist($terminale);
        $manager->flush();

        $personnelLycée = new TypesUsers();
        $personnelLycée->setName('Personnel lycée');
        $manager->persist($personnelLycée);
        $manager->flush();

    }
}

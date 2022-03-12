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

        $terminale = new TypesUsers();
        $terminale->setName('Terminale');
        $manager->persist($terminale);
        $manager->flush();

    }
}

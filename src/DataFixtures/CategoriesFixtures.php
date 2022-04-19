<?php

namespace App\DataFixtures;

use App\Entity\TypesCategories;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $gout = new TypesCategories();
        $gout->setShortname('Gout');
        $gout->setLongname('Gout du plat');
        $manager->persist($gout);
        $manager->flush();

        $chaleur = new TypesCategories();
        $chaleur->setShortname('Chaleur');
        $chaleur->setLongname('Chaleur du plat');
        $manager->persist($chaleur);
        $manager->flush();


  
        
    }
}

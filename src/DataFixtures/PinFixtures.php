<?php

namespace App\DataFixtures;

use App\Entity\QrcodePin;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class PinFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pin = new QrcodePin();
        $pin->setPin('12345');
        $manager->persist($pin);
        $manager->flush();

        $manager->flush();
    }
}

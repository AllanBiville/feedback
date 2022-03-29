<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder = null;
    public function __construct (UserPasswordEncoderInterface $passwordEncoder){
        $this->passwordEncoder = $passwordEncoder;
    }
    
    
    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setUsername('admin');
        $admin->setRoles(array('ROLE_ADMIN'));
        $password = $this->passwordEncoder->encodePassword($admin, 'admin');
        $admin->setPassword($password);
        $manager->persist($admin);
        $manager->flush();

        $superadmin = new User();
        $superadmin->setUsername('superadmin');
        $superadmin->setRoles(array('ROLE_SUPERADMIN'));
        $password = $this->passwordEncoder->encodePassword($superadmin, 'superadmin');
        $superadmin->setPassword($password);
        $manager->persist($superadmin);
        $manager->flush();
    }
}
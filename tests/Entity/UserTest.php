<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testIsTrue(): void
    {
        $user= new User();
        $user->setUsername("PHPUnit");
        $user->setPassword("AGoodPassword");
        $user->setRoles(['ROLE_SUPERADMIN']);
        $this->assertTrue($user->getUsername() === "PHPUnit");
        $this->assertTrue($user->getPassword() === "AGoodPassword");
        $this->assertIsArray($user->getRoles());
    }
    public function testIsFalse(): void
    {
        $user= new User();
        $user->setUsername("PHPUnit");
        $user->setPassword("AGoodPassword");
        $this->assertFalse($user->getUsername() === "False");
        $this->assertFalse($user->getPassword() === "False");
    }
}

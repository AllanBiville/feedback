<?php

namespace App\Tests;

use App\Entity\TypesUsers;
use PHPUnit\Framework\TestCase;

class TypesUsersTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $typesUsers= new TypesUsers();
        $this->assertEmpty($typesUsers->getId());
        $this->assertEmpty($typesUsers->getName());
    }
    public function testIsTrue(): void
    {
        $typesUsers= new TypesUsers();
        $typesUsers->setName("Etudiant");
        $this->assertTrue($typesUsers->getName() === "Etudiant");
    }
    public function testIsFalse(): void
    {
        $typesUsers= new TypesUsers();
        $typesUsers->setName("Etudiant");
        $this->assertFalse($typesUsers->getName() === "False");
    }
}

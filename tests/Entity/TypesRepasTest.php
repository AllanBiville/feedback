<?php

namespace App\Tests;

use App\Entity\TypesRepas;
use PHPUnit\Framework\TestCase;

class TypesRepasTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $typesRepas= new TypesRepas();
        $this->assertEmpty($typesRepas->getId());
        $this->assertEmpty($typesRepas->getName());
    }
    public function testIsTrue(): void
    {
        $typesRepas= new TypesRepas();
        $typesRepas->setName("Soir");
        $this->assertTrue($typesRepas->getName() === "Soir");
    }
    public function testIsFalse(): void
    {
        $typesRepas= new TypesRepas();
        $typesRepas->setName("Soir");
        $this->assertFalse($typesRepas->getName() === "False");
    }
}

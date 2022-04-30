<?php

namespace App\Tests;

use App\Entity\TypesCategories;
use PHPUnit\Framework\TestCase;

class TypesCategoriesTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $typesCategories= new TypesCategories();
        $this->assertEmpty($typesCategories->getId());
        $this->assertEmpty($typesCategories->getShortname());
        $this->assertEmpty($typesCategories->getLongname());
        $this->assertIsBool($typesCategories->getStatut());
        $this->assertEmpty($typesCategories->getData());
    }
    public function testIsTrue(): void
    {
        $typesCategories= new TypesCategories();
        $typesCategories->setShortname("Qualité");
        $typesCategories->setLongname("Qualité des plats");
        $typesCategories->setStatut(True);
        $typesCategories->setData("1");
        $this->assertTrue($typesCategories->getShortname() === "Qualité");
        $this->assertTrue($typesCategories->getLongname() === "Qualité des plats");
        $this->assertTrue($typesCategories->getStatut() === True);
        $this->assertTrue($typesCategories->getData() === "1");
    }
    public function testIsFalse(): void
    {
        $typesCategories= new TypesCategories();
        $typesCategories->setShortname("Qualité");
        $typesCategories->setLongname("Qualité des plats");
        $typesCategories->setStatut(True);
        $typesCategories->setData("1");
        $this->assertFalse($typesCategories->getShortname() === "False");
        $this->assertFalse($typesCategories->getLongname() === "False");
        $this->assertFalse($typesCategories->getStatut() === False);
        $this->assertFalse($typesCategories->getData() === "False");
    }
}

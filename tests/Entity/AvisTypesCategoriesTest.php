<?php

namespace App\Tests;

use App\Entity\Avis;
use App\Entity\TypesCategories;
use PHPUnit\Framework\TestCase;
use App\Entity\AvisTypesCategories;

class AvisTypesCategoriesTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $avisTypesCategories = new AvisTypesCategories();
        $this->assertEmpty($avisTypesCategories->getId());
        $this->assertEmpty($avisTypesCategories->getAvis());
        $this->assertEmpty($avisTypesCategories->getTypesCategories());
        $this->assertEmpty($avisTypesCategories->getNote());
    }
    public function testIsTrue(): void
    {
        $avis = new Avis();
        $avisTypesCategories = new AvisTypesCategories();
        $typesCategories = new TypesCategories();
        $avisTypesCategories->setAvis($avis);
        $avisTypesCategories->setTypesCategories($typesCategories);
        $avisTypesCategories->setNote(1);
        $this->assertTrue($avisTypesCategories->getAvis() === $avis);
        $this->assertTrue($avisTypesCategories->getTypesCategories() === $typesCategories);
        $this->assertTrue($avisTypesCategories->getNote() === 1);
    }
    public function testIsFalse(): void
    {
        $avis = new Avis();
        $avisTypesCategories = new AvisTypesCategories();
        $typesCategories = new TypesCategories();
        $avisTypesCategories->setAvis($avis);
        $avisTypesCategories->setTypesCategories($typesCategories);
        $avisTypesCategories->setNote(1);
        $this->assertFalse($avisTypesCategories->getAvis() === "False");
        $this->assertFalse($avisTypesCategories->getTypesCategories() === "False");
        $this->assertFalse($avisTypesCategories->getNote() === "False");
    }
}

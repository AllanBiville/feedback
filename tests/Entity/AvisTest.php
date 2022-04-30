<?php

namespace App\Tests;

use App\Entity\Avis;
use App\Entity\TypesRepas;
use App\Entity\TypesUsers;
use PHPUnit\Framework\TestCase;

class AvisTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $avis = new Avis();
        $this->assertEmpty($avis->getId());
        $this->assertEmpty($avis->getDate());
        $this->assertEmpty($avis->getCommentary());
        $this->assertEmpty($avis->getUsers());
        $this->assertEmpty($avis->getRepas());
    }

    public function testIsTrue(): void
    {
        $avis = new Avis();
        $typesUsers = new TypesUsers();
        $typesRepas = new TypesRepas();
        $avis->setDate("2022-12-01");
        $avis->setCommentary("Commentaire");
        $avis->setUsers($typesUsers);
        $avis->setRepas($typesRepas);
        $this->assertTrue($avis->getDate() === "2022-12-01");
        $this->assertTrue($avis->getCommentary() === "Commentaire");
        $this->assertTrue($avis->getUsers() === $typesUsers);
        $this->assertTrue($avis->getRepas() === $typesRepas);
    }
    public function testIsFalse(): void
    {
        $avis = new Avis();
        $typesUsers = new TypesUsers();
        $typesRepas = new TypesRepas();
        $avis->setDate("2022-12-01");
        $avis->setCommentary("Commentaire");
        $avis->setUsers($typesUsers);
        $avis->setRepas($typesRepas);
        $this->assertFalse($avis->getDate() === "False");
        $this->assertFalse($avis->getCommentary() === "False");
        $this->assertFalse($avis->getUsers() === "False");
        $this->assertFalse($avis->getRepas() === "False");
    }
}

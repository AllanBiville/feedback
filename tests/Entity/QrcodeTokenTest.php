<?php

namespace App\Tests;

use App\Entity\QrcodeToken;
use PHPUnit\Framework\TestCase;

class QrcodeTokenTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $qrcodeToken = new QrcodeToken();
        $this->assertEmpty($qrcodeToken->getId());
        $this->assertEmpty($qrcodeToken->getToken());
        $this->assertEmpty($qrcodeToken->getDate());
    }
    public function testIsTrue(): void
    {
        $qrcodeToken = new QrcodeToken();
        $qrcodeToken->setToken("QS8ds4ssqd8d4sq9q44sq8q9S4aZSDFFGDS");
        $qrcodeToken->setDate("22-02-2022");
        $this->assertTrue($qrcodeToken->getToken() === "QS8ds4ssqd8d4sq9q44sq8q9S4aZSDFFGDS");
        $this->assertTrue($qrcodeToken->getDate() === "22-02-2022");
    }
    public function testIsFalse(): void
    {
        $qrcodeToken = new QrcodeToken();
        $qrcodeToken->setToken("QS8ds4ssqd8d4sq9q44sq8q9S4aZSDFFGDS");
        $qrcodeToken->setDate("22-02-2022");
        $this->assertFalse($qrcodeToken->getToken() === "False");
        $this->assertFalse($qrcodeToken->getDate() === "False");
    }
}

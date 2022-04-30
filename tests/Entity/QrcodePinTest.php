<?php

namespace App\Tests;

use App\Entity\QrcodePin;
use PHPUnit\Framework\TestCase;

class QrcodePinTest extends TestCase
{
    public function testIsEmpty(): void
    {
        $qrcodePin = new QrcodePin();
        $this->assertEmpty($qrcodePin->getId());
        $this->assertEmpty($qrcodePin->getPin());
    }
    public function testIsTrue(): void
    {
        $qrcodePin = new QrcodePin();
        $qrcodePin->setPin(1);
        $this->assertTrue($qrcodePin->getPin() === "1");
    }
    public function testIsFalse(): void
    {
        $qrcodePin = new QrcodePin();
        $qrcodePin->setPin(1);
        $this->assertFalse($qrcodePin->getPin() === "False");
    }
}

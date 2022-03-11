<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QrcodePinRepository;

/**
 * QrcodePin
 *
 * @ORM\Table(name="qrcode_pin")
 * @ORM\Entity(repositoryClass=QrcodePinRepository::class)
 */
class QrcodePin
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pin", type="string", length=50, nullable=false)
     */
    private $pin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPin(): ?string
    {
        return $this->pin;
    }

    public function setPin(string $pin): self
    {
        $this->pin = $pin;

        return $this;
    }


}

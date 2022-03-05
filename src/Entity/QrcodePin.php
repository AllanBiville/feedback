<?php

namespace App\Entity;

use App\Repository\QrcodePinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QrcodePinRepository::class)
 */
class QrcodePin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPin(): ?int
    {
        return $this->pin;
    }

    public function setPin(int $pin): self
    {
        $this->pin = $pin;

        return $this;
    }
}

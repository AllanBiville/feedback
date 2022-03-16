<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QrcodeTokenRepository;

/**
 * QrcodeToken
 *
 * @ORM\Table(name="qrcode_token")
 * @ORM\Entity(repositoryClass=QrcodeTokenRepository::class)
 */
class QrcodeToken
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
     * @var string|null
     *
     * @ORM\Column(name="token", type="string", length=150, nullable=false)
     */
    private $token;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }


}

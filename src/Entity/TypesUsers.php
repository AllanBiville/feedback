<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TypesUsersRepository;

/**
 * TypesUsers
 *
 * @ORM\Table(name="types_users")
 * @ORM\Entity(repositoryClass=TypesUsersRepository::class)
 */
class TypesUsers
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;
    public function __toString(){
        return $this->name;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }


}

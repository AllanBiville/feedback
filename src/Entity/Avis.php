<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 */
class Avis
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentary;

    /**
     * @ORM\ManyToOne(targetEntity=TypesUsers::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=TypesRepas::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Repas;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(?string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getUsers(): ?TypesUsers
    {
        return $this->users;
    }

    public function setUsers(?TypesUsers $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getRepas(): ?TypesRepas
    {
        return $this->Repas;
    }

    public function setRepas(?TypesRepas $Repas): self
    {
        $this->Repas = $Repas;

        return $this;
    }
}

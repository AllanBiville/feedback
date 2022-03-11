<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AvisRepository;


/**
 * Avis
 *
 * @ORM\Table(name="avis", indexes={@ORM\Index(name="id_2", columns={"id_2"}), @ORM\Index(name="id_1", columns={"id_1"})})
 * @ORM\Entity(repositoryClass=AvisRepository::class)
 */
class Avis
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
     * @ORM\Column(name="commentary", type="string", length=255, nullable=true)
     */
    private $commentary;

    /**
     * @var string|null
     *
     * @ORM\Column(name="date_", type="string", length=10, nullable=false)
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="id_1", type="integer", nullable=false)
     */
    private $id1;

    /**
     * @var string
     *
     * @ORM\Column(name="id_2", type="integer", nullable=false)
     */
    private $id2;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getId1(): ?int
    {
        return $this->id1;
    }

    public function setId1($id1): self
    {
        $this->id1 = $id1;

        return $this;
    }

    public function getId2(): ?int
    {
        return $this->id2;
    }

    public function setId2($id2): self
    {
        $this->id2 = $id2;

        return $this;
    }


}

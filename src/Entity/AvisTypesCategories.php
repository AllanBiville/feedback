<?php

namespace App\Entity;

use App\Repository\AvisTypesCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisTypesCategoriesRepository::class)
 */
class AvisTypesCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Avis::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $avis;

    /**
     * @ORM\ManyToOne(targetEntity=TypesCategories::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $types_categories;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvis(): ?Avis
    {
        return $this->avis;
    }

    public function setAvis(?Avis $avis): self
    {
        $this->avis = $avis;

        return $this;
    }

    public function getTypesCategories(): ?TypesCategories
    {
        return $this->types_categories;
    }

    public function setTypesCategories(?TypesCategories $types_categories): self
    {
        $this->types_categories = $types_categories;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }
}

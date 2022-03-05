<?php

namespace App\Entity;

use App\Repository\AvisCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AvisCategoriesRepository::class)
 */
class AvisCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=Avis::class, inversedBy="categories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $avis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
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
}

<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=30)
     */
    private $Utilisateur;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Heure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Commentaire;

    /**
     * @ORM\OneToMany(targetEntity=AvisCategories::class, mappedBy="avis")
     */
    private $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

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

    public function getUtilisateur(): ?string
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(string $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    public function getHeure(): ?string
    {
        return $this->Heure;
    }

    public function setHeure(string $Heure): self
    {
        $this->Heure = $Heure;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->Commentaire;
    }

    public function setCommentaire(string $Commentaire): self
    {
        $this->Commentaire = $Commentaire;

        return $this;
    }

    /**
     * @return Collection<int, AvisCategories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(AvisCategories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->setAvis($this);
        }

        return $this;
    }

    public function removeCategory(AvisCategories $category): self
    {
        if ($this->categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getAvis() === $this) {
                $category->setAvis(null);
            }
        }

        return $this;
    }
}

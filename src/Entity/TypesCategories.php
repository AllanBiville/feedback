<?php

namespace App\Entity;

use App\Repository\TypesCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypesCategoriesRepository::class)
 */
class TypesCategories
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
    private $shortname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $longname;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getLongname(): ?string
    {
        return $this->longname;
    }

    public function setLongname(string $longname): self
    {
        $this->longname = $longname;

        return $this;
    }
}

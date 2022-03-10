<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypesCategories
 *
 * @ORM\Table(name="types_categories")
 * @ORM\Entity(repositoryClass=TypesCategoriesRepository::class)
 */
class TypesCategories
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
     * @ORM\Column(name="shortname", type="string", length=50, nullable=false)
     */
    private $shortname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="longname", type="string", length=50, nullable=false)
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

    public function setShortname(?string $shortname): self
    {
        $this->shortname = $shortname;

        return $this;
    }

    public function getLongname(): ?string
    {
        return $this->longname;
    }

    public function setLongname(?string $longname): self
    {
        $this->longname = $longname;

        return $this;
    }


}

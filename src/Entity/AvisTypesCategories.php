<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AvisTypesCategories
 *
 * @ORM\Table(name="avis_types_categories", indexes={@ORM\Index(name="id_1", columns={"id_1"})})
 * @ORM\Entity(repositoryClass=AvisTypesCategoriesRepository::class)
 */
class AvisTypesCategories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_1", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="note", type="string", length=1, nullable=false)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getId1(): ?int
    {
        return $this->id1;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }


}

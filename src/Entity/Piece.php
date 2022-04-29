<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_category;

    #[ORM\ManyToOne(targetEntity: Size::class, inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_size;

    #[ORM\ManyToOne(targetEntity: Technique::class, inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private $id_technique;

    #[ORM\Column(type: 'integer')]
    private $year;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIdCategory(): ?Category
    {
        return $this->id_category;
    }

    public function setIdCategory(?Category $id_category): self
    {
        $this->id_category = $id_category;

        return $this;
    }

    public function getIdSize(): ?Size
    {
        return $this->id_size;
    }

    public function setIdSize(?Size $id_size): self
    {
        $this->id_size = $id_size;

        return $this;
    }

    public function getIdTechnique(): ?Technique
    {
        return $this->id_technique;
    }

    public function setIdTechnique(?Technique $id_technique): self
    {
        $this->id_technique = $id_technique;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}

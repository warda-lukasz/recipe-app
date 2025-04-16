<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RecipeRepository;
use App\Trait\ExternalIdEntityTrait;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    use ExternalIdEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $category = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $area = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $instructions = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $mealThumb = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $tags = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $youtube = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $source;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $imageSource = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, length: 255)]
    private ?DateTime $dateModified = null;

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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getInstructions(): ?string
    {
        return $this->instructions;
    }

    public function setInstructions(string $instructions): self
    {
        $this->instructions = $instructions;

        return $this;
    }

    public function getMealThumb(): ?string
    {
        return $this->mealThumb;
    }

    public function setMealThumb(string $mealThumb): self
    {
        $this->mealThumb = $mealThumb;

        return $this;
    }

    public function getTags(): ?string
    {
        return $this->tags;
    }

    public function setTags(string $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getYoutube(): ?string
    {
        return $this->youtube;
    }

    public function setYoutube(string $youtube): self
    {
        $this->youtube = $youtube;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getImageSource(): ?string
    {
        return $this->imageSource;
    }

    public function setImageSource(string $imageSource): self
    {
        $this->imageSource = $imageSource;

        return $this;
    }

    public function getDateModified(): ?DateTime
    {
        return $this->dateModified;
    }

    public function setDateModified(DateTime $dateModified): self
    {
        $this->dateModified = $dateModified;

        return $this;
    }
}

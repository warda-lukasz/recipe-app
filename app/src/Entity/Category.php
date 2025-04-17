<?php

declare(strict_types=1);

namespace App\Entity;

use App\Dto\CategoryDTO;
use App\Dto\DtoInterface;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use InvalidArgumentException;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category implements EntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: Recipe::class, mappedBy: 'category')]
    private ?Collection $recipes = null;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setCategory($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->removeElement($recipe)) {
            if ($recipe->getCategory() === $this) {
                $recipe->setCategory(null);
            }
        }

        return $this;
    }

    public static function fromDto(DtoInterface $dto): self
    {
        if (!$dto instanceof CategoryDTO) {
            throw new InvalidArgumentException('Invalid DTO type');
        }

        $category = new self();
        $category->setName($dto->name);

        return $category;
    }
}

<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\RecipeRepository;
use App\Trait\ExternalIdEntityTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe implements EntityInterface
{
    use ExternalIdEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(type: Types::INTEGER)]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'recipes')]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: false)]
    private ?Category $category = null;

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

    #[
        ORM\ManyToMany(
            targetEntity: Ingredient::class,
            inversedBy: 'recipe',
            cascade: ['persist', 'remove']
        )
    ]
    #[ORM\JoinTable(name: 'recipe_ingredient')]
    private Collection $ingredients;

    #[
        ORM\OneToMany(
            targetEntity: Comment::class,
            mappedBy: 'recipe',
            cascade: ['persist', 'remove']
        )
    ]
    private Collection $comments;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }


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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
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

    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->addRecipe($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removeRecipe($this);
        }

        return $this;
    }

    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setRecipe($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            if ($comment->getRecipe() === $this) {
                $comment->setRecipe(null);
            }
        }

        return $this;
    }
}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IngredientRepository extends ServiceEntityRepository implements RecipeRepositoryInterface, EntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredient::class);
    }

    public function findById(int $id): ?Ingredient
    {
        return null;
    }

    public function findByIds(array $ids): array
    {
        return [];
    }

    public function findByExternalId(string $externalId): ?Ingredient
    {
        return null;
    }

    public function save(object $entity): void {}
}

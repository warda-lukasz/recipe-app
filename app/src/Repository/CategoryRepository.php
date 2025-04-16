<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository implements RecipeRepositoryInterface, EntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findById(int $id): ?Category
    {
        return null;
    }

    public function findByIds(array $ids): array
    {
        return [];
    }

    public function findByExternalId(string $externalId): ?Category
    {
        return null;
    }

    public function save(object $entity): void {}
}

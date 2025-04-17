<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Category;

class CategoryRepository extends DoctrineRepository
{
    protected static string $entity = Category::class;

    public function getCategoryNames(): array
    {
        return $this->createQueryBuilder('e')
            ->select('e.name')
            ->getQuery()
            ->getSingleColumnResult();
    }
}

<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ingredient;

class IngredientRepository extends DoctrineRepository
{
    protected static string $entity = Ingredient::class;
}

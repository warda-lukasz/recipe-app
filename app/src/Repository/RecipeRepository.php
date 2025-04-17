<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Recipe;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends DoctrineRepository
{
    protected static string $entity = Recipe::class;
}

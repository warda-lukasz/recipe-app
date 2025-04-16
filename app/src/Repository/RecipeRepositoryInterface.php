<?php

declare(strict_types=1);

namespace App\Repository;

interface RecipeRepositoryInterface
{
    public function findByExternalId(string $externalId): ?object;
}

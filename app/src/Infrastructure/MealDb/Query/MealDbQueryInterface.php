<?php

declare(strict_types=1);

namespace App\Infrastructure\MealDb\Query;

interface MealDbQueryInterface
{
    public function getEndpoint(): string;
    public function parseResponse(array $responseData): array;
}



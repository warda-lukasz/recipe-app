<?php

namespace App\Infrastructure\MealDb\Query;

use App\Dto\CategoryDTO;

class CategoriesQuery implements MealDbQueryInterface
{
    public function getEndpoint(): string
    {
        return 'list.php?c=list';
    }

    /**
     * @return array<CategoryDTO>
     */
    public function parseResponse(array $responseData): array
    {
        $categories = [];

        foreach ($responseData['meals'] as $categoryData) {
            $categories[] = CategoryDTO::fromArray($categoryData);
        }

        return $categories;
    }
}

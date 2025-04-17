<?php

declare(strict_types=1);

namespace App\Service\Synchronizer;

use App\Repository\CategoryRepository;
use App\Infrastructure\MealDb\Client\MealDbClientInterface;
use App\Infrastructure\MealDb\Query\CategoriesQuery;
use App\Service\Synchronizer\SynchronizerInterface;

class CategorySynchronizer implements SynchronizerInterface
{
    private const string TYPE = 'category';

    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly MealDbClientInterface $mealDbClient
    )
    {}

    public function synchronize(): void
    {
        $categoriesDto = $this->mealDbClient->execute(new CategoriesQuery());
        dump($categoriesDto);
    }

    public function supports(string $type): bool
    {
        return self::TYPE === $type;
    }
}

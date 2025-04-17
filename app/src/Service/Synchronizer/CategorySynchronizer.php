<?php

declare(strict_types=1);

namespace App\Service\Synchronizer;

use App\Repository\CategoryRepository;
use App\Infrastructure\MealDb\Client\MealDbClientInterface;
use App\Infrastructure\MealDb\Query\CategoriesQuery;
use App\Service\Synchronizer\SynchronizerInterface;
use App\Dto\CategoryDTO;
use App\Entity\Category;

class CategorySynchronizer implements SynchronizerInterface
{
    private const string TYPE = 'category';

    public function __construct(
        private readonly CategoryRepository $categoryRepository,
        private readonly MealDbClientInterface $mealDbClient,
        private array $existingNames = [],
    ) {
        $this->existingNames = $this->categoryRepository->findAllCategoryNames();
    }

    public function synchronize(): void
    {
        $newCategories = $this->filterNewCategories();

        if (empty($newCategories)) {
            return;
        }

        /** @var CategoryDTO $category */
        foreach ($newCategories as $category) {
            $this->categoryRepository->save(
                Category::fromDto($category),
                false
            );
        }
    }

    private function fetchCategories(): array
    {
        return $this->mealDbClient->execute(new CategoriesQuery());
    }

    private function filterNewCategories(): array
    {
        $dtos = $this->fetchCategories();

        return array_filter($dtos, function (CategoryDTO $dto) {
            return !in_array($dto->name, $this->existingNames);
        });
    }

    public function supports(string $type): bool
    {
        return self::TYPE === $type;
    }
}

<?php

declare(strict_types=1);

namespace App\Service\Synchronizer;

use App\Infrastructure\MealDb\Client\MealDbClientInterface;
use App\Infrastructure\MealDb\Query\IngredientsQuery;
use App\Repository\IngredientRepository;

class IngredientSynchronizer implements SynchronizerInterface
{
    private const string TYPE = 'ingredient';

    public function __construct(
        private readonly IngredientRepository $ingredientRepository,
        private readonly MealDbClientInterface $mealDbClient
    ) {}

    public function synchronize(): void 
    {
        $ingredientsDto = $this->mealDbClient->execute(new IngredientsQuery());
        dd($ingredientsDto);
    }

    public function supports(string $type): bool
    {
        return self::TYPE === $type;
    }
}

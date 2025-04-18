<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Ingredient;
use App\Infrastructure\MealDb\Client\MealDbClientInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController extends BaseController
{
    private MealDbClientInterface $mealDbClient;

    public function __construct(
        EntityManagerInterface $em,
        MealDbClientInterface $mealDbClient
    ) {
        parent::__construct($em);
        $this->mealDbClient = $mealDbClient;
    }

    #[Route('/ingredient/list', name: 'ingredient_list')]
    public function index(): Response
    {
        $ingredients = $this->em->getRepository(Ingredient::class)->findAll();

        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }

    #[Route('/ingredient/{id}', name: 'ingredient_show')]
    public function show(Ingredient $ingredient): Response
    {
        $thumbnail = $this->mealDbClient::getIngrendientImageUrl($ingredient->getName());

        return $this->render('ingredient/show.html.twig', [
            'ingredient' => $ingredient,
            'thumbnail' => $thumbnail,
        ]);
    }
}

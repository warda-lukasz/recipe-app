<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IngredientController
{

    #[Route('/ingredient/list', name: 'ingredient_list')]
    public function index(): Response
    {
        return new Response('Ingredients index');
    }
}

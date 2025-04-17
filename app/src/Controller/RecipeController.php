<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController
{

    #[Route('/recipe/list', name: 'recipe_list')]
    public function index(): Response
    {
        return new Response('Recipes index');
    }
}

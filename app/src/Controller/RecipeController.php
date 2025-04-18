<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends BaseController
{
    #[Route('/recipe/list', name: 'recipe_list')]
    public function index(Request $req): Response
    {
        $recipes = $this->em->getRepository(Recipe::class)->findAll();
        $title = $req->query->get('title', null);

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'title' => $title,
        ]);
    }

    #[Route('/recipe/show/{id}', name: 'recipe_show')]
    public function show(int $id): Response
    {
        $recipe = $this->em->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException('Recipe not found');
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'title' => $recipe->getTitle(),
        ]);
    }
}

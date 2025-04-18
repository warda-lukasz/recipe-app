<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Recipe;
use App\Form\CommentType;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\RedirectResponse;
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
    public function show(Recipe $recipe): Response
    {
        if (!$recipe) {
            throw $this->createNotFoundException('Recipe not found');
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'title' => $recipe->getTitle(),
        ]);
    }

    #[Route('/recipe/comment/all/{id}', name: 'recipe_all_comments')]
    public function showAllRecipeComments(Recipe $recipe): Response
    {
        return $this->render('recipe/allComments.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recipe/comment/{id}', name: 'recipe_comment')]
    public function commentRecipe(Recipe $recipe, Request $req): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setRecipe($recipe);
            $comment->setCreatedAt(new DateTimeImmutable());

            $this->em->persist($comment);
            $this->em->flush();

            $this->addFlash('success', 'Comment added successfully!');

            return new RedirectResponse($this->generateUrl('recipe_show', ['id' => $recipe->getId()]));
        }

        return $this->render('recipe/addComment.html.twig', [
            'recipe' => $recipe,
            'title' => $recipe->getTitle(),
            'form' => $form->createView(),
        ]);
    }

}

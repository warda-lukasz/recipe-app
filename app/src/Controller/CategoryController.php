<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController
{

    #[Route('/category/list', name: 'category_list')]
    public function index(): Response
    {
        return new Response('Categories index');
    }
}

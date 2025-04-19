<?php

declare(strict_types=1);

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BaseController extends AbstractController
{
    public function __construct(protected EntityManagerInterface $em) {}

    protected function filter() {}
    protected function sort() {}
    protected function paginate() {}
}

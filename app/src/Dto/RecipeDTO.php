<?php

declare(strict_types=1);

namespace App\Dto;

class RecipeDTO implements DtoInterface
{
    public static function fromArray(array $data): self
    {
        return $this;
    }
}

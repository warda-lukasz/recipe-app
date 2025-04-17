<?php

declare(strict_types=1);

namespace App\Dto;

class CategoryDTO implements DtoInterface
{
    public function __construct(
        public readonly ?string $name = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['strCategory'],
        );
    }
}

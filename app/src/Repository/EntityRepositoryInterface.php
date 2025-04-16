<?php

declare(strict_types=1);

namespace App\Repository;

interface EntityRepositoryInterface
{
    public function findAll(): array;
    public function findById(int $id): ?object;
    public function findByIds(array $ids): array;
    public function save(object $entity): void;
}

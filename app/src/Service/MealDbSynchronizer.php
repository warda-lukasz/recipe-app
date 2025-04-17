<?php

declare(strict_types=1);

namespace App\Service;

class MealDbSynchronizer
{
    private iterable $synchronizers;

    /**
     * @param SynchronizerInterface[] $synchronizers
     */
    public function __construct(iterable $synchronizers)
    {
        $this->synchronizers = $synchronizers;
    }

    public function synchronize(string $type = null): void
    {
        if (!$type) {
            $this->synchronizeAll();
        } else {
            $this->synchronizeByType($type);
        }
    }

    public function synchronizeAll(): void
    {
        /** @var SynchronizerInterface $synchronizer */
        foreach ($this->synchronizers as $synchronizer) {
            $synchronizer->synchronize();
        }
    }

    public function synchronizeByType(string $type): void
    {
        /** @var SynchronizerInterface $synchronizer */
        foreach ($this->synchronizers as $synchronizer) {
            if ($synchronizer->supports($type)) {
                $synchronizer->synchronize();
            }
        }
    }
}

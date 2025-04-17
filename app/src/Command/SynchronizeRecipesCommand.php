<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\MealDbSynchronizer;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Throwable;

#[AsCommand(
    name: 'app:sync-recipes',
    description: 'Synchronize recipes with the database',
)]
class SynchronizeRecipesCommand extends Command
{
    public function __construct(
        private readonly MealDbSynchronizer $recipeSynchronizer,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->title('Synchronizing recipes with the database');

        try {
            $this->recipeSynchronizer->synchronize();
        } catch (Throwable $e) {
            $io->error('🤯' . $e->getMessage());

            return Command::FAILURE;
        }

        $io->success('All recipes have been synchronized successfully.');

        return Command::SUCCESS;
    }
}

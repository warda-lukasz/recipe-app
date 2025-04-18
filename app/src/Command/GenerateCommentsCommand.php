<?php

namespace App\Command;

use App\Entity\Comment;
use App\Entity\Recipe;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;

class GenerateCommentsCommand extends Command
{
    protected static $defaultName = 'app:generate-comments';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setDescription('Generuj przykładowe komentarze dla przepisów');
    }

    /**
     * HACK: 
     * Due to generating a large number of comments,
     * in order to avoid memory overload,
     * we periodically flush and clear the EntityManager.
     * Also, we iterate over the recipe IDs and
     * pull new Recipe each time for same reason.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $faker = Factory::create('pl_PL');

        $recipeIds = $this->entityManager->createQuery('SELECT r.id FROM App\Entity\Recipe r')->getResult();
        $io->title('Generowanie komentarzy do przepisów');
        $io->progressStart(count($recipeIds));

        foreach ($recipeIds as $recipeData) {
            $recipeId = $recipeData['id'];

            $recipe = $this->entityManager->find(Recipe::class, $recipeId);
            if (!$recipe) continue;

            $commentsCount = rand(15, 45);

            for ($i = 0; $i < $commentsCount; $i++) {
                $comment = (new Comment())
                    ->setContent($faker->realText(rand(50, 200)))
                    ->setAuthor($faker->name)
                    ->setCreatedAt(new DateTimeImmutable($faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s')))
                    ->setRecipe($recipe);

                $this->entityManager->persist($comment);
            }

            $this->entityManager->flush();
            $this->entityManager->clear();
            $io->progressAdvance();
        }


        $io->progressFinish();
        $io->success('Wygenerowano komentarze dla wszystkich przepisów!');

        return Command::SUCCESS;
    }
}

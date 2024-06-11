<?php

namespace App\Command;

use App\Service\AnimalModificationService\AnimalModificationService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:change-animal-species',
    description: 'Changement de catégorie des espèces de six mois ou plus',
)]
class ChangeAnimalSpeciesCommand extends Command
{
    private AnimalModificationService $animalModificationService;

    public function __construct(AnimalModificationService $animalModificationService)
    {
        parent::__construct();
        $this->animalModificationService = $animalModificationService;
    }

    protected function configure(): void
    {
        // No configuration needed for now
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->animalModificationService->changeSpecies();
        $output->writeln('Changement d\'espèce effectué avec succès');
        return Command::SUCCESS;
    }
}

<?php

namespace App\Service\AnimalModificationService;

use App\Entity\Species;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use DateInterval;

class AnimalModificationService
{
    private EntityManagerInterface $em;
    private AnimalRepository $animalRepository;

    public function __construct(EntityManagerInterface $em, AnimalRepository $animalRepository)
    {
        $this->em = $em;
        $this->animalRepository = $animalRepository;
    }

    public function changeSpecies(): void
    {
        $now = new DateTimeImmutable();
        $sixMonthsAgo = $now->sub(new DateInterval('P6M'));

        // Find animals that are exactly 6 months old
        $animals = $this->animalRepository->findBy([
            'createdAt' => $sixMonthsAgo,
            'espece.name' => ['poussin', 'oison', 'caneton']
        ]);

        // Find or create the 'poulet' species
        $pouletSpecies = $this->em->getRepository(Species::class)->findOneBy(['name' => 'poulet']);
        if (!$pouletSpecies) {
            $pouletSpecies = new Species();
            $pouletSpecies->setName('poulet');
            $this->em->persist($pouletSpecies);
            $this->em->flush(); // Ensure the new species is persisted
        }

        // Update the species of the animals
        foreach ($animals as $animal) {
            $animal->setEspece($pouletSpecies);
            $this->em->persist($animal);
        }

        $this->em->flush(); // Persist all changes to the database
    }
}

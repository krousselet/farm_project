<?php

namespace App\Service\AnimalCreation;

use App\Entity\Animal;
use App\Entity\Species;
use App\Service\Email\SendEmailService;
use DateInterval;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class AnimalCreationService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createAnimalWithSpecies(Animal $animal, SendEmailService $email): void
    {
        $species = $animal->getEspece();
        $existingSpecies = $this->em->getRepository(Species::class)->findOneBy(['name' => $species->getName()]);
        $animal->setCreatedAt(new DateTimeImmutable());

        if ($existingSpecies) {
            $animal->setEspece($existingSpecies);
        } else {
            $this->em->persist($species);
        }

        // Calculate the date when the animal will be 6 months old
        $createdAt = $animal->getCreatedAt();
        $sixMonthsLater = $createdAt->add(new DateInterval('P6M'));
        $animal->setSixMonthsDate($sixMonthsLater);

        $this->em->persist($animal);
        $this->em->flush();

        $email->send(
            $_ENV['APP_DEV_EMAIL'],
            $_ENV['APP_DEV_EMAIL'],
            'Votre animal',
            'animal-creation',
            [
                'animal' => $animal,
                'interval' => $sixMonthsLater,
                'species' => $animal->getEspece()
            ]
        );
    }
}

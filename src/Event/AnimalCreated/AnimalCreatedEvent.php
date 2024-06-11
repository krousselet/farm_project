<?php

namespace App\Event\AnimalCreated;

use App\Entity\Animal;

class AnimalCreatedEvent
{
    public const NAME = 'animal.created';

    private Animal $animal;

    public function __construct(Animal $animal)
    {
        $this->animal = $animal;
    }

    public function getAnimal(): Animal
    {
        return $this->animal;
    }
}
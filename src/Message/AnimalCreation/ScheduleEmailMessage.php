<?php

namespace App\Message\AnimalCreation;

class ScheduleEmailMessage
{
    private int $animalId;
    private \DateTimeImmutable $sendEmailDate;

    public function __construct(int $animalId, \DateTimeImmutable $sendEmailDate)
    {
        $this->animalId = $animalId;
        $this->sendEmailDate = $sendEmailDate;
    }

    public function getAnimalId(): int
    {
        return $this->animalId;
    }

    public function getSendEmailDate(): \DateTimeImmutable
    {
        return $this->sendEmailDate;
    }
}
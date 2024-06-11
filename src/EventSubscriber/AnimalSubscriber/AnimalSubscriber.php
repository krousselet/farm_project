<?php

namespace App\EventSubscriber\AnimalSubscriber;

use App\Event\AnimalCreated\AnimalCreatedEvent;
use App\Message\AnimalCreation\ScheduleEmailMessage;
use DateInterval;
use DateTimeImmutable;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class AnimalSubscriber
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AnimalCreatedEvent::NAME => 'onAnimalCreated',
        ];
    }

    public function onAnimalCreated(AnimalCreatedEvent $event): void
    {
        $animal = $event->getAnimal();
        $createdAt = $animal->getCreatedAt();
        $currentDate = new DateTimeImmutable();

        // Calculate the difference in a way that checks if 6 months have passed
        $sixMonthsLater = $createdAt->add(new DateInterval('P6M'));

        if ($currentDate < $sixMonthsLater) {
            try {
                $this->bus->dispatch(new ScheduleEmailMessage($animal->getId(), $sixMonthsLater));
            } catch (ExceptionInterface $e) {
                // Handle the exception as needed
            }
        }
    }
}
<?php

namespace App\MessageHandler\AnimalCreation;

use App\Entity\Animal;
use App\Message\AnimalCreation\ScheduleEmailMessage;
use App\Service\Email\SendEmailService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class ScheduleEmailMessageHandler
{
    private EntityManagerInterface $em;
    private SendEmailService $sendEmailService;

    public function __construct(EntityManagerInterface $em, SendEmailService $sendEmailService)
    {
        $this->em = $em;
        $this->sendEmailService = $sendEmailService;
    }

    public function __invoke(ScheduleEmailMessage $message): void
    {
        // Get the animal from the database
        $animal = $this->em->getRepository(Animal::class)->find($message->getAnimalId());

        if (!$animal) {
            dd('aucune ocurrence trouvée');
            return;
        }

        // Send the email using the SendEmailService
        $this->sendEmailService->sendEmail(
            'adamrodwebdev@gmail.com',
            'Votre animale a maintenant six mois !',
            sprintf('Votre animale %s a maintenant six mois !', $animal->getName())
        );
    }
}

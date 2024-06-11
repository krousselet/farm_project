<?php

namespace App\Service\UserCreation;

use App\Entity\User;
use App\Service\Email\SendEmailService;
use Doctrine\ORM\EntityManagerInterface;

class UserCreationService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function createUser(User $user, SendEmailService $email): void
    {
        $user = New User();
        $emailUser = $user->getEmail();

        $this->em->persist($user);
        $this->em->flush();
        $email->send(
            $_ENV['APP_DEV_EMAIL'],
            $emailUser,
            'Votre compte',

            'user-creation',
            [
                'user' => $user,
            ]
        );
    }
}
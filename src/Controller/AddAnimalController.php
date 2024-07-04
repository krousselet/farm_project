<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Event\AnimalCreated\AnimalCreatedEvent;
use App\Form\AddAnimalFormType;
use App\Service\AnimalCreation\AnimalCreationService;
use App\Service\Email\SendEmailService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class AddAnimalController extends AbstractController
{
    private EventDispatcherInterface $eventDispatcher;
    private AnimalCreationService $animalCreationService;

    public function __construct(AnimalCreationService $animalCreationService, EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
        $this->animalCreationService = $animalCreationService;
    }

    #[Route('/add-animal', name: 'animal_add')]
    public function add(Request $request, SendEmailService $email): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AddAnimalFormType::class, $animal);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->animalCreationService->createAnimalWithSpecies($animal, $email);
            $event = new AnimalCreatedEvent($animal);
            $this->eventDispatcher->dispatch($event, AnimalCreatedEvent::NAME);
            return $this->redirectToRoute('app_main');
        }

        return $this->render('form/add/add-animal.html.twig', [
            'addAnimalForm' => $form->createView(),
        ]);
    }
}

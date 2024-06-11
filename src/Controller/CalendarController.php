<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    #[Route('/calendar', name: 'app_calendar')]
    public function index(): Response
    {
        return $this->render('calendar/index.html.twig', [
            'controller_name' => 'CalendarController',
        ]);
    }

    #[Route('/api/animal-events', name: 'api_animal_events')]
    public function getAnimalEvents(AnimalRepository $animalRepository): JsonResponse
    {
        $animals = $animalRepository->findAll();
        $events = [];

        foreach ($animals as $animal) {
            $events[] = [
                'title' => $animal->getEspece()->getName() . ' ' . $animal->getName(),
                'start' => $animal->getCreatedAt()->format('Y-m-d H:i:s'),
                'end' => $animal->getSixMonthsDate()->format('Y-m-d H:i:s'),
            ];
        }

        return new JsonResponse($events);
    }
}
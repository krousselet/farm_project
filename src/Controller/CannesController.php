<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CannesController extends AbstractController
{
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }
    #[Route('/cannes', name: 'app_cannes')]
    public function index(): Response
    {
        $animals = $this->animalRepository->findBySpeciesOrderedByCreatedAtDesc('canne');
        return $this->render('cannes/index.html.twig', [
            'controller_name' => 'CannesController',
            'animals' => $animals,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CanetonsController extends AbstractController
{
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }
    #[Route('/canetons', name: 'app_canetons')]
    public function index(): Response
    {
        $animals = $this->animalRepository->findBySpeciesOrderedByCreatedAtDesc('caneton');
        return $this->render('canetons/index.html.twig', [
            'controller_name' => 'CanetonsController',
            'animals' => $animals,
        ]);
    }
}

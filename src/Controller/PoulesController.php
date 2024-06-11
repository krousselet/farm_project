<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PoulesController extends AbstractController
{
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }
    #[Route('/poules', name: 'app_poules')]
    public function index(): Response
    {
        $animals = $this->animalRepository->findBySpeciesOrderedByCreatedAtDesc('poule');
        return $this->render('poules/index.html.twig', [
            'controller_name' => 'PoulesController',
            'animals' => $animals,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OisonsController extends AbstractController
{
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }
    #[Route('/oisons', name: 'app_oisons')]
    public function index(): Response
    {
        $animals = $this->animalRepository->findBySpeciesOrderedByCreatedAtDesc('oison');
        return $this->render('oisons/index.html.twig', [
            'controller_name' => 'OisonsController',
            'animals' => $animals,
        ]);
    }
}

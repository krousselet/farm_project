<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JarsController extends AbstractController
{
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }
    #[Route('/jars', name: 'app_jars')]
    public function index(): Response
    {
        $animals = $this->animalRepository->findBySpeciesOrderedByCreatedAtDesc('jar');
        return $this->render('jars/index.html.twig', [
            'controller_name' => 'JarsController',
            'animals' => $animals,
        ]);
    }
}

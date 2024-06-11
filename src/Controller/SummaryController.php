<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SummaryController extends AbstractController
{
    public function __construct(AnimalRepository $animalRepository)
    {
        $this->animalRepository = $animalRepository;
    }

    #[Route('/summary', name: 'app_summary')]
    public function index(): Response
    {
        $animals = $this->animalRepository->findAll();
        $speciesCount = [];
        foreach ($animals as $animal) {
            $speciesName = $animal->getEspece()->getName();
            if (!isset($speciesCount[$speciesName])) {
                $speciesCount[$speciesName] = 0;
            }
            $speciesCount[$speciesName]++;
        }
        return $this->render('summary/index.html.twig', [
            'controller_name' => 'SummaryController',
            'animals' => $animals,
            'count' => count($animals),
            'speciesCount' => $speciesCount,
        ]);
    }
}
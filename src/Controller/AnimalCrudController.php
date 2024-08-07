<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/animal/crud')]
#[IsGranted('ROLE_ADMIN')]
class AnimalCrudController extends AbstractController
{
    #[Route('/', name: 'app_animal_crud_index', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository): Response
    {
        return $this->render('animal_crud/index.html.twig', [
            'animals' => $animalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_animal_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animal_crud/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_crud_show', methods: ['GET'])]
    public function show(Animal $animal): Response
    {
        return $this->render('animal_crud/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_animal_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_animal_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('animal_crud/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_animal_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_animal_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}

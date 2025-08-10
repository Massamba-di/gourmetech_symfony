<?php

namespace App\Controller;

use App\Entity\TempsDePreparations;
use App\Form\TempsDePreparationsType;
use App\Repository\TempsDePreparationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/temps/de/preparations')]
final class TempsDePreparationsController extends AbstractController
{
    #[Route(name: 'app_temps_de_preparations_index', methods: ['GET'])]
    public function index(TempsDePreparationsRepository $tempsDePreparationsRepository): Response
    {
        return $this->render('temps_de_preparations/index.html.twig', [
            'temps_de_preparations' => $tempsDePreparationsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_temps_de_preparations_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tempsDePreparation = new TempsDePreparations();
        $form = $this->createForm(TempsDePreparationsType::class, $tempsDePreparation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tempsDePreparation);
            $entityManager->flush();

            return $this->redirectToRoute('app_temps_de_preparations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('temps_de_preparations/new.html.twig', [
            'temps_de_preparation' => $tempsDePreparation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_temps_de_preparations_show', methods: ['GET'])]
    public function show(TempsDePreparations $tempsDePreparation): Response
    {
        return $this->render('temps_de_preparations/show.html.twig', [
            'temps_de_preparation' => $tempsDePreparation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_temps_de_preparations_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TempsDePreparations $tempsDePreparation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TempsDePreparationsType::class, $tempsDePreparation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_temps_de_preparations_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('temps_de_preparations/edit.html.twig', [
            'temps_de_preparation' => $tempsDePreparation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_temps_de_preparations_delete', methods: ['POST'])]
    public function delete(Request $request, TempsDePreparations $tempsDePreparation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tempsDePreparation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($tempsDePreparation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_temps_de_preparations_index', [], Response::HTTP_SEE_OTHER);
    }
}

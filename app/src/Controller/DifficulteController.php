<?php

namespace App\Controller;

use App\Entity\Difficulte;
use App\Form\DifficulteType;
use App\Repository\DifficulteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/difficulte')]
final class DifficulteController extends AbstractController
{
    #[Route(name: 'app_difficulte_index', methods: ['GET'])]
    public function index(DifficulteRepository $difficulteRepository): Response
    {
        return $this->render('difficulte/index.html.twig', [
            'difficultes' => $difficulteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_difficulte_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $difficulte = new Difficulte();
        $form = $this->createForm(DifficulteType::class, $difficulte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($difficulte);
            $entityManager->flush();

            return $this->redirectToRoute('app_difficulte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('difficulte/new.html.twig', [
            'difficulte' => $difficulte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_difficulte_show', methods: ['GET'])]
    public function show(Difficulte $difficulte): Response
    {
        return $this->render('difficulte/show.html.twig', [
            'difficulte' => $difficulte,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_difficulte_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Difficulte $difficulte, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DifficulteType::class, $difficulte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_difficulte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('difficulte/edit.html.twig', [
            'difficulte' => $difficulte,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_difficulte_delete', methods: ['POST'])]
    public function delete(Request $request, Difficulte $difficulte, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$difficulte->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($difficulte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_difficulte_index', [], Response::HTTP_SEE_OTHER);
    }
}

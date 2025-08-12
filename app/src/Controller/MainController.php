<?php
namespace App\Controller;




use App\Repository\CategoriesRepository;


use App\Repository\DifficulteRepository;
use App\Repository\RecettesRepository;
use App\Repository\TempsDePreparationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(CategoriesRepository $categoriesRepository, TempsDePreparationsRepository $tempsDePreparationsRepository,DifficulteRepository $difficulteRepository, RecettesRepository $recettesRepository): Response
    {
        $categories = $categoriesRepository->findAll();
        $tempsDePreparations=$tempsDePreparationsRepository->findAll();
        $difficulte=$difficulteRepository->findAll();
        $recettes=$recettesRepository->findAll();

        return $this->render('main/index.html.twig', [
            'categories' => $categories,
            'tempsDePreparations' => $tempsDePreparations,
            'difficulte' => $difficulte,
            'recettes' => $recettes,

        ]);
    }
}

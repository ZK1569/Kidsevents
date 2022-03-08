<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ThemesRepository;

class HomepageController extends AbstractController{

    public function __construct(private ThemesRepository $themesRepository)
    {
        // $this->themesRepository->findAll();
    }

    #[Route('/', name:'homepage.index')]
    public function index():Response{

        return $this->render('homepage/index.html.twig', [
            'contenu' => $this->themesRepository->findAll(),
        ]);
    }
    
}
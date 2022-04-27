<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\SupplementRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController
{

    #[Route('/', name:'homepage.index')]
    public function index(ProductRepository $productRepository, SupplementRepository $supplementRepository):Response{

        return $this->render('homepage/home.html.twig', [
            "contenu" => $productRepository->findAll(),
            "supplement" => $supplementRepository->findAll(),
        ]);
    }
}

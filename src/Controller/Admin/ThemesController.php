<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use App\Form\ThemesType;
use App\Repository\ThemesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class ThemesController extends AbstractController
{
	public function __construct(private ThemesRepository $themesRepository, private RequestStack $requestStack)
	{

	}
#[Route('/', name:'admin.homepage.index')]
	public function index():Response
	{
		return $this->render('admin/homepage/index.html.twig');
	}

	#[Route('/themes', name: 'admin.themes.index')]
    public function index2(): Response
    {
        return $this->render('admin/themes/index.html.twig', [
            'results' => $this->themesRepository->findAll(),
        ]);
    }

#[Route('/themes/add', name: 'admin.themes.add')]
    public function new(Request $request): Response
    {
		$model = new Themes();
		$form =$this->createForm(ThemesType::class, $model);
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$model = $form->getData();
		}
        return $this->render('admin/themes/add.html.twig', [
			'form' => $form->createView(),
		]);
    }
}
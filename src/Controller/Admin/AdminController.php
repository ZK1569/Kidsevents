<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use App\Entity\Options;
use App\Entity\Users;
use App\Form\OptionsType;
use App\Form\ThemesType;
use App\Repository\ThemesRepository;
use App\Repository\OptionsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

/*
	créer un préfixe pour toutes les routes du contrôleur
*/
#[Route('/admin')]

class AdminController extends AbstractController
{
	public function __construct(private ThemesRepository $themesRepository,private OptionsRepository $optionsRepository,private UsersRepository $usersRepository ,private RequestStack $requestStack)
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
    public function form(): Response
    {
        $type = ThemesType::class;
		$model = new Themes();
		$form =$this->createForm($type, $model);
		$form->handleRequest($this->requestStack->getCurrentRequest());
		if($form->isSubmitted() && $form->isValid()){
		}
        return $this->render('admin/themes/add.html.twig', [
			'add' => $form->createView(),
		]);
    }

	#[Route('/options', name: 'admin.options.index')]
    public function index3(): Response
    {
        return $this->render('admin/options/index.html.twig', [
            'results2' => $this->optionsRepository->findAll(),
        ]);
	}

	#[Route('/options/add', name: 'admin.options.add')]
	public function form2(): Response
	{
		$type = OptionsType::class;
		$model = new Options();
		$form =$this->createForm($type, $model);
		$form->handleRequest($this->requestStack->getCurrentRequest());
		if($form->isSubmitted() && $form->isValid()){
		}
		return $this->render('admin/options/add.html.twig', [
			'add' => $form->createView(),
		]);
	}

	#[Route('/users', name: 'admin.users.index')]
	public function index4(): Response
	{
        return $this->render('admin/users/index.html.twig', [
            'results3' => $this->usersRepository->findAll(),
        ]);
	}
}
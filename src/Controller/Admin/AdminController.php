<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class AdminController extends AbstractController
{
	#[Route('/', name:'admin.homepage.index')]	
	public function index():Response
	{
		return $this->render('admin/homepage/index.html.twig');
	}


	#[Route('/users', name: 'admin.users.index')]
	public function index4(): Response
	{
        return $this->render('admin/users/index.html.twig', [
            'results3' => $this->usersRepository->findAll(),
        ]);
	}
}
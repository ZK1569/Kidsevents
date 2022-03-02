<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class UsersController extends AbstractController
{
    
	public function __construct(private UsersRepository $usersRepository)
	{

	}
#[Route('/users', name: 'admin.users.index')]
	public function index(): Response
	{
        return $this->render('admin/users/index.html.twig', [
            'results' => $this->usersRepository->findAll(),
        ]);
	}
}
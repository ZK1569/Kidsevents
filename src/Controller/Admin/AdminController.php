<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class AdminController extends AbstractController
{
	#[Route('/', name:'admin.homepage')]
	public function index():Response
	{
		return $this->render('admin/homepage.html.twig');
	}
}
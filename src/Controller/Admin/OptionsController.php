<?php

namespace App\Controller\Admin;

use App\Entity\Options;
use App\Form\OptionsType;
use App\Repository\OptionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class OptionsController extends AbstractController
{
	public function __construct(private OptionsRepository $optionsRepository)
	{

	}

#[Route('/options', name: 'admin.options.index')]
    public function index(): Response
    {
        return $this->render('admin/options/index.html.twig', [
            'results' => $this->optionsRepository->findAll(),
        ]);
    }

#[Route('/options/add', name: 'admin.options.add')]
    public function new(Request $request): Response
    {
        $model = new Options();
        $form =$this->createForm(OptionsType::class, $model);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // $form->getData() holds the submitted values
            // but, the original `$model` variable has also been updated
            $model = $form->getData();

            // ... perform some action, such as saving the model to the database

            return $this->redirectToRoute('admin.options.index', [
                'results' => $this->optionsRepository->findAll(),
            ]);
        }
        return $this->renderForm('admin/options/add.html.twig', [
            'form' => $form,
        ]);
    }
}

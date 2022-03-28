<?php

namespace App\Controller\Admin;

use App\Form\AdminType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class UsersController extends AbstractController
{
	public function __construct(private UserRepository $userRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager)
	{

	}
	
#[Route('/users', name: 'admin.users.index')]
	public function index(): Response
	{
        return $this->render('admin/users/index.html.twig', [
            'results' => $this->userRepository->findAll(),
        ]);
	}
	#[Route('/users/form/{id}', name: 'admin.users.right')]
    public function form(int $id = null): Response
    {
        // si l'id est null, une option est ajoutée sinon sera modifié
        $model = $this->userRepository->find($id);
        $type = AdminType::class;
        $form =$this->createForm($type, $model);

        $form->handleRequest($this->requestStack->getCurrentRequest());
        if($form->isSubmitted()){
           $this->entityManager->persist($model);
           $this->entityManager->flush();

           $message = 'permissions admin modifiées';
           $this->addFlash('notice', $message);

            return $this->redirectToRoute('admin.users.index', [
                'results' => $this->userRepository->findAll(),
            ]);
        }
        return $this->renderForm('admin/users/adminisation.html.twig', [
            'form' => $form,
        ]);
    }
}
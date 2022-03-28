<?php

namespace App\Controller\Admin;

use App\Entity\Options;
use App\Form\OptionsType;
use App\Repository\OptionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;  
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin')]

class OptionsController extends AbstractController
{
	public function __construct(private OptionsRepository $optionsRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager)
	{

	}

#[Route('/options', name: 'admin.options.index')]
    public function index(): Response
    {
        return $this->render('admin/options/index.html.twig', [
            'results' => $this->optionsRepository->findAll(),
        ]);
    }

#[Route('/options/create', name: 'option_create')]
#[Route('/options/form/{id}', name: 'option_edit')]
    public function form(int $id = null, SluggerInterface $slugger): Response
    {
        // si l'id est null, une option est ajoutée sinon sera modifié
        $model = $id ? $this->optionsRepository->find($id) : new Options();
        $type = OptionsType::class;
        $form =$this->createForm($type, $model);

        $form->handleRequest($this->requestStack->getCurrentRequest());
        if($form->isSubmitted() && $form->isValid()){
			$model->setSlug(strtolower($slugger->slug($model->getIntitule())));
           $this->entityManager->persist($model);
           $this->entityManager->flush();

           $message = $id ? 'Option modifiée' : 'Option créée';
           $this->addFlash('notice', $message);

            return $this->redirectToRoute('admin.options.index', [
				'slug' => $model->getSlug()
            ]);
        }
        
		$formView = $form->createView();

        return $this->render('admin/options/form.html.twig', [
			'formView' => $formView,
        ]);
    }
    
#[Route('/options/remove/{id}', name: 'admin.options.remove')]
    public function remove(int $id):Response{
        $entity =$this->optionsRepository->find($id);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        $this->addFlash('notice', 'option supprimée');

        return $this->redirectToRoute('admin.options.index', [
            'results' => $this->optionsRepository->findAll(),
        ]);
    }
}
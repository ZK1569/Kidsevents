<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use App\Form\ThemesType;
use App\Repository\ThemesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]

class ThemesController extends AbstractController
{
	public function __construct(private ThemesRepository $themesRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager)
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
#[Route('/themes/form/{id}', name: 'admin.themes.update')]
public function form(int $id = null): Response
{
	// si l'id est null, une option est ajoutée sinon sera modifié
	$model = $id ? $this->themes->find($id) : new Themes();
	$type = Themes::class;
	$form =$this->createForm($type, $model);

	$form->handleRequest($this->requestStack->getCurrentRequest());
	if($form->isSubmitted() && $form->isValid()){
		// $form->getData() holds the submitted values
		// but, the original `$model` variable has also been updated
	   $this->entityManager->persist($model);
	   $this->entityManager->flush();

	   $message = $id ? 'theme créée': 'theme modifiée';
	   $this->addFlash('notice', $message);

		// ... perform some action, such as saving the model to the database

		return $this->redirectToRoute('admin.themes.index', [
			'results' => $this->themesRepository->findAll(),
		]);
	}
	return $this->renderForm('admin/themes/form.html.twig', [
		'form' => $form,
	]);
}
#[Route('/themes/remove/{id}', name: 'admin.themes.remove')]
public function remove(int $id):Response{
	$entity =$this->themesRepository->find($id);

	$this->entityManager->remove($entity);
	$this->entityManager->flush();

	$this->addFlash('notice', 'option supprimée');

	return $this->redirectToRoute('admin.themes.index', [
		'results' => $this->themesRepository->findAll(),
	]);
}
}
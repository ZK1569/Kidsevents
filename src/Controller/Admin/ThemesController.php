<?php

namespace App\Controller\Admin;

use App\Entity\Themes;
use App\Form\ThemesType;
use App\Repository\ThemesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RequestStack;

#[Route('/admin')]

class ThemesController extends AbstractController
{
	public function __construct(private ThemesRepository $themesRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager)
	{

	}

	public function postLoad(LifecycleEventArgs $event):void
	{
		if($event->getEntity() instanceof Themes){
			$event->getEntity()->prevImage = $event->getEntity()->getImage();
		}
	}

	public function getSubscribedEvents():array
	{
		return [
			Events::postLoad,
		];
	}
	
	#[Route('/themes', name: 'admin.themes.index')]
    public function index(): Response
    {
        return $this->render('admin/themes/index.html.twig', [
            'results' => $this->themesRepository->findAll(),
        ]);
    }
	#[Route('/{slug}', name: 'theme_show', priority:-1 )]
    public function show($slug, ThemesRepository $themesRepository): Response
    {
        // Foud the theme is the DataBase
        $theme = $themesRepository->findOneBy([
            'slug' => $slug
        ]);

        // If here is nothing in the DataBase with the same slug
        if(!$theme){
            // Raise an excption (error)
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        return $this->render('theme/show.html.twig', [
            'theme' => $theme
        ]);
    }

	// TO edit or create the product (theme)
	#[Route('/admin/theme/create', name:'theme_create')]
	#[Route('/admin/theme/{id}/edit', name:'theme_edit')]
	public function edit (int $id = null, SluggerInterface $slugger)
	{
		// si l'id est null, une option est ajoutée sinon sera modifié
		$model = $id ? $this->themesRepository->find($id) : new Themes();

		if($id){
			$model->prevImage = $model->getImage();
		}


		$type = ThemesType::class;
		$form =$this->createForm($type, $model);

		$form->handleRequest($this->requestStack->getCurrentRequest());
		if($form->isSubmitted() && $form->isValid()){
			$model->setSlug(strtolower($slugger->slug($model->getIntitule())));
			// si une image a été sélectionnée
			if($model->getImage() instanceof UploadedFile){
				$model->getImage()->move('img/Themes', $model->getImage()->getClientOriginalName());
				$model->setImage($model->getImage()->getClientOriginalName());
			} else {
				$model->setImage($model->prevImage);
			}
		$this->entityManager->persist($model);
		$this->entityManager->flush();

		$message = $id ? 'theme modifié': 'theme créé';
		$this->addFlash('notice', $message);

			return $this->redirectToRoute('admin.themes.index', [
				'slug' => $model->getSlug()
			]);
		}

		$formView = $form->createView();

		return $this->render('admin/themes/form.html.twig', [
			'formView' => $formView,
		]);
}

	#[Route('/theme/remove/{id}', name: 'admin.themes.remove')]
	public function remove(int $id):Response{
		$entity =$this->themesRepository->find($id);

		$this->entityManager->remove($entity);
		$this->entityManager->flush();

		$this->addFlash('notice', 'theme supprimé');

		return $this->redirectToRoute('admin.themes.index', [
			'results' => $this->themesRepository->findAll(),
		]);
	}
}
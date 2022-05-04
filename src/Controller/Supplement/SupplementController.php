<?php

namespace App\Controller\Supplement;

use App\Entity\Supplement;
use App\Form\SupplementType;
use App\Repository\SupplementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SupplementController extends AbstractController
{



    
    // To show the supplement
    #[Route('supplement/{slug}', name: 'supplement_show', priority:-1 )]
    public function show($slug, SupplementRepository $supplementRepository): Response
    {
        // Foud the product is the DataBase
        $supplement = $supplementRepository->findOneBy([
            'slug' => $slug
        ]);

        // If here is nothing in the DataBase with the same slug
        if(!$supplement){
            // Raise an excption (error)
            throw $this->createNotFoundException("Le supplement n'existe pas");
        }

        return $this->render('supplement/show.html.twig', [
            'supplement' => $supplement
        ]);
    }


    // To edit the supplement
    #[Route('/admin/supplement/create', name:'supplement_create')]
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em){

        $supplement = new Supplement;

        $form = $this->createForm(SupplementType::class, $supplement);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $supplement->setSlug(strtolower($slugger->slug($supplement->getName())));

            // To add img
            if($supplement->getMainPicture() instanceof UploadedFile){
                $supplement->getMainPicture()->move('img/supplement', $supplement->getMainPicture()->getClientOriginalName());
                $supplement->setMainPicture($supplement->getMainPicture()->getClientOriginalName());
            } else {
                $supplement->setMainPicture($supplement->prevImage);
            }

            $em->persist($supplement);
            $em->flush();

            return $this->redirectToRoute('homepage.index');
        }

        return $this->render('supplement/edit.html.twig',[
            'formView' => $form->createView(),
            'supplement' => $supplement
        ]);
    }

    #[Route('/admin/supplement/{id}/edit', name:'supplement_edit')]
    public function edit ($id, SupplementRepository $supplementRepository, Request $request, EntityManagerInterface $em, SluggerInterface $slugger){

        $supplement = $supplementRepository->find($id);
        $supplement->prevImage = $supplement->getMainPicture();

        // pas encore fait le form ---------
        $form = $this->createForm(SupplementType::class, $supplement);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            // To add img
            if($supplement->getMainPicture() instanceof UploadedFile){
                $supplement->getMainPicture()->move('img/supplement', $supplement->getMainPicture()->getClientOriginalName());
                $supplement->setMainPicture($supplement->getMainPicture()->getClientOriginalName());
            } else {
                $supplement->setMainPicture($supplement->prevImage);
            }

            $supplement->setSlug(strtolower($slugger->slug($supplement->getName())));
            $em->flush();

            return $this->redirectToRoute('homepage.index');
        }

        $formView = $form->createView();

        return $this->render('supplement/edit.html.twig', [
            'formView' => $formView,
            'supplement' => $supplement
        ]);
    }

    // supprimer un supplement
	#[Route('/supplement/remove/{id}', name: 'supplement.remove')]
	public function remove(int $id, EntityManagerInterface $em, SupplementRepository $supplementRepository):Response
	{
		// sélectionner l'entité
		$supplement = $supplementRepository->find($id);

		// supprimer l'entité sélectionnée
		$em->remove($supplement);
		$em->flush();

		// message de confirmation
		$this->addFlash('notice', 'Supplement supprimé');

		// redirection
		return $this->redirectToRoute('homepage.index');
	}
}
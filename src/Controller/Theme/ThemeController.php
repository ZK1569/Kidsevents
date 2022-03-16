<?php

namespace App\Controller\Theme;

use App\Entity\Themes;
use App\Form\ThemeType;
use App\Repository\ThemesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ThemeController extends AbstractController
{



    // To show the product (theme)
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


    // TO edit the product (theme)
    #[Route('/admin/theme/{id}/edit', name:'theme_edit')]
    public function edit ($id, ThemesRepository $themesRepository, Request $request, EntityManagerInterface $em, SluggerInterface $slugger){

        $theme = $themesRepository->find($id);

        // pas encore fait le form ---------
        $form = $this->createForm(ThemeType::class, $theme);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $theme->setSlug(strtolower($slugger->slug($theme->getIntitule())));
            $em->flush();

            return $this->redirectToRoute('theme_show', [
                'slug' => $theme->getSlug()
            ]);
        }

        $formView = $form->createView();

        return $this->render('theme/edit.html.twig', [
            'formView' => $formView,
            'theme' => $theme
        ]);
    }


    // To create a new Product (theme)
    #[Route('/admin/theme/create', name:'theme_create')]
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em){

        $theme = new Themes;

        $form = $this->createForm(ThemeType::class, $theme);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $theme->setSlug(strtolower($slugger->slug($theme->getIntitule())));

            $em->persist($theme);
            $em->flush();

            return $this->redirectToRoute('theme_show', [
                'slug' => $theme->getSlug()
            ]);
        }

        $formView = $form->createView();

        return $this->render('theme/edit.html.twig',[
            'formView' => $formView,
            'theme' => $theme
        ]);



    }
}

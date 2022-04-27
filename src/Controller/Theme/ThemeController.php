<?php

namespace App\Controller\Theme;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ThemeController extends AbstractController
{



    // To show the product
    #[Route('/{slug}', name: 'product_show', priority:-1 )]
    public function show($slug, ProductRepository $productRepository): Response
    {
        // Foud the product is the DataBase
        $product = $productRepository->findOneBy([
            'slug' => $slug
        ]);

        // If here is nothing in the DataBase with the same slug
        if(!$product){
            // Raise an excption (error)
            throw $this->createNotFoundException("Le produit n'existe pas");
        }

        return $this->render('theme/show.html.twig', [
            'product' => $product
        ]);
    }


    // TO edit the product
    #[Route('/admin/product/{id}/edit', name:'product_edit')]
    public function edit ($id, ProductRepository $productRepository, Request $request, EntityManagerInterface $em, SluggerInterface $slugger){

        $product = $productRepository->find($id);
        $product->prevImage = $product->getMainPicture();

        // pas encore fait le form ---------
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            // To add img
            if($product->getMainPicture() instanceof UploadedFile){
                $product->getMainPicture()->move('img/Themes', $product->getMainPicture()->getClientOriginalName());
                $product->setMainPicture($product->getMainPicture()->getClientOriginalName());
            } else {
                $product->setMainPicture($product->prevImage);
            }

            $product->setSlug(strtolower($slugger->slug($product->getName())));
            $em->flush();

            return $this->redirectToRoute('product_show', [
                'slug' => $product->getSlug()
            ]);
        }

        $formView = $form->createView();

        return $this->render('theme/edit.html.twig', [
            'formView' => $formView,
            'product' => $product
        ]);
    }


    // To create a new Product
    #[Route('/admin/product/create', name:'product_create')]
    public function create(Request $request, SluggerInterface $slugger, EntityManagerInterface $em){

        $product = new Product;

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
            $product->setSlug(strtolower($slugger->slug($product->getName())));

            // To add img
            if($product->getMainPicture() instanceof UploadedFile){
                $product->getMainPicture()->move('img/Themes', $product->getMainPicture()->getClientOriginalName());
                $product->setMainPicture($product->getMainPicture()->getClientOriginalName());
            } else {
                $product->setMainPicture($product->prevImage);
            }

            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', [
                'slug' => $product->getSlug()
            ]);     
        }

        $formView = $form->createView();

        return $this->render('theme/edit.html.twig',[
            'formView' => $formView,
            'product' => $product
        ]);
    }
}

<?php

namespace App\Controller\Supplement;

use Doctrine\ORM\Events;
use App\Entity\Supplement;
use App\Form\SupplementType;
use App\Repository\SupplementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SupplementController extends AbstractController{

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
}
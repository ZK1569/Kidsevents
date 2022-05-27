<?php

namespace App\Controller\Purchase;

use App\Entity\User;
use App\Repository\PurchaseRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PurchasesListController extends AbstractController
{

    #[Route('/purchases', name: "purchase_index")]
    #[IsGranted("ROLE_USER", message: "Vous devez etre connecté pour accéder a vos commandes")]
    public function index()
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('homepage.index');
            exit;
        }
        //Return the list of commandes of a user

        /** @var User */
        $user = $this->getUser();

        return $this->render('purchase/index.html.twig', [
            'purchases' => $user->getPurchases()
        ]);
    }

    #[Route('/admin/purchases', name: "purchase_admin")]
    public function Admin(PurchaseRepository $purchaseRepository)
    {

        return $this->render('purchase/admin.html.twig', [
            'purchases' => $purchaseRepository->findAll()
        ]);
    }
}
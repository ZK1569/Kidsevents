<?php

namespace App\Purchase;

use App\Cart\CartService;
use App\Entity\Purchase;
use App\Entity\PurchaseItem;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PurchasePersister extends AbstractController {


    protected $cartService;
    protected $em;

    public function __construct(CartService $cartService, EntityManagerInterface $em){
        $this->cartService = $cartService;
        $this->em = $em;
    }

    Public function storePurchase(Purchase $purchase, SessionInterface $session){

        $user = $this->getUser();

        // Link the purchase and the user 
        $purchase->setUser($user)
        ->setPurchasedAt(new DateTime())
        ->setTotal($this->cartService->getTotal($session));

        $this->em->persist($purchase);

        // Link the purchase and the cart
        foreach($this->cartService->getDetailCartitems($session) as $cartItems){
            $purchaseItem = new PurchaseItem;
            $purchaseItem->setPurchase($purchase)
            ->setProduct($cartItems->product)
            ->setProductName($cartItems->product->getName())
            ->setQuantity($cartItems->qty)
            ->setTotal($cartItems->getTotal())
            ->setProductPrice($cartItems->product->getPrice());

            $this->em->persist($purchaseItem);
        }


        $this->em->flush();
        
    }
}
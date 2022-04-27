<?php

namespace App\Cart;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService{


    protected $productRepository;

    public function __construct(ProductRepository $productRepository){

        $this->productRepository = $productRepository;
    }

    protected function saveCart(array $cart, $session){
        $session->set('cart', $cart);
    }


    public function emplty($session){
        $this->saveCart([], $session);
    }

    public function add(int $id, $session){

        // 1. Retrouver le pannier dans la session
        // 2. Si il n'existe pas encore, alors prendre un tableau vide 
        $cart = $session->get('cart', []);

        // 3. Voir si le produit ($id) existe deja dans le tableau 
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité
        if(!array_key_exists($id, $cart)){
            $cart[$id] = 0; // si il existe ajoute une cantite dans le pannier mais l'elever car il y a pas plusieurs cantité dans le site web
        }
        $cart[$id]++;
        

        // 6. Enregistrer le tableau mis a jour dans la session
        $session->set('cart', $cart);

    }

    public function remove($id, $session){

        $cart = $session->get('cart', []);

        unset($cart[$id]);

        $session->set('cart', $cart);

    }


    public function getTotal($session): int{

        $total = 0;

        foreach($session->get('cart',[]) as $id => $qty){
            $product = $this->productRepository->find($id);

            // Si jamais dans la session il y a un produit qui a ete supprimer de la BDD
            if(!$product){
                continue;
            }

            $total += $product->getPrice() * $qty;
        }

        return $total;

    }

    /**
     *  @return CartItem[]
     */
    public function getDetailCartitems($session): array {

        $detailCart = [];

        foreach($session->get('cart',[]) as $id => $qty){
            $product = $this->productRepository->find($id);

            // Si jamais dans la session il y a un produit qui a ete supprimer de la BDD
            if(!$product){
                continue;
            }

            $detailCart[] = new CartItem($product, $qty);
        }

        return $detailCart;

    }

    public function decrement($id, $session){

        $cart = $session->get('cart', []);

        if(!array_key_exists($id, $cart)){
            return;
        }

        // Si le produit est a 1 alors il faut le supprimer
        if($cart[$id] === 1){
            $this->remove($id, $session);
            return;
        }

        // Soit le produit est a plus de 1, il faut le decrementer
        $cart[$id]--;

        $session->set('cart', $cart);


    }
    
}
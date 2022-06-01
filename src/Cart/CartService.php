<?php

namespace App\Cart;

use App\Repository\ProductRepository;
use App\Repository\SupplementRepository;

class CartService{


    protected $supplementRepository;
    protected $productRepository;

    public function __construct(SupplementRepository $supplementRepository, ProductRepository $productRepository){

        $this->productRepository = $productRepository;
        $this->supplementRepository = $supplementRepository;
    }

    protected function saveCart(array $cart, $session){
        $session->set('cart', $cart);
    }


    public function empty($session){
        $this->saveCart([], $session);
    }

    public function add(string $slug, $session){

        // 1. Cherche le pannier dans la session
        // 2. Si il n'existe pas encore, alors créé un tableau vide 
        $cart = $session->get('cart', []);

        // 3. Vérifie si le produit ($slug) existe déjà dans le tableau 
        // 4. Si c'est le cas, ne rien faire
        // 5. Sinon, ajouter le produit
        if(!array_key_exists($slug, $cart)){
            $cart[$slug] = 0;
        }
        $cart[$slug]++;
        
        // 6. Enregistrer le tableau mis a jour dans la session
        $session->set('cart', $cart);
    }

    public function remove($slug, $session){

        $cart = $session->get('cart', []);

        unset($cart[$slug]);

        $session->set('cart', $cart);
    }

    public function getTotal($session): int{

        $total = 0;

        foreach($session->get('cart',[]) as $slug => $qty){
            $product = $this->productRepository->findOneBy([
                'slug' => $slug
            ]);
            $supplement = $this->supplementRepository->findOneBy([
                'slug' => $slug
            ]);

            // Si jamais dans la session il y a un produit qui a ete supprimer de la BDD
            if(!$supplement and !$product){
                continue;
            }
            elseif(!$supplement){
                $total += $product->getPrice();
            }
            elseif(!$product){
                $total += $supplement->getPrice() * $qty;
            }
            else{
                $total += $product->getPrice() + $supplement->getPrice() * $qty;
            }
        }

        return $total;
    }

    /**
     *  @return CartSup[]
     */
    public function getDetailCartsup($session): array {

        $supCart = [];

        foreach($session->get('cart',[]) as $slug => $qty){
            $supplement = $this->supplementRepository->findOneBy([
                'slug' => $slug
            ]);

            // Si jamais dans la session il y a un produit qui a ete supprimer de la BDD
            if(!$supplement){
                continue;
            }
            $supCart[] = new CartSup($supplement, $qty);
        }
        return $supCart;
    }

    /**
     *  @return CartProd[]
     */
    public function getDetailCartprod($session): array {

        $prodCart = [];

        foreach($session->get('cart',[]) as $slug => $qty){
            $product = $this->productRepository->findOneBy([
                'slug' => $slug
            ]);

            // Si jamais dans la session il y a un produit qui a ete supprimer de la BDD
            if(!$product){
                continue;
            }
            $prodCart[] = new CartProd($product, $qty);
        }
        return $prodCart;
    }

    public function decrement($slug, $session){

        $cart = $session->get('cart', []);

        if(!array_key_exists($slug, $cart)){
            return;
        }
        // Si le produit est a 1 alors il faut le supprimer
        if($cart[$slug] === 1){
            $this->remove($slug, $session);
            return;
        }
        // Soit le produit est a plus de 1, il faut le decrementer
        $cart[$slug]--;

        $session->set('cart', $cart);
    }
}
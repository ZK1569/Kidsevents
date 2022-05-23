<?php

namespace App\Cart;

use App\Repository\ProductRepository;
use App\Repository\SupplementRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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

        // 1. Retrouver le pannier dans la session
        // 2. Si il n'existe pas encore, alors prendre un tableau vide 
        $cart = $session->get('cart', []);

        // 3. Voir si le produit ($id) existe deja dans le tableau 
        // 4. Si c'est le cas, simplement augmenter la quantité
        // 5. Sinon, ajouter le produit avec la quantité
        if(!array_key_exists($slug, $cart)){
            $cart[$slug] = 0; // si il existe ajoute une cantite dans le pannier mais l'elever car il y a pas plusieurs cantité dans le site web
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
     *  @return CartItem[]
     */
    public function getDetailCartitems($session): array {

        $detailCart = [];

        foreach($session->get('cart',[]) as $slug => $qty){
            $product = $this->productRepository->findOneBy([
                'slug' => $slug
            ]);
            $supplement = $this->supplementRepository->findOneBy([
                'slug' => $slug
            ]);

            // Si jamais dans la session il y a un produit qui a ete supprimer de la BDD
            if(!$supplement or !$product){
                continue;
            }

            $detailCart[] = new CartItem($product, $supplement, $qty);
        }

        return $detailCart;

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
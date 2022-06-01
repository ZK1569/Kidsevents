<?php

namespace App\Controller\Cart;


use App\Cart\CartService;
use App\Form\CartConfirmationType;
use App\Repository\ProductRepository;
use App\Repository\SupplementRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{
    protected $productRepository;
    protected $supplementRepository;
    protected $cartService;

    public function __construct(ProductRepository $productRepository, SupplementRepository $supplementRepository, CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->supplementRepository = $supplementRepository;
        $this->cartService = $cartService;
        
    }

    #[Route('cart/add/product/{slug}', name:"cart_add_product")]
    public function add(string $slug, Request $request, SessionInterface $session)
    {
        // Si le produit est dans la base de donnée 
        $product = $this->productRepository->findOneBy([
            'slug' => $slug
        ]);
        if (!$product){
            throw $this->createNotFoundException("$slug n'existe pas !");
        }

        
        $this->cartService->add($slug, $session);
        $this->addFlash('success', "ajout au panier réussi");

        // Si jamais l'option returnToCart est vrai redirige vers le panier
        // Elle est appeler dans le twig index.html.twig venant du templates/cart dans td pour le boutton plus.
        if($request->query->get('returnToCart')){
            return $this->redirectToRoute('cart_show');
        }

        return $this->redirectToRoute('product_show', [
            'slug' => $product->getSlug()
        ]);
    }

    #[Route('cart/add/supplement/{slug}', name:"cart_add_supplement")]
    public function adds($slug, Request $request, SessionInterface $session)
    {
        // Si le supplement est dans la base de donnée 
        $supplement = $this->supplementRepository->findOneBy([
            'slug' => $slug
        ]);
        if (!$supplement){
            throw $this->createNotFoundException("$slug n'existe pas !");
        }

        
        $this->cartService->add($slug, $session);

        $this->addFlash('success', "ajout au panier réussi");

        // Si jamais l'option returnToCart est vrai redirige vers le panier
        // Elle est appeler dans le twig index.html.twig venant du templates/cart dans td pour le boutton plus.
        if($request->query->get('returnToCart')){
            return $this->redirectToRoute('cart_show');
        }

        $route = $request->headers->get('referer');

    return $this->redirect($route);
    }

    
    #[Route('cart/delete/{slug}', name:"cart_delete")]
    public function delete($slug, SessionInterface $session){

        $product = $this->productRepository->findOneBy([
            'slug' => $slug
        ]);

        if(!$product){
            throw $this->createNotFoundException("Le supplement $slug n\'existe pas et ne peut pas être supprimé !");
        }

        $this->cartService->remove($slug, $session);

        $this->addFlash("success", "Le thème a bien été supprimé du panier");

        return $this->redirectToRoute("cart_show");

    }

    #[Route('/cart', name:'cart_show')]
    public function show(SessionInterface $session, CartService $cartService){

        $form = $this->createForm(CartConfirmationType::class);
        
        $supCart = $cartService->getDetailCartsup($session);
        
        $prodCart = $cartService->getDetailCartprod($session);

        $total = $cartService->getTotal($session);

        return $this->render('cart/index.html.twig', [
            'supplements' => $supCart,
            'products' => $prodCart,
            'total' => $total,
            'confirmationForm' => $form->createView(),   
        ]);
    }



    #[Route('/cart/decrement/supplement/{slug}', name:"cart_decrement_supplement")]
    public function decrement($slug, SessionInterface $session) {

        $supplement = $this->supplementRepository->findOneBy([
            'slug' => $slug
        ]);

        if(!$supplement){
            throw $this->createNotFoundException(" Le supplement $slug n'eciste pas et ne peut pas être modifier");
        }

        $this->cartService->decrement($slug, $session);

        $this->addFlash('success', 'Le supplement a bien été modifié');

        return $this->redirectToRoute('cart_show');

    }
}

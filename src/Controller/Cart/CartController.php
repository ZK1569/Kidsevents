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

    #[Route('cart/add/product/{id}', name:"cart_add_product")]
    public function addc($id, Request $request, SessionInterface $session)
    {
        // Si le produit est dans la base de donnée 
        $product = $this->productRepository->find($id);
        if (!$product){
            throw $this->createNotFoundException("$id n'existe pas !");
        }

        
        $this->cartService->add($id, $session);

        $this->addFlash('success', "ajout au panier réussi");

        // Si jamais l'option returnToCart est vrai redirige vers le panier
        // Elle est appeler dans le twig index.html.twig venant du templates/cart dans td pour le boutton plus.
        if($request->query->get('returnToCart')){
            return $this->redirectToRoute('cart_show');
        }

        return $this->redirectToRoute('homepage.index');
    }

    #[Route('cart/add/supplement/{id}', name:"cart_add_supplement")]
    public function adds($id, Request $request, SessionInterface $session)
    {
        // Si le supplement est dans la base de donnée 
        $supplement = $this->supplementRepository->find($id);
        if (!$supplement){
            throw $this->createNotFoundException("$id n'existe pas !");
        }

        
        $this->cartService->add($id, $session);

        $this->addFlash('success', "ajout au panier réussi");

        // Si jamais l'option returnToCart est vrai redirige vers le panier
        // Elle est appeler dans le twig index.html.twig venant du templates/cart dans td pour le boutton plus.
        if($request->query->get('returnToCart')){
            return $this->redirectToRoute('cart_show');
        }

        return $this->redirectToRoute('homepage.index');
    }

    
    #[Route('cart/delete/{id}', name:"cart_delete")]
    public function delet($id, SessionInterface $session){

        $product = $this->productRepository->find($id);

        if(!$product){
            throw $this->createNotFoundException("Le supplement $id n\'existe pas et ne peut pas être supprimé !");
        }

        $this->cartService->remove($id, $session);

        $this->addFlash("success", "Le thème a bien été supprimé du panier");

        return $this->redirectToRoute("cart_show");

    }

    #[Route('/cart', name:'cart_show')]
    public function show(SessionInterface $session, CartService $cartService){

        $form = $this->createForm(CartConfirmationType::class);
        
        $detailCart = $cartService->getDetailCartitems($session);

        $total = $cartService->getTotal($session);

        return $this->render('cart/index.html.twig', [
            'items' => $detailCart,
            'total' => $total,
            'confirmationForm' => $form->createView(),   
        ]);
    }



    #[Route('/cart/decrement/supplement/{id}', name:"cart_decrement_supplement")]
    public function decrement($id, SessionInterface $session) {

        $supplement = $this->supplementRepository->find($id);

        if(!$supplement){
            throw $this->createNotFoundException(" Le supplement $id n'eciste pas et ne peut pas être modifier");
        }

        $this->cartService->decrement($id, $session);

        $this->addFlash('success', 'Le supplement a bien été modifié');

        return $this->redirectToRoute('cart_show');

    }

    


}

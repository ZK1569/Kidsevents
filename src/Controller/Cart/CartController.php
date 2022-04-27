<?php

namespace App\Controller\Cart;


use App\Cart\CartService;
use App\Form\CartConfirmationType;
use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CartController extends AbstractController
{

    protected $productRepository;
    protected $cartService;

    public function __construct(ProductRepository $productRepository, CartService $cartService)
    {
        $this->productRepository = $productRepository;
        $this->cartService = $cartService;
        
    }


    /**
     * @Route("cart/add/{id}", name="cart_add", requirements={"id":"\d+"})
     */
    public function add($id, Request $request, SessionInterface $session)
    {
        // Si le produit est dans la base de donnée 
        $product = $this->productRepository->find($id);
        if (!$product){
            throw $this->createNotFoundException('Le produit $id n\'existe pas !');
        }
        
        $this->cartService->add($id, $session);

        $this->addFlash('success', "Le produit a bien été ajouté au panier");

        // Si jamais l'option returnToCart est vrai redirige vers le panier
        // Elle est appeler dans le twig index.html.twig venant du templates/cart dans td pour le boutton plus.
        if($request->query->get('returnToCart')){
            return $this->redirectToRoute('cart_show');
        }

        return $this->redirectToRoute('product_show', [
            'slug' => $product->getSlug()

        ]);
    }

    /**
     * @Route("cart/delete/{id}", name="cart_delete")
     */
    public function delet($id, SessionInterface $session){

        $product = $this->productRepository->find($id);

        if(!$product){
            throw $this->createNotFoundException("Le theme $id n\'existe pas et ne peut pas être supprimé !");
        }

        $this->cartService->remove($id, $session);

        $this->addFlash("success", "Le produit a bien été supprimé du panier");

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



    /**
     * @Route("/cart/decrement/{id}", name="cart_decrement", requirements={"id": "\d+"})
     */
    public function decrement($id, SessionInterface $session) {

        $produit = $this->productRepository->find($id);

        if(!$produit){
            throw $this->createNotFoundException(" Le produit $id n'eciste pas et ne peut pas être modifier");
        }

        $this->cartService->decrement($id, $session);

        $this->addFlash('success', 'Le produit a bien ete modifier');

        return $this->redirectToRoute('cart_show');

    }

    


}

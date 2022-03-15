<?php 

namespace App\Controller;

use App\Form\InteretType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ThemesRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class HomepageController extends AbstractController{

    public function __construct(private ThemesRepository $themesRepository, private UsersRepository $usersRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager)
    {
        
    }

    #[Route('/', name:'homepage.index')]
    public function index():Response{

        return $this->render('homepage/index.html.twig', [
            'contenu' => $this->themesRepository->findAll(),
            'results' => $this->usersRepository->findAll(),
        ]);
    }
	#[Route('/users/form/{id}', name: 'admin.users.interet')]
    public function form(int $id = null): Response
    {
        // si l'id est null, une option est ajoutée sinon sera modifié
        $model = $this->usersRepository->find($id);
        $type = InteretType::class;
        $form =$this->createForm($type, $model);

        $form->handleRequest($this->requestStack->getCurrentRequest());
        if($form->isSubmitted()){
           $this->entityManager->persist($model);
           $this->entityManager->flush();

           $message = 'Votre demande a été enregistrée';
           $this->addFlash('notice', $message);

            return $this->redirectToRoute('homepage.index');
        }
        return $this->renderForm('admin/users/interet.html.twig', [
            'form' => $form,
        ]);
    }
    
}
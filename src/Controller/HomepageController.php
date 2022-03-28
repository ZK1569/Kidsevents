<?php 

namespace App\Controller;

use App\Form\InteretType;
use Symfony\Component\Mime\Email;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ThemesRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class HomepageController extends AbstractController{

        private Request $request;
    public function __construct(private ThemesRepository $themesRepository, private UserRepository $userRepository, private RequestStack $requestStack, private EntityManagerInterface $entityManager, private MailerInterface $mailer)
    {
        $this->request = $this->requestStack->getMainRequest();
        // $this->themesRepository->findAll();
    }

    #[Route('/', name:'homepage.index')]
    public function index():Response{
        $data = $this->request->request;
        // dump($data);
        if (count($data) > 0) {
            $message = (new Email())
                ->from($data->get('email'))
                ->to("toto@hotmail.com")
                ->subject("KidsEvent Request from ".$data->get('email'))
                ->text($data->get('message'))
            ;

            $this-> mailer -> send($message);
        } 
        return $this->render('homepage/index.html.twig', [
            'contenu' => $this->themesRepository->findAll(),
            'results' => $this->userRepository->findAll(),
        ]);
    }
	#[Route('/users/form/{id}', name: 'admin.users.interet')]
    public function form(int $id = null): Response
    {
        // si l'id est null, une option est ajoutée sinon sera modifié
        $model = $this->userRepository->find($id);
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
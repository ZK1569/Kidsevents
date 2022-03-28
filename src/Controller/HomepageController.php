<?php 

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Repository\ThemesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController{

    private Request $request;
    public function __construct(private ThemesRepository $themesRepository, private RequestStack $requestStack, private MailerInterface $mailer)
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
                ->to("cedric.gautier@hotmail.com")
                ->subject("KidsEvent Request from ".$data->get('email'))
                ->text($data->get('message'))
            ;

            $this-> mailer -> send($message);
        } 
        return $this->render('homepage/index.html.twig', [
            'contenu' => $this->themesRepository->findAll(),
        ]);
    }

    
    
}
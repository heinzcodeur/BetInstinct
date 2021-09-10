<?php

namespace App\Controller;

use App\Repository\BetInstinct\AfficheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AfficheRepository $afficheRepository): Response
    {
        dump($this->getUser());
        $matchs = $afficheRepository->findAll();

        //return new Response('toto');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'matchs'=>$matchs
       ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\BetInstinct\Game;
use App\Entity\BetInstinct\Pronostic;
use App\Repository\BetInstinct\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(GameRepository $gameRepository): Response
    {

        $game = $gameRepository->find(1);
        //$game->setName('test');

        $pronostic = $this->getDoctrine()->getRepository(Pronostic::class)->find(13);
        $pronostic->setGame1($game);

        $em=$this->getDoctrine()->getManager();
        //$em->persist($game);
        $em->flush();
        //dd($pronostic);


        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}

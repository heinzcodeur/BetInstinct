<?php

namespace App\Controller;

use App\Entity\BetInstinct\Classement;
use App\Entity\BetInstinct\Equipe;
use App\Entity\BetInstinct\TypedePari;
use Doctrine\DBAL\Driver\SQLSrv\LastInsertId;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response
    {

        $t=$this->getDoctrine()->getRepository(Equipe::class)->findBy(['name'=>'tottenham']);
        dd($t);

        //$last=$this->getDoctrine()->getRepository(Classement::class)->findOneBy([],['id'=>'desc']);

        //$type=$this->getDoctrine()->getRepository(TypedePari::class)->find(2);


       // dd($type->getType2choix()->getName());
        //$type=$this->getDoctrine()->getRepository(TypedePari::class)->find(1);
        //dd($type);

        //$game = $gameRepository->find(1);
        //$game->setName('test');

       // $pronostic = $this->getDoctrine()->getRepository(Pronostic::class)->find(13);
       // $pronostic->setGame1($game);

       // $em=$this->getDoctrine()->getManager();
        //$em->persist($game);
       // $em->flush();
        //dd($pronostic);


        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}

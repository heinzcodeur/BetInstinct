<?php

namespace App\Controller;

use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\Classement;
use App\Entity\BetInstinct\Equipe;
use App\Entity\BetInstinct\Pronostic;
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

        $last = $this->getDoctrine()->getRepository(\App\Entity\BetInstinct\Classement::class)->findOneBy(['association' => '2','id'=>'desc']);

dd($last);
        $date=new \DateTime('now');
        $timestamp = strtotime($date->format('d-m-Y'));
        dump($date);
        dd($timestamp);

        //$t=$this->getDoctrine()->getRepository(Equipe::class)->findBy(['name'=>'tottenham']);
        $type=$this->getDoctrine()->getRepository(TypedePari::class)->find(25);

        $p=$this->getDoctrine()->getRepository(Pronostic::class)->findBy(['bet'=>204]);

        if(count($p)>1){ dd('return;');}
        $bet=$this->getDoctrine()->getRepository(Bet::class)->find(204);
        //$bets=$this->getDoctrine()->getRepository(Bet::class)->findBy(['bet'=>204]);
        dump($bet->getTypedePAri()->getType2choix()->getName());
        //dump($bets);
dd('la');
        dd($type->getType2choix()->getChoix1());

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


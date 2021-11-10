<?php

namespace App\Controller;

use App\Entity\BetInstinct\Affiche;
use App\Repository\BetInstinct\AfficheRepository;
use App\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(AfficheRepository $afficheRepository, EntityManagerInterface $entityManager): Response
    {
        //dump($this->getUser());

        $affiches=$afficheRepository->findAll();

        $b=$afficheRepository->find(135);
         dump(get_class($b));

            Service::Archivage($affiches,$entityManager);

        /*foreach ($affiches as $a) {
            $s=strtotime($a->getSchedule()->format('d-m-Y'));
            $date=new \DateTime('now');
            $today=strtotime($date->format('d-m-Y'));
            $ecart=$today-$s;
            $ecartype=intval(round($ecart/60/60/24));
            /*dump(($s).' soit '.($s/60/60/24).' jours');
            dump(($today).' soit '.($today/60/60/24).' jours');
            dump(($ecart).' soit '.(round($ecart/60/60/24)).' jours');
            dump(($s).' secondes');
            dump(($s/60).' minutes');
            dump(($s/60/60).' heures');
            dump(($s/60/60/24).' jours');
            /*dump($s/60/60);
            dump($s/60/60);
            if($ecartype>14) {
                $a->setArchived(1);
                $entityManager->flush();
            }
        }*/


        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('a')
            ->from(Affiche::class, 'a')
            ->where('a.archived = 0')
            ->orderBy('a.schedule','DESC');
        // ->where('u.prenom LIKE :prenom')
        //->andWhere('u.nom = :nom')
        //->setParameter('prenom', 'cedric')
        //->setParameter('nom', 'booster');

        $query = $queryBuilder->getQuery();
       // $matchs = $afficheRepository->findAll();

        //return new Response('toto');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'matchs'=>$query->getResult()
       ]);
    }

    /**
     * @Route("/index", name="indexdesparis")
     */
    public function indexParis(){

        return $this->render('home/indexparis.html.twig');

    }
}


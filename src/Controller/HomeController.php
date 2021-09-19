<?php

namespace App\Controller;

use App\Entity\BetInstinct\Affiche;
use App\Repository\BetInstinct\AfficheRepository;
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
        dump($this->getUser());
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('a')
            ->from(Affiche::class, 'a')
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
}

<?php

namespace App\Controller;

use App\Entity\BetInstinct\Classement;
use App\Repository\BetInstinct\ClassementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FunctionsController extends AbstractController
{
    /**
     * @Route("/functions", name="functions")
     */
    public function index(): Response
    {

        return $this->render('functions/index.html.twig', [
            'controller_name' => 'FunctionsController',
        ]);
    }

    static function LastInsert(){
       // $classementRepository->getDoctrine->getRepository(Classement::class);
        //return($l);
    }
}

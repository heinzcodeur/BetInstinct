<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Bet;
use App\Form\BetInstinct\BetType;
use App\Repository\BetInstinct\BetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/bet")
 */
class BetController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_bet_index", methods={"GET"})
     */
    public function index(BetRepository $betRepository, EntityManagerInterface $entityManager): Response
    {

        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('b')
            ->from(Bet::class, 'b')
            //->where('a.archived = 0')
            ->orderBy('b.id','DESC');

        //$bets=$betRepository->findAll();
        $query = $queryBuilder->getQuery();
        return $this->render('bet_instinct/bet/index.html.twig', [
            'bets' => $query->getResult(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="bet_instinct_bet_new", methods={"GET","POST"})
     */
    public function new($id=null,Affiche $affiche, Request $request): Response
    {
        dump($affiche);
        $bet = new Bet();
        $bet->setAffiche($affiche);
        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bet);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/bet/new.html.twig', [
            'bet' => $bet,
            'form' => $form,
            'affiche'=>$affiche
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_bet_show", methods={"GET"})
     */
    public function show(Bet $bet): Response
    {
        //return new Response($bet->getTypedePari()->getType2choix());
       // dd($bet);

        return $this->render('bet_instinct/bet/show.html.twig', [
            'bet' => $bet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_bet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bet $bet): Response
    {
        $form = $this->createForm(BetType::class, $bet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_bet_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('bet_instinct/bet/edit.html.twig', [
            'bet' => $bet,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_bet_delete", methods={"POST"})
     */
    public function delete(Request $request, Bet $bet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_bet_index', [], Response::HTTP_SEE_OTHER);
    }
}

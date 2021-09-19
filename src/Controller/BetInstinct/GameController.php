<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Game;
use App\Form\BetInstinct\GameType;
use App\Repository\BetInstinct\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_game_index", methods={"GET"})
     */
    public function index(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();


        return $this->render('bet_instinct/game/index.html.twig', [
            'games' => $gameRepository->find(2),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_game_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game->setCreated(new \DateTimeImmutable('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_game_show", methods={"GET"})
     */
    public function show(Game $game): Response
    {
        return $this->render('bet_instinct/game/show.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_game_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Game $game): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $game->setCreated(new \DateTime('now'));
            $game->setUpdated(new \DateTime('now'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_game_delete", methods={"POST"})
     */
    public function delete(Request $request, Game $game): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_game_index', [], Response::HTTP_SEE_OTHER);
    }
}

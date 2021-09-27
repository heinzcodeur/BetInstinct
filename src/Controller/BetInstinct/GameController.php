<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Game;
use App\Entity\BetInstinct\Transaction;
use App\Form\BetInstinct\GameType;
use App\Repository\BetInstinct\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(GameRepository $gameRepository, EntityManagerInterface $entityManager): Response
    {
        $queryBuilder=$entityManager->createQueryBuilder();
        $queryBuilder->select('g')
                    ->from(Game::class,'g')
                    ->where('g.isArchived = :archived')
                    ->orderBy('g.id','DESC')
                    ->setParameter('archived',0);
        $games = $queryBuilder->getQuery()->getResult();


        return $this->render('bet_instinct/game/index.html.twig', [
            'games' => $games,
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
     * @Route("/validate/{id}", name="bet_instinct_game_validate", methods={"GET","POST"})
     */
    public function validerGame(Request $request,Game $game)
    {
       // dd($game);
        if ($game->getMise() > 0.1){
            $entityManager = $this->getDoctrine()->getManager();
            $transac=new Transaction();
            $transac->setType('retrait');
            $transac->setMontant($game->getMise());
            $transac->setAuteur($this->getUser());
            $transac->setCreatedAt(new \DateTimeImmutable('now'));

            $solde=$this->getUser()->getSolde();
            $balance=$solde->getBalance();
            $solde=$this->getUser()->getSolde();
            $balance=$solde->getBalance();
            $solde->setBalance($balance - $game->getMise());
            $transac->setGame($game);

            $game->setIsConfirm(true);
            $game->setParieur($this->getUser());

            $cote=0;
            foreach ($game->getPronostics() as $p){
                $cote+=$p->getCote();
                $p->setIsConfirm(true);
                $p->setUpdated(new \DateTime('now'));
            }
            $game->setCoteTotale($cote);


            $entityManager->persist($solde);
            $entityManager->persist($transac);
            //$entityManager->persist($jeu);
            $entityManager->flush();

            $this->addFlash('info','votre game a été validé');

            return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);
    }
        $this->addFlash('danger','game non valide');

        return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);

    }

    /**
     * @Route("/{id}", name="bet_instinct_game_show", methods={"GET"})
     */
    public function show(Game $game): Response
    {
        $cote=0;
        foreach ($game->getPronostics() as $p){
            $cote+=$p->getCote();
        }

        dump($game->getPronostics());
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

            if($game->getCreated()==null){
                $game->setCreated(new \DateTime('now'));
            }
            if($game->getParieur()==null){
                $game->setParieur($this->getUser());
            }
            $game->setUpdated(new \DateTime('now'));

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_game_show', ['id'=>$game->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/archive/{id}", name="bet_instinct_game_archive", methods={"GET"})
     */
    public function archiver(Game $game): Response{
        $game->setResultat('en attente');
        $game->setIsConfirm(false);
        $game->setUpdated(new \DateTimeImmutable('now'));
        $game->setIsArchived(true);
        $game->setParieur($this->getUser());
        $cote=self::CoteTotale($game);

        $game->setCoteTotale($cote);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('bet_instinct_game_index') ;
    }
    /**
     * @Route("/{id}", name="bet_instinct_game_delete", methods={"POST"})
     */
    public function delete(Request $request, Game $game): Response
    {

        foreach($game->getPronostics() as $p){
            if(isset($p)){
                $p->setArchived(true);
                dump($p);
            }
        }
        if($game->getIsArchived()==null || $game->getIsArchived()==false){
                   }
        //dd($game);
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_game_index', [], Response::HTTP_SEE_OTHER);
    }

    static function CoteTotale(Game $game){
        $cote=1;
        foreach ($game->getPronostics() as $p){
            $p->setArchived(true);
            $p->setUpdated(new \DateTime('now'));
            $cote=$cote*$p->getCote();
        }
        return $cote;
    }
}

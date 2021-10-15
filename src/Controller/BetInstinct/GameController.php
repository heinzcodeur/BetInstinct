<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Formule;
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
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('g')
            ->from(Game::class, 'g')
            //->where('g.isArchived = :archived')
            ->orderBy('g.id', 'DESC');
        // ->setParameter('archived',0);
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
           // if($game->getFormule()->getId()==2){
                $cote=1;
                foreach ($game->getPronos() as $prono) {
                    $cote*=$prono->getCote();
                    $game->setCoteTotale($cote);
                }
            //}
            $game->setCreated(new \DateTimeImmutable('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($game);
           // dd($game);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_game_show', ['id'=>$game->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/game/new.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/validate/{id}", name="bet_instinct_game_validate", methods={"GET","POST"})
     */
    public function validerGame(Request $request, Game $game)
    {
        if ($game->getMise() > 0.1) {

            if ($game->getFormule()->getId() == 1 || $game->getFormule()->getId()==2) {

                $entityManager = $this->getDoctrine()->getManager();
                //la mise est valable pour un pari simple ou combiné, alors on cree une transaction de type retrait
                $transac = new Transaction();
                $transac->setType('retrait');
                $transac->setMontant($game->getMise());
                $transac->setAuteur($this->getUser());
                $transac->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac->setGame($game);

                //on valide le game
                $game->setIsConfirm(true);
                $game->setParieur($this->getUser());

                $cote = 0;
                foreach ($game->getPronos() as $p) {
                    $cote += $p->getCote();
                    $p->setIsConfirm(true);
                    $p->setUpdated(new \DateTime('now'));
                }
                $game->setCoteTotale($cote);

                $entityManager->persist($solde);
                $entityManager->persist($transac);
                //$entityManager->persist($jeu);
                $entityManager->flush();

                if ($game->getFormule()->getId() == 1){
                $this->addFlash('info', 'votre game Simple a été validé');
                }
                if ($game->getFormule()->getId() == 2){
                    $this->addFlash('info', 'votre game Combiné a été validé');
                }
                return $this->redirectToRoute('bet_instinct_game_show', ['id' => $game->getId()]);

            }
            else{
                $entityManager = $this->getDoctrine()->getManager();
                //on recupere les pronostics
                $tab=[];
                foreach($game->getPronos() as $p){
                    $tab[]=$p;
                }

                //on crée d'abord le combiné
                $combi=new Game();
                //on donne un nom et lui attribue un game parent
                $combi->setName('Combi'.count($game->getPronostics()).ucfirst($game->getName()));
                $combi->setParent($game);
                //ensuite on attribue $combi au game2 de chaque pronostic et on calcule la cotetotale du combiné
                $cote=1;
                foreach ($game->getPronos() as $p){
                    $p->addGame3($combi);
                    $cote*=$p->getCote();
               }
                //on hydrate le combiné
                $combi->setCoteTotale($cote);
                $combi->setCreated(new \DateTime('now'));
                $combi->setMise($game->getMise());
                $formule=$this->getDoctrine()->getRepository(Formule::class)->find(2);
                $combi->setFormule($formule);
                $combi->setIsConfirm(true);
                $entityManager->persist($combi);

               // creation des paris doubles
                $doubles=[];
                $n=new \DateTime('now');
                $n2=$n->format('d-m-Y/H:i:s');
                //creation du premier double
                $d1=new Game('double1-du-'.$n2);
                $d1->setParent($game);
                $tab[0]->addGame3($d1);
                $tab[1]->addGame3($d1);
                $d1->setCoteTotale(1);
                $d1->setCoteTotale($tab[0]->getCote()*$tab[1]->getCote());
                $d1->setCreated(new \DateTime('now'));
                $d1->setMise($game->getMise());
                $d1->setParieur($this->getUser());
                $d1->setFormule($formule);
                $d1->setIsConfirm(true);
                $entityManager->persist($d1);

                //creation du deuxieme double
                $d2=new Game('double2-du-'.$n2);
                $d2->setParent($game);
                $tab[0]->addGame3($d2);
                $tab[2]->addGame3($d2);
                $d2->setCoteTotale(1);
                $d2->setCoteTotale($tab[0]->getCote()*$tab[2]->getCote());
                $d2->setCreated(new \DateTime('now'));
                $d2->setMise($game->getMise());
                $d2->setParieur($this->getUser());
                $d2->setFormule($formule);
                $d2->setIsConfirm(true);
                $entityManager->persist($d2);

                //creation du troisieme double
                $d3=new Game('double3-du-'.$n2);
                $d3->setParent($game);
                $tab[1]->addGame3($d3);
                $tab[2]->addGame3($d3);
                $d3->setCoteTotale(1);
                $d3->setCoteTotale($tab[1]->getCote()*$tab[2]->getCote());
                $d3->setCreated(new \DateTime('now'));
                $d3->setMise($game->getMise());
                $d3->setParieur($this->getUser());
                $d3->setFormule($formule);
                $d3->setIsConfirm(true);

                $entityManager->persist($d3);

                $entityManager->flush();

                $this->addFlash('info','Votre pari systeme Trixie est valide');

                return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);
            }


        }
        $this->addFlash('danger', 'game non valide');

        return $this->redirectToRoute('bet_instinct_game_show', ['id' => $game->getId()]);

    }

    /**
     * @Route("/{id}", name="bet_instinct_game_show", methods={"GET"})
     */
    public function show(Game $game): Response
    {
        dump($game);

        $cote = 0;
        foreach ($game->getPronostics() as $p) {
            $cote += $p->getCote();
        }

        foreach ($game->getPronostics2() as $g){

       // dump($game->$g);
        }
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
                //dump($game);die();
            if ($game->getCreated() == null) {
                $game->setCreated(new \DateTime('now'));
            }
            if ($game->getParieur() == null) {
                $game->setParieur($this->getUser());
            }
            //if ($game->getCoteTotale() == null) {
                $game->setCoteTotale(self::CoteTotale($game));
            //}
            $game->setUpdated(new \DateTime('now'));
            $game->setResultat(null);

            //dd($game);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_game_show', ['id' => $game->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/archive/{id}", name="bet_instinct_game_archive", methods={"GET"})
     */
    public function archiver(Game $game): Response
    {
        $game->setResultat('en attente');
        $game->setIsConfirm(false);
        $game->setUpdated(new \DateTimeImmutable('now'));
        $game->setIsArchived(true);
        $game->setParieur($this->getUser());
        $cote = self::CoteTotale($game);

        $game->setCoteTotale($cote);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('bet_instinct_game_index');
    }

    /**
     * @Route("/{id}", name="bet_instinct_game_delete", methods={"POST"})
     */
    public function delete(Request $request, Game $game): Response
    {

        foreach ($game->getPronostics() as $p) {
            if (isset($p)) {
                $p->setArchived(true);
                dump($p);
            }
        }
        if ($game->getIsArchived() == null || $game->getIsArchived() == false) {
        }
        //dd($game);
        if ($this->isCsrfTokenValid('delete' . $game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_game_index', [], Response::HTTP_SEE_OTHER);
    }

    static function CoteTotale(Game $game)
    {
        $cote = 1;
        foreach ($game->getPronostics2() as $p) {
            //$p->setArchived(true);
            //$p->setUpdated(new \DateTime('now'));
            dump($p->getCote());
            $cote = $cote * $p->getCote();
        }//dd('ici');
        return $cote;
    }
}

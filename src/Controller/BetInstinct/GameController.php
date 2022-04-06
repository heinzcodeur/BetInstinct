<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Formule;
use App\Entity\BetInstinct\Game;
use App\Entity\BetInstinct\Transaction;
use App\Form\BetInstinct\GameType;
use App\Repository\BetInstinct\GameRepository;
use App\Service;
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
     * @Route("/{value}/index", name="bet_instinct_game_index", methods={"GET"})
     */
    public function index(GameRepository $gameRepository, EntityManagerInterface $entityManager,$value = 'en attente'): Response
    {
        Service::Archivage($gameRepository->findAll(),$entityManager);
        //Service::filterIndex($entityManager,Game::class,'where','resultat','=','perdant');
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('g')
            ->from(Game::class, 'g')
            ->where('g.resultat=:r')
            //->andWhere('g.isArchived = 0')
            ->orderBy('g.id', 'DESC')
            ->setParameter('r',$value)
            ->setMaxResults(99)
        ;
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
            if($game->getName()==null){
                $ladate=new \DateTime('now');
                $game->setName($ladate->format('H:i:s Y-m-d'));
            }
                $cote=1;
                foreach ($game->getPronos() as $prono) {
                    $cote*=$prono->getCote();
                    $game->setCoteTotale($cote);
                }
            //}
            $game->setCreated(new \DateTimeImmutable('now'));
                $game->setParieur($this->getUser());
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
        if (floatval($game->getMise()) > 0.1) {

            if ($game->getFormule()->getId() == 1 || $game->getFormule()->getId() == 2) {

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
                $solde->setBalance($balance - $game->getMise());
                $transac->setGame($game);

                //on valide le game
                $game->setIsConfirm(true);
                $game->setParieur($this->getUser());

                /*$cote = 0;
                foreach ($game->getPronos() as $p) {
                    $cote += $p->getCote();
                    $p->setIsConfirm(true);
                    $p->setUpdated(new \DateTime('now'));
                }
                $game->setCoteTotale($cote);*/

                $entityManager->persist($solde);
                $entityManager->persist($transac);
                //$entityManager->persist($jeu);
                $entityManager->flush();

                if ($game->getFormule()->getId() == 1) {
                    $this->addFlash('info', 'votre game Simple a été validé');
                }
                if ($game->getFormule()->getId() == 2) {
                    $this->addFlash('info', 'votre game Combiné a été validé');
                }
                return $this->redirectToRoute('bet_instinct_game_show', ['id' => $game->getId()]);

            } else {
                $entityManager = $this->getDoctrine()->getManager();
                //Dans un système Canadian, vous donnez cinq pronostics à partir desquels vingt-six paris sont formés: dix combinaisons doubles, dix combinaisons triples, cinq combinaisons quadruples et une combinaison quintuple. Au moins deux pronostics doivent être corrects pour que vous remportiez des gains. Le montant exact de vos gains dépend du nombre de pronostics qui sont corrects.
                //on recupere les pronostics dans $tab
                $tab = self::getPronos($game->getPronos());
                //dump(count($tab));dd('pi');
                //on crée d'abord le combiné
                //ensuite on attribue $combi au game2 de chaque pronostic et on calcule la cotetotale du combiné
                /* foreach ($game->getPronos() as $p){
                     $p->addGame3($combi);
                     $cote*=$p->getCote();
                }*/
                $parieur = $this->getUser();
                $formule = $this->getDoctrine()->getRepository(Formule::class)->find(2);
                $user = $this->getUser();
                $combi = self::Combi($tab, $formule, $game, $user, $entityManager);
                $lesdoubles = [];
                $paires = [];

                // creation des paris doubles
                //on prend le premier element de l'array
                for ($i = 0; $i < count($tab); $i++) {
                    //on prend le 2e element de l'array
                    for ($j = 1; $j < count($tab); $j++) {
                        dump('$i = ' . $i . ' and $j = ' . $j . ' if( ' . $tab[$i]->getBet()->getId() . ' !== ' . $tab[$j]->getBet()->getId() . ')');
                        //si id 1er et id 2e sont differents
                        if ($tab[$i]->getBet()->getId() !== $tab[$j]->getBet()->getId()) {
                            //on recupere les ID et on les compare, on inverse les paires pour 2e comparaison
                            $paire1 = $tab[$i]->getBet()->getId() . ' - ' . $tab[$j]->getBet()->getId();
                            $paire2 = $tab[$j]->getBet()->getId() . ' - ' . $tab[$i]->getBet()->getId();
                        dump($paire1);
                        dd($paire2);
                            if (!in_array($paire1, $paires)) {
                                if (!in_array($paire2, $paires)) {
                                    $double = new Game();
                                    $double->setName('double' . $j);
                                    $double->setParent($game);
                                    $tab[$i]->addGame3($double);
                                    $tab[$j]->addGame3($double);
                                    $double->setCoteTotale(1);
                                    $double->setCoteTotale($tab[$i]->getCote() * $tab[$j]->getCote());
                                    $double->setCreated(new \DateTime('now'));
                                    $double->setMise($game->getMise());
                                    $double->setFormule($formule);
                                    $double->setIsConfirm(true);
                                    $double->setParieur($game->getParieur());

                                    $entityManager->persist($double);

                                    self::transactionPariOut($game,$parieur,$double,$entityManager);
                                   /* $lesdoubles[] = $double;
                                    $transac = new Transaction();
                                    $transac->setType('retrait');
                                    $transac->setMontant($game->getMise());
                                    $transac->setAuteur($user);
                                    $transac->setCreatedAt(new \DateTimeImmutable('now'));

                                    //on met à jour le solde du parieur
                                    $solde = $user->getSolde();
                                    $balance = $solde->getBalance();
                                    $balance = $solde->getBalance();
                                    $solde->setBalance($balance - $game->getMise());
                                    $transac->setGame($combi);

                                    $entityManager->persist($transac);*/
                                }
                            }

                        }
                        $paires[] = $paire1;
                        $paires[] = $paire2;

                        dump($lesdoubles);

                        dump($paires);
                    }
                }

                //creation des triple

                //dd($lesdoubles);

                //$entityManager->flush();

                $this->addFlash('info', 'Votre pari systeme est valide');

                return $this->redirectToRoute('bet_instinct_game_show', ['id' => $game->getId()]);
            }


            $this->addFlash('danger', 'game non valide');

            return $this->redirectToRoute('bet_instinct_game_show', ['id' => $game->getId()]);

        }
        else{
            $this->addFlash('danger','la mise minimale est de 0,10 euros');
            return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);
        }
    }


    /**
     * @Route("/show/{id}", name="bet_instinct_game_show", methods={"GET"})
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

    static function Combi($tab,$formule,$game,$user,$entityManager){

        $combi=new Game();
        //on donne un nom et lui attribue un game parent
        $combi->setName('Combi'.count($game->getPronostics()).ucfirst($game->getName()));
        $combi->setParent($game);
        $cote=1;
        //on associe le combi a chaque pronostic
        foreach ($tab as $p){
            $p->addGame3($combi);
            $cote*=$p->getCote();
        }
        //on hydrate le combiné
        $combi->setCoteTotale($cote);
        $combi->setCreated(new \DateTime('now'));
        $combi->setMise($game->getMise());
        //$formule=$this->getDoctrine()->getRepository(Formule::class)->find(2);
        $combi->setFormule($formule);
        $combi->setIsConfirm(true);
        $combi->setParieur($user);

        $transac = new Transaction();
        $transac->setType('retrait');
        $transac->setMontant($game->getMise());
        $transac->setAuteur($user);
        $transac->setCreatedAt(new \DateTimeImmutable('now'));

        //on met à jour le solde du parieur
        $solde = $user->getSolde();
        $balance = $solde->getBalance();
        $balance = $solde->getBalance();
        $solde->setBalance($balance - $game->getMise());
        $transac->setGame($combi);

        $entityManager->persist($combi);
        $entityManager->persist($transac);


        return $combi;
    }

    static function getPronos($tab){
        foreach($tab as $p){
            $tablo[]=$p;
        }
            return $tablo;
    }

    static function transactionPariOut($game,$parieur,$pari,$entityManager){
        $transac = new Transaction();
        $transac->setType('retrait');
        $transac->setMontant($game->getMise());
        $transac->setAuteur($parieur);
        $transac->setCreatedAt(new \DateTimeImmutable('now'));

        //on met à jour le solde du parieur
        $solde = $parieur->getSolde();
        $balance = $solde->getBalance();
        $balance = $solde->getBalance();
        $solde->setBalance($balance - $game->getMise());
        $transac->setGame($pari);

       // $entityManager->persist($pari);
        $entityManager->persist($transac);
    }
}

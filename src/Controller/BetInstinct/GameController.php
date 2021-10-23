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

                //dump(count($tab));dd('pi');
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
                $combi->setParieur($game->getParieur());
                //Dans un système Lucky 31, vous donnez cinq pronostics à partir desquels 31 paris sont formés: un pari simple par pronostic, dix combinaisons double, dix combinaisons triple, cinq combinaisons quadruples et une combinaison quintuple. Au moins un pronostic doit être correct pour que vous remportiez des gains. Le montant exact de vos gains dépend du nombre de pronostics qui sont corrects.
                //lesdoubles=>p1*p2;p1*p3;p1*p4;p1*p5

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
                $transac->setGame($combi);

                $entityManager->persist($combi);
                $entityManager->persist($transac);
                $entityManager->flush();

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
                $d1->setParieur($game->getParieur());

                $transac1 = new Transaction();
                $transac1->setType('retrait');
                $transac1->setMontant($game->getMise());
                $transac1->setAuteur($this->getUser());
                $transac1->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac1->setGame($d1);

                $entityManager->persist($d1);
                $entityManager->persist($transac1);
                $entityManager->flush();

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
                $d2->setParieur($game->getParieur());

                $transac2 = new Transaction();
                $transac2->setType('retrait');
                $transac2->setMontant($game->getMise());
                $transac2->setAuteur($this->getUser());
                $transac2->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac2->setGame($d2);

                $entityManager->persist($transac2);
                $entityManager->persist($d2);
                $entityManager->flush();

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
                $d3->setParieur($game->getParieur());

                $transac3 = new Transaction();
                $transac3->setType('retrait');
                $transac3->setMontant($game->getMise());
                $transac3->setAuteur($this->getUser());
                $transac3->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac3->setGame($d3);

                $game->setIsConfirm(true);
                $entityManager->persist($d3);
                $entityManager->persist($transac3);

                $d4=new Game('double4-du-'.$n2);
                $d4->setParent($game);
                $tab[1]->addGame3($d4);
                $tab[2]->addGame3($d4);
                $d3->setCoteTotale(1);
                $d3->setCoteTotale($tab[1]->getCote()*$tab[3]->getCote());
                $d3->setCreated(new \DateTime('now'));
                $d3->setMise($game->getMise());
                $d3->setParieur($this->getUser());
                $d3->setFormule($formule);
                $d3->setIsConfirm(true);
                $d3->setParieur($game->getParieur());

                $transac4 = new Transaction();
                $transac4->setType('retrait');
                $transac4->setMontant($game->getMise());
                $transac4->setAuteur($this->getUser());
                $transac4->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac3->setGame($d4);

                $game->setIsConfirm(true);
                $entityManager->persist($d4);
                $entityManager->persist($transac4);

                $d5=new Game('double4-du-'.$n2);
                $d5->setParent($game);
                $tab[1]->addGame3($d5);
                $tab[2]->addGame3($d5);
                $d5->setCoteTotale(1);
                $d5->setCoteTotale($tab[2]->getCote()*$tab[3]->getCote());
                $d5->setCreated(new \DateTime('now'));
                $d5->setMise($game->getMise());
                $d5->setParieur($this->getUser());
                $d5->setFormule($formule);
                $d5->setIsConfirm(true);
                $d5->setParieur($game->getParieur());

                $transac5 = new Transaction();
                $transac5->setType('retrait');
                $transac5->setMontant($game->getMise());
                $transac5->setAuteur($this->getUser());
                $transac5->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac5->setGame($d5);

                $game->setIsConfirm(true);
                $entityManager->persist($d5);
                $entityManager->persist($transac5);

                $d6=new Game('double4-du-'.$n2);
                $d6->setParent($game);
                $tab[1]->addGame3($d6);
                $tab[2]->addGame3($d6);
                $d6->setCoteTotale(1);
                $d6->setCoteTotale($tab[2]->getCote()*$tab[4]->getCote());
                $d6->setCreated(new \DateTime('now'));
                $d6->setMise($game->getMise());
                $d6->setParieur($this->getUser());
                $d6->setFormule($formule);
                $d6->setIsConfirm(true);
                $d6->setParieur($game->getParieur());

                $transac6 = new Transaction();
                $transac6->setType('retrait');
                $transac6->setMontant($game->getMise());
                $transac6->setAuteur($this->getUser());
                $transac6->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac6->setGame($d6);

                $game->setIsConfirm(true);
                $entityManager->persist($d6);
                $entityManager->persist($transac6);


                $d8=new Game('double4-du-'.$n2);
                $d8->setParent($game);
                $tab[1]->addGame3($d8);
                $tab[2]->addGame3($d8);
                $d8->setCoteTotale(1);
                $d8->setCoteTotale($tab[3]->getCote()*$tab[4]->getCote());
                $d8->setCreated(new \DateTime('now'));
                $d8->setMise($game->getMise());
                $d8->setParieur($this->getUser());
                $d8->setFormule($formule);
                $d8->setIsConfirm(true);
                $d8->setParieur($game->getParieur());

                $transac8 = new Transaction();
                $transac8->setType('retrait');
                $transac8->setMontant($game->getMise());
                $transac8->setAuteur($this->getUser());
                $transac8->setCreatedAt(new \DateTimeImmutable('now'));

                //on met à jour le solde du parieur
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde = $this->getUser()->getSolde();
                $balance = $solde->getBalance();
                $solde->setBalance($balance - $game->getMise());
                $transac8->setGame($d8);

                $game->setIsConfirm(true);
                $entityManager->persist($d8);
                $entityManager->persist($transac8);




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

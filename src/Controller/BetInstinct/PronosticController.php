<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\Jeu;
use App\Entity\BetInstinct\Pronostic;
use App\Entity\BetInstinct\Transaction;
use App\Form\BetInstinct\PronosticType;
use App\Repository\BetInstinct\PronosticRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/bet/instinct/pronostic")
 */
class PronosticController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_pronostic_index", methods={"GET"})
     */
    public function index(PronosticRepository $pronosticRepository, EntityManagerInterface $entityManager): Response
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('p')
            ->from(Pronostic::class, 'p')
            ->orderBy('p.created', 'DESC');
        // ->where('u.prenom LIKE :prenom')
        //->andWhere('u.nom = :nom')
        //->setParameter('prenom', 'cedric')
        //->setParameter('nom', 'booster');

        $query = $queryBuilder->getQuery();

        return $this->render('bet_instinct/pronostic/index.html.twig', [
            'pronostics' => $query->getResult()
        ]);
    }

    /**
     * @Route("/new/{bet}/{choix}/{cote}", name="bet_instinct_pronostic_new", methods={"GET","POST"})
     */
    public function new($bet, $choix, $cote, Request $request): Response
    {
        $thebet = $this->getDoctrine()->getRepository(Bet::class)->find($bet);
        $affiche = $thebet->getAffiche();
        $pronostic = new Pronostic();
        $pronostic->setCreated(new \DateTime('now'));
        $pronostic->setBet($thebet);
        $pronostic->setAffiche($pronostic->getBet()->getAffiche());
        $pronostic->setChoix($choix);
        $pronostic->setCote($cote);
        $pronostic->setAuthor($this->getUser());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($pronostic);
        $entityManager->flush();

        return $this->redirectToRoute('bet_instinct_affiche_show', ['id' => $affiche->getId()], Response::HTTP_SEE_OTHER);

        //dd($pronostic);

        // return new Response('pronostic de '.$this->getUser()->getPrenom().' pour le match <b>'.$pronostic->getBet()->getAffiche().'</b><br><br>'.$pronostic->getChoix().' pour '.$pronostic->getBet()->getAffiche()->getFavori(). ' : '.$pronostic->getCote());


        /* $jeu = new Jeu();
         $jeu->setPronostic($pronostic);
         $jeu->setMise(5);
         dd($jeu);
         $form = $this->createForm(PronosticType::class, $pronostic);
         $form->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($pronostic);
             $entityManager->flush();

             return $this->redirectToRoute('bet_instinct_pronostic_index', [], Response::HTTP_SEE_OTHER);
         }

         return $this->renderForm('bet_instinct/pronostic/new.html.twig', [
             'pronostic' => $pronostic,
             'form' => $form,
         ]);*/
    }

    /**
     * @Route("/{id}", name="bet_instinct_pronostic_show", methods={"GET"})
     */
    public function show(Pronostic $pronostic): Response
    {
        return $this->render('bet_instinct/pronostic/show.html.twig', [
            'pronostic' => $pronostic,
        ]);
    }

    /**
     * @Route("/{id}/checkin/{valid}", name="bet_instinct_pronostic_checkin")
     */
    public function checkinPronostic($valid = false, Pronostic $pronostic){
        $em=$this->getDoctrine()->getManager();
        $game=$pronostic->getGame1();
        $pronostic->setIsChecked(true);
            if ($valid == true) {
                //ici on valide le pronostic
                $pronostic->setIsValid(true);
                //si game simple soit un seul pronostic, le game est validé gagnant
                if($game->getFormule()->getId()==1){
                    $game->setResultat('gagnant');
                    $game->setUpdated(new \DateTimeImmutable('now'));
                    $game->setCoteTotale($pronostic->getCote());
                    //puisque le game est gagnant on doit calculer et creer un gain avec une transaction
                    //d'abord on calcule le gain
                    $gain=$pronostic->getCote()*$game->getMise();
                    $game->setGain($gain);
                    $game->setIsArchived(true);
                    //ensuite on cree une transac
                    $transac=new Transaction();
                    $transac->setType('gain');
                    $transac->setMontant($gain);
                    $transac->setAuteur($this->getUser());
                    $transac->setCreatedAt(new \DateTimeImmutable('now'));
                    $transac->setGame($game);

                    //on recupere le solde du parieur
                    $solde=$this->getUser()->getSolde();
                    $balance=$solde->getBalance();
                    //on additionne ce solde au gain
                    $balance+=$gain;
                    $solde->setBalance($balance);

                    $em->persist($transac);
                    $em->flush();

                    $this->addFlash('success','ça fait Zumba Cafew '.$gain.' € pour toi seul!');
                    return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);
                }
                if($game->getFormule()->getId()==2){
                    $em->flush();
                    return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);
                }
            } else {
                $pronostic->setIsValid(false);
                if($game->getFormule()->getId()==1 || $game->getFormule()->getId()==2) {
                    $game->setResultat('perdant');
                    $em->flush();
                }

            }
            return $this->redirectToRoute('bet_instinct_game_show',['id'=>$pronostic->getGame1()->getId()]);
        }



    /**
     * @Route("/{id}/edit/{checkin}/{valid}", name="bet_instinct_pronostic_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pronostic $pronostic): Response
    {
        $em=$this->getDoctrine()->getManager();

        $form = $this->createForm(PronosticType::class, $pronostic);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pronostic->setCreated(new \DateTime('now'));
            $pronostic->setAffiche($pronostic->getBet()->getAffiche());
            dd($pronostic);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_pronostic_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/pronostic/edit.html.twig', [
            'pronostic' => $pronostic,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_pronostic_delete", methods={"POST"})
     */
    public function delete(Request $request, Pronostic $pronostic): Response
    {
        if ($this->isCsrfTokenValid('delete' . $pronostic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pronostic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_pronostic_index', [], Response::HTTP_SEE_OTHER);
    }
}

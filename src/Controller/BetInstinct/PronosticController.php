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
     * @Route("/checkin/{id}/{score}/{valid}/", name="bet_instinct_pronostic_checkin")
     */
    public function checkinPronostic($score, $valid,Pronostic $pronostic){
        $em=$this->getDoctrine()->getManager();

        $pronostic->setIsChecked(true);
        $pronostic->getAffiche()->setScore(intval($score));

        if ($valid == true) {
                foreach ($pronostic->getGame3() as $g){
                //si le pronostic est valide et les game associés sont simple on met leur resultat à gagnant
                    if($g->getFormule()->getId()==1){
                        $g->setResultat('gagnant');
                        $g->setUpdated(new \DateTimeImmutable('now'));
                        $g->setCoteTotale($pronostic->getCote());
                        $pronostic->setIsValid(true);
                        //puisque le game est gagnant on doit calculer et creer un gain avec une transaction
                        //d'abord on calcule le gain
                        $gain=$pronostic->getCote()*$g->getMise();
                        $g->setGain($gain);
                        $g->setIsArchived(true);
                        //ensuite on cree une transac
                        $transac=new Transaction();
                        $transac->setType('gain');
                        $transac->setMontant($gain);
                        $transac->setAuteur($this->getUser());
                        $transac->setCreatedAt(new \DateTimeImmutable('now'));
                        $transac->setGame($g);

                        //on recupere le solde du parieur
                        $solde=$this->getUser()->getSolde();
                        $balance=$solde->getBalance();
                        //on additionne ce solde au gain
                        $balance+=$gain;
                        $solde->setBalance($balance);

                        $em->persist($transac);
                        $em->flush();

                        $this->addFlash('success','ça fait Zumba Cafew '.$gain.' € pour toi seul!');
                        return $this->redirectToRoute('bet_instinct_game_show',['id'=>$g->getId()]);
                    }
                    //sinon si game combiné
                    elseif($g->getFormule()->getId()==2) {
                        $pronostic->setIsValid(true);
                        //pour un pronostic valide, on verifie si tous les autres pronos associés sont déjà checkés alors le game est gagnant
                        foreach ($g->getPronos() as $prono) {
                            //si au moins un prono n'est pas encore checké le resultat de game reste en attente
                            if($prono->getIsChecked()!=1){
                                dd($prono->getId());
                                //$g->setResultat('en attente');
                                return $this->redirectToRoute('bet_instinct_game_show',['id'=>$g->getId()]);
                            }
                        }
                            //sinon le game est gagnant
                            $g->setResultat('gagnant');
                        $em->flush();
                        //dd($g);
                            return $this->redirectToRoute('bet_instinct_game_show',['id'=>$g->getId()]);
                    }
                else{
                    return $this->redirectToRoute('bet_instinct_game_show',['id'=>$g->getId()]);
                    }
                }
                        dd($pronostic->getAffiche()->getFavori()->getNom());
           // dd(count($pronostic->getGame3()));
                //dd('r');
                //ici on valide le pronostic
                $pronostic->setIsValid(true);
                //si game simple soit un seul pronostic, le game est validé gagnant
               /* if($g->getFormule()->getId()==1){
                    //dd($game);
                    $g->setResultat('gagnant');
                    $g->setUpdated(new \DateTimeImmutable('now'));
                    $g->setCoteTotale($pronostic->getCote());
                    //puisque le game est gagnant on doit calculer et creer un gain avec une transaction
                    //d'abord on calcule le gain
                    $gain=$pronostic->getCote()*$g->getMise();
                    $g->setGain($gain);
                    $g->setIsArchived(true);
                    //ensuite on cree une transac
                    $transac=new Transaction();
                    $transac->setType('gain');
                    $transac->setMontant($gain);
                    $transac->setAuteur($this->getUser());
                    $transac->setCreatedAt(new \DateTimeImmutable('now'));
                    $transac->setGame($g);

                    //on recupere le solde du parieur
                    $solde=$this->getUser()->getSolde();
                    $balance=$solde->getBalance();
                    //on additionne ce solde au gain
                    $balance+=$gain;
                    $solde->setBalance($balance);

                    $em->persist($transac);
                    $em->flush();

                    $this->addFlash('success','ça fait Zumba Cafew '.$gain.' € pour toi seul!');
                    return $this->redirectToRoute('bet_instinct_game_show',['id'=>$g->getId()]);
                }
                if($g->getFormule()->getId()==2){

                    $em->flush();
                    return $this->redirectToRoute('bet_instinct_game_show',['id'=>$g->getId()]);
                }
            } else {
                $pronostic->setIsValid(false);
                foreach($pronostic->getGame3() as $g){
                    if($g->getFormule()->getId()!=3){
                        $g->setResultat('perdant');
                        $g->setGain(0);
                        dump($g);
                    }
                    $em->flush();
                }

               // dd('ici');
               /* if($game->getFormule()->getId()==1 || $game->getFormule()->getId()==2) {
                    $game->setResultat('perdant');
                    $game->setGain(0);
                    $em->flush();
                }else{
                    dd('oui');
                }*/

            }
            return $this->redirectToRoute('bet_instinct_game_show',['id'=>$game->getId()]);
        }



    /**
     * @Route("/{id}/edit/", name="bet_instinct_pronostic_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pronostic $pronostic): Response
    {
        $em=$this->getDoctrine()->getManager();

        $form = $this->createForm(PronosticType::class, $pronostic);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $pronostic->setCreated(new \DateTime('now'));
            $pronostic->setAffiche($pronostic->getBet()->getAffiche());
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

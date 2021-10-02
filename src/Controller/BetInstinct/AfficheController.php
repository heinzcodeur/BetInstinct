<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\TypedePari;
use App\Entity\BetInstinct\User;
use App\Form\BetInstinct\AfficheType;
use App\Repository\BetInstinct\AfficheRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/affiche")
 */
class AfficheController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_affiche_index", methods={"GET"})
     */
    public function index(AfficheRepository $afficheRepository, EntityManagerInterface $entityManager): Response
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('a')
            ->from(Affiche::class, 'a')
            ->orderBy('a.id','DESC');

        $query = $queryBuilder->getQuery();
        return $this->render('bet_instinct/affiche/index.html.twig', [
            'affiches' => $query->getResult(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_affiche_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $affiche = new Affiche();
        $bet=new Bet();

        $form = $this->createForm(AfficheType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //on check le type de sport de l'affiche
            //dd($affiche);
           if($affiche->getTournoi()->getSport()->getId()==3){
               //si foot on cree un bet Resultat Foot
            $type=$this->getDoctrine()->getRepository(TypedePari::class)->find(22);
            $bet->setTypedePari($type);
            $bet->setAffiche($affiche);
            $bet->setCote1($affiche->getCoteFavorite());
            $bet->setCote2($affiche->getCoteMatchNull());
            $bet->setCote3($affiche->getCoteOutsider());
            //dd($bet);
           }else{
;               //sinon cree un bet vainqueur tennis
            $bet->setAffiche($affiche);
            $type=$this->getDoctrine()->getRepository(TypedePari::class)->find(2);
            $bet->setTypedePari($type);
            $bet->setCote1($affiche->getCoteFavorite());
            $bet->setCote2($affiche->getCoteOutsider());
           }
            //dd($bet);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($affiche);
            $entityManager->persist($bet);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->renderForm('bet_instinct/affiche/new.html.twig', [
            'affiche' => $affiche,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_affiche_show", methods={"GET"})
     */
    public function show(Affiche $affiche): Response
    {
        return $this->render('bet_instinct/affiche/show.html.twig', [
            'affiche' => $affiche,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_affiche_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Affiche $affiche): Response
    {
        $form = $this->createForm(AfficheType::class, $affiche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_affiche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/affiche/edit.html.twig', [
            'affiche' => $affiche,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_affiche_delete", methods={"POST"})
     */
    public function delete(Request $request, Affiche $affiche): Response
    {
        if ($this->isCsrfTokenValid('delete'.$affiche->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($affiche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_affiche_index', [], Response::HTTP_SEE_OTHER);
    }
}

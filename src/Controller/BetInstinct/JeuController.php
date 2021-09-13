<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Jeu;
use App\Entity\BetInstinct\Transaction;
use App\Form\BetInstinct\JeuType;
use App\Repository\BetInstinct\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/jeu")
 */
class JeuController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_jeu_index", methods={"GET"})
     */
    public function index(JeuRepository $jeuRepository): Response
    {
        return $this->render('bet_instinct/jeu/index.html.twig', [
            'jeus' => $jeuRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_jeu_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $jeu = new Jeu();
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $transac=new Transaction();
            $transac->setType('retrait');
            $transac->setMontant($jeu->getMise());
            $transac->setAuteur($this->getUser());
            $transac->setCreatedAt(new \DateTimeImmutable('now'));

            $solde=$this->getUser()->getSolde();
            $balance=$solde->getBalance();
            //dd($balance);
            $solde->setBalance($balance - $jeu->getMise());

            $jeu->setCreatedAt(new \DateTime('now'));
            $transac->setJeu($jeu);
            //dd($transac);
            $entityManager->persist($solde);
            $entityManager->persist($transac);
            $entityManager->persist($jeu);
            $entityManager->flush();

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/jeu/new.html.twig', [
            'jeu' => $jeu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_jeu_show", methods={"GET"})
     */
    public function show(Jeu $jeu): Response
    {
        return $this->render('bet_instinct/jeu/show.html.twig', [
            'jeu' => $jeu,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_jeu_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Jeu $jeu): Response
    {
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        $entityManager = $this->getDoctrine()->getManager();

        if ($form->isSubmitted() && $form->isValid()) {
            // dd($jeu);
            if($jeu->getResultat()=='3'){
                $transac=new Transaction();
                $transac->setAuteur($this->getUser());
                $transac->setCreatedAt(new \DateTimeImmutable('now'));
                $transac->setJeu($jeu);
                $transac->setType('gain');
                $transac->setMontant($jeu->getPronostic()->getCote()*$jeu->getMise());

                $solde=$this->getUser()->getSolde();
                $balance=$solde->getBalance();

                $solde->setBalance($balance+$transac->getMontant());
                dump($this->getUser()->getSolde());
//dd($balance);

                //$entityManager->persist($solde);
                $entityManager->persist($transac);

                dump($jeu);
                //dd($transac);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_jeu_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/jeu/edit.html.twig', [
            'jeu' => $jeu,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_jeu_delete", methods={"POST"})
     */
    public function delete(Request $request, Jeu $jeu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jeu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($jeu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_jeu_index', [], Response::HTTP_SEE_OTHER);
    }
}

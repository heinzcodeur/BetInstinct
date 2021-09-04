<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Bet;
use App\Entity\BetInstinct\Pronostic;
use App\Form\BetInstinct\PronosticType;
use App\Repository\BetInstinct\PronosticRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/pronostic")
 */
class PronosticController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_pronostic_index", methods={"GET"})
     */
    public function index(PronosticRepository $pronosticRepository): Response
    {
        return $this->render('bet_instinct/pronostic/index.html.twig', [
            'pronostics' => $pronosticRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{bet}/{choix}/{cote}", name="bet_instinct_pronostic_new", methods={"GET","POST"})
     */
    public function new($bet,$choix,$cote,Request $request): Response
    {
        $thebet=$this->getDoctrine()->getRepository(Bet::class)->find($bet);
        $affiche = $thebet->getAffiche();
        //dd($affiche);
        $pronostic = new Pronostic();
        $pronostic->setBet($thebet);
        $pronostic->setChoix($choix);
        $pronostic->setCote($cote);

        return new Response('pronostic de '.$this->getUser()->getPrenom().' pour le match <b>'.$pronostic->getBet()->getAffiche().'</b><br><br>'.$pronostic->getChoix().' pour '.$pronostic->getBet()->getAffiche()->getFavori(). ' : '.$pronostic->getCote());

        dd($pronostic);
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
        ]);
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
     * @Route("/{id}/edit", name="bet_instinct_pronostic_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pronostic $pronostic): Response
    {
        $form = $this->createForm(PronosticType::class, $pronostic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
        if ($this->isCsrfTokenValid('delete'.$pronostic->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pronostic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_pronostic_index', [], Response::HTTP_SEE_OTHER);
    }
}

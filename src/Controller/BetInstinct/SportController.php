<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Sport;
use App\Form\BetInstinct\SportType;
use App\Repository\BetInstinct\SportRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/sport")
 */
class SportController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_sport_index", methods={"GET"})
     */
    public function index(SportRepository $sportRepository): Response
    {
        return $this->render('bet_instinct/sport/index.html.twig', [
            'sports' => $sportRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_sport_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sport = new Sport();
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sport);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/sport/new.html.twig', [
            'sport' => $sport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_sport_show", methods={"GET"})
     */
    public function show(Sport $sport): Response
    {
        return $this->render('bet_instinct/sport/show.html.twig', [
            'sport' => $sport,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_sport_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sport $sport): Response
    {
        $form = $this->createForm(SportType::class, $sport);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_sport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/sport/edit.html.twig', [
            'sport' => $sport,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_sport_delete", methods={"POST"})
     */
    public function delete(Request $request, Sport $sport): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sport->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sport);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_sport_index', [], Response::HTTP_SEE_OTHER);
    }
}

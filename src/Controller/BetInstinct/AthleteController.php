<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Athlete;
use App\Form\BetInstinct\AthleteType;
use App\Repository\BetInstinct\AthleteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/bet/instinct/athlete")
 */
class AthleteController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_athlete_index", methods={"GET"})
     */
    public function index(AthleteRepository $athleteRepository): Response
    {
        return $this->render('bet_instinct/athlete/index.html.twig', [
            'athletes' => $athleteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_athlete_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $athlete = new Athlete();
        $form = $this->createForm(AthleteType::class, $athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($athlete);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_athlete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/athlete/new.html.twig', [
            'athlete' => $athlete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_athlete_show", methods={"GET"})
     */
    public function show(Athlete $athlete): Response
    {
        dump($athlete);
        return $this->render('bet_instinct/athlete/show.html.twig', [
            'athlete' => $athlete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_athlete_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Athlete $athlete): Response
    {
        $form = $this->createForm(AthleteType::class, $athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_athlete_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/athlete/edit.html.twig', [
            'athlete' => $athlete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_athlete_delete", methods={"POST"})
     */
    public function delete(Request $request, Athlete $athlete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$athlete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($athlete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_athlete_index', [], Response::HTTP_SEE_OTHER);
    }
}
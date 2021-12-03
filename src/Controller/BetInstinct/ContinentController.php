<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Continent;
use App\Form\BetInstinct\ContinentType;
use App\Repository\BetInstinct\ContinentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/continent")
 */
class ContinentController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_continent_index", methods={"GET"})
     */
    public function index(ContinentRepository $continentRepository): Response
    {
        return $this->render('bet_instinct/continent/index.html.twig', [
            'continents' => $continentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_continent_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $continent = new Continent();
        $form = $this->createForm(ContinentType::class, $continent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($continent);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_continent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/continent/new.html.twig', [
            'continent' => $continent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_continent_show", methods={"GET"})
     */
    public function show(Continent $continent): Response
    {
        return $this->render('bet_instinct/continent/show.html.twig', [
            'continent' => $continent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_continent_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Continent $continent): Response
    {
        $form = $this->createForm(ContinentType::class, $continent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_continent_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/continent/edit.html.twig', [
            'continent' => $continent,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_continent_delete", methods={"POST"})
     */
    public function delete(Request $request, Continent $continent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$continent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($continent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_continent_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\TypoPari;
use App\Form\BetInstinct\TypoPariType;
use App\Repository\BetInstinct\TypoPariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/typo/pari")
 */
class TypoPariController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_typo_pari_index", methods={"GET"})
     */
    public function index(TypoPariRepository $typoPariRepository): Response
    {
        return $this->render('bet_instinct/typo_pari/index.html.twig', [
            'typo_paris' => $typoPariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_typo_pari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typoPari = new TypoPari();
        $form = $this->createForm(TypoPariType::class, $typoPari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typoPari);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_typo_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/typo_pari/new.html.twig', [
            'typo_pari' => $typoPari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_typo_pari_show", methods={"GET"})
     */
    public function show(TypoPari $typoPari): Response
    {
        return $this->render('bet_instinct/typo_pari/show.html.twig', [
            'typo_pari' => $typoPari,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_typo_pari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypoPari $typoPari): Response
    {
        $form = $this->createForm(TypoPariType::class, $typoPari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_typo_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/typo_pari/edit.html.twig', [
            'typo_pari' => $typoPari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_typo_pari_delete", methods={"POST"})
     */
    public function delete(Request $request, TypoPari $typoPari): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typoPari->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typoPari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_typo_pari_index', [], Response::HTTP_SEE_OTHER);
    }
}

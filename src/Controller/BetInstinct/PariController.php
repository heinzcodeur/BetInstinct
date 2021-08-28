<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Pari;
use App\Form\BetInstinct\PariType;
use App\Repository\BetInstinct\PariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/pari")
 */
class PariController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_pari_index", methods={"GET"})
     */
    public function index(PariRepository $pariRepository): Response
    {
        return $this->render('bet_instinct/pari/index.html.twig', [
            'paris' => $pariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_pari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pari = new Pari();
        $form = $this->createForm(PariType::class, $pari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pari);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/pari/new.html.twig', [
            'pari' => $pari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_pari_show", methods={"GET"})
     */
    public function show(Pari $pari): Response
    {
        return $this->render('bet_instinct/pari/show.html.twig', [
            'pari' => $pari,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_pari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pari $pari): Response
    {
        $form = $this->createForm(PariType::class, $pari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/pari/edit.html.twig', [
            'pari' => $pari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_pari_delete", methods={"POST"})
     */
    public function delete(Request $request, Pari $pari): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pari->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_pari_index', [], Response::HTTP_SEE_OTHER);
    }
}

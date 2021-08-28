<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Choix;
use App\Form\BetInstinct\ChoixType;
use App\Repository\BetInstinct\ChoixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/choix")
 */
class ChoixController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_choix_index", methods={"GET"})
     */
    public function index(ChoixRepository $choixRepository): Response
    {
        return $this->render('bet_instinct/choix/index.html.twig', [
            'choixes' => $choixRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_choix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $choix = new Choix();
        $form = $this->createForm(ChoixType::class, $choix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($choix);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_choix_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/choix/new.html.twig', [
            'choix' => $choix,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_choix_show", methods={"GET"})
     */
    public function show(Choix $choix): Response
    {
        return $this->render('bet_instinct/choix/show.html.twig', [
            'choix' => $choix,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_choix_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Choix $choix): Response
    {
        $form = $this->createForm(ChoixType::class, $choix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_choix_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/choix/edit.html.twig', [
            'choix' => $choix,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_choix_delete", methods={"POST"})
     */
    public function delete(Request $request, Choix $choix): Response
    {
        if ($this->isCsrfTokenValid('delete'.$choix->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($choix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_choix_index', [], Response::HTTP_SEE_OTHER);
    }
}

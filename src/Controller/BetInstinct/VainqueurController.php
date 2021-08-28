<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Vainqueur;
use App\Form\BetInstinct\VainqueurType;
use App\Repository\BetInstinct\VainqueurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/vainqueur")
 */
class VainqueurController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_vainqueur_index", methods={"GET"})
     */
    public function index(VainqueurRepository $vainqueurRepository): Response
    {
        return $this->render('bet_instinct/vainqueur/index.html.twig', [
            'vainqueurs' => $vainqueurRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_vainqueur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vainqueur = new Vainqueur();
        $form = $this->createForm(VainqueurType::class, $vainqueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vainqueur);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_vainqueur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/vainqueur/new.html.twig', [
            'vainqueur' => $vainqueur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_vainqueur_show", methods={"GET"})
     */
    public function show(Vainqueur $vainqueur): Response
    {
        return $this->render('bet_instinct/vainqueur/show.html.twig', [
            'vainqueur' => $vainqueur,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_vainqueur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vainqueur $vainqueur): Response
    {
        $form = $this->createForm(VainqueurType::class, $vainqueur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_vainqueur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/vainqueur/edit.html.twig', [
            'vainqueur' => $vainqueur,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_vainqueur_delete", methods={"POST"})
     */
    public function delete(Request $request, Vainqueur $vainqueur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vainqueur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vainqueur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_vainqueur_index', [], Response::HTTP_SEE_OTHER);
    }
}

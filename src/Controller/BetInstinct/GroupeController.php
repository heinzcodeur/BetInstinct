<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Groupe;
use App\Form\BetInstinct\GroupeType;
use App\Repository\BetInstinct\GroupeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/groupe")
 */
class GroupeController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_groupe_index", methods={"GET"})
     */
    public function index(GroupeRepository $groupeRepository): Response
    {
        return $this->render('bet_instinct/groupe/index.html.twig', [
            'groupes' => $groupeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_groupe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($groupe);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_groupe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/groupe/new.html.twig', [
            'groupe' => $groupe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_groupe_show", methods={"GET"})
     */
    public function show(Groupe $groupe): Response
    {
        return $this->render('bet_instinct/groupe/show.html.twig', [
            'groupe' => $groupe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_groupe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Groupe $groupe): Response
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_groupe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/groupe/edit.html.twig', [
            'groupe' => $groupe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_groupe_delete", methods={"POST"})
     */
    public function delete(Request $request, Groupe $groupe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$groupe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($groupe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_groupe_index', [], Response::HTTP_SEE_OTHER);
    }
}

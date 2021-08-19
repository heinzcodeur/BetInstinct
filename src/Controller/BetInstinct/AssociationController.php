<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Association;
use App\Form\BetInstinct\AssociationType;
use App\Repository\BetInstinct\AssociationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/association")
 */
class AssociationController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_association_index", methods={"GET"})
     */
    public function index(AssociationRepository $associationRepository): Response
    {
        return $this->render('bet_instinct/association/index.html.twig', [
            'associations' => $associationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_association_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $association = new Association();
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($association);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_association_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/association/new.html.twig', [
            'association' => $association,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_association_show", methods={"GET"})
     */
    public function show(Association $association): Response
    {
        return $this->render('bet_instinct/association/show.html.twig', [
            'association' => $association,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_association_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Association $association): Response
    {
        $form = $this->createForm(AssociationType::class, $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_association_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/association/edit.html.twig', [
            'association' => $association,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_association_delete", methods={"POST"})
     */
    public function delete(Request $request, Association $association): Response
    {
        if ($this->isCsrfTokenValid('delete'.$association->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($association);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_association_index', [], Response::HTTP_SEE_OTHER);
    }
}

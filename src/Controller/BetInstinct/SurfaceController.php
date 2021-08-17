<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Surface;
use App\Form\BetInstinct\SurfaceType;
use App\Repository\BetInstinct\SurfaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/surface")
 */
class SurfaceController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_surface_index", methods={"GET"})
     */
    public function index(SurfaceRepository $surfaceRepository): Response
    {
        return $this->render('bet_instinct/surface/index.html.twig', [
            'surfaces' => $surfaceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_surface_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $surface = new Surface();
        $form = $this->createForm(SurfaceType::class, $surface);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($surface);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_surface_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/surface/new.html.twig', [
            'surface' => $surface,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_surface_show", methods={"GET"})
     */
    public function show(Surface $surface): Response
    {
        return $this->render('bet_instinct/surface/show.html.twig', [
            'surface' => $surface,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_surface_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Surface $surface): Response
    {
        $form = $this->createForm(SurfaceType::class, $surface);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_surface_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/surface/edit.html.twig', [
            'surface' => $surface,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_surface_delete", methods={"POST"})
     */
    public function delete(Request $request, Surface $surface): Response
    {
        if ($this->isCsrfTokenValid('delete'.$surface->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($surface);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_surface_index', [], Response::HTTP_SEE_OTHER);
    }
}

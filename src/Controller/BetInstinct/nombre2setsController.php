<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\nombre2sets;
use App\Form\BetInstinct\nombre2setsType;
use App\Repository\BetInstinct\nombre2setsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/nombre2sets")
 */
class nombre2setsController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_nombre2sets_index", methods={"GET"})
     */
    public function index(nombre2setsRepository $nombre2setsRepository): Response
    {
        return $this->render('bet_instinct/nombre2sets/index.html.twig', [
            'nombre2sets' => $nombre2setsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_nombre2sets_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nombre2set = new nombre2sets();
        $form = $this->createForm(nombre2setsType::class, $nombre2set);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nombre2set);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_nombre2sets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/nombre2sets/new.html.twig', [
            'nombre2set' => $nombre2set,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_nombre2sets_show", methods={"GET"})
     */
    public function show(nombre2sets $nombre2set): Response
    {
        return $this->render('bet_instinct/nombre2sets/show.html.twig', [
            'nombre2set' => $nombre2set,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_nombre2sets_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, nombre2sets $nombre2set): Response
    {
        $form = $this->createForm(nombre2setsType::class, $nombre2set);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_nombre2sets_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/nombre2sets/edit.html.twig', [
            'nombre2set' => $nombre2set,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_nombre2sets_delete", methods={"POST"})
     */
    public function delete(Request $request, nombre2sets $nombre2set): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nombre2set->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nombre2set);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_nombre2sets_index', [], Response::HTTP_SEE_OTHER);
    }
}

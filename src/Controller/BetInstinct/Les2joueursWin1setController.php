<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Les2joueursWin1set;
use App\Form\BetInstinct\Les2joueursWin1setType;
use App\Repository\BetInstinct\Les2joueursWin1setRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/les2joueurs/win1set")
 */
class Les2joueursWin1setController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_les2joueurs_win1set_index", methods={"GET"})
     */
    public function index(Les2joueursWin1setRepository $les2joueursWin1setRepository): Response
    {
        return $this->render('bet_instinct/les2joueurs_win1set/index.html.twig', [
            'les2joueurs_win1sets' => $les2joueursWin1setRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_les2joueurs_win1set_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $les2joueursWin1set = new Les2joueursWin1set();
        $form = $this->createForm(Les2joueursWin1setType::class, $les2joueursWin1set);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($les2joueursWin1set);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_les2joueurs_win1set_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/les2joueurs_win1set/new.html.twig', [
            'les2joueurs_win1set' => $les2joueursWin1set,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_les2joueurs_win1set_show", methods={"GET"})
     */
    public function show(Les2joueursWin1set $les2joueursWin1set): Response
    {
        return $this->render('bet_instinct/les2joueurs_win1set/show.html.twig', [
            'les2joueurs_win1set' => $les2joueursWin1set,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_les2joueurs_win1set_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Les2joueursWin1set $les2joueursWin1set): Response
    {
        $form = $this->createForm(Les2joueursWin1setType::class, $les2joueursWin1set);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_les2joueurs_win1set_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/les2joueurs_win1set/edit.html.twig', [
            'les2joueurs_win1set' => $les2joueursWin1set,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_les2joueurs_win1set_delete", methods={"POST"})
     */
    public function delete(Request $request, Les2joueursWin1set $les2joueursWin1set): Response
    {
        if ($this->isCsrfTokenValid('delete'.$les2joueursWin1set->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($les2joueursWin1set);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_les2joueurs_win1set_index', [], Response::HTTP_SEE_OTHER);
    }
}

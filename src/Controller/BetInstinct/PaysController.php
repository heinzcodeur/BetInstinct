<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Pays;
use App\Form\BetInstinct\PaysType;
use App\Repository\BetInstinct\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/pays")
 */
class PaysController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_pays_index", methods={"GET"})
     */
    public function index(PaysRepository $paysRepository): Response
    {
        return $this->render('bet_instinct/pays/index.html.twig', [
            'pays' => $paysRepository->paysAllDesc(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_pays_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pay = new Pays();
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pay);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/pays/new.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_pays_show", methods={"GET"})
     */
    public function show(Pays $pay): Response
    {
        return $this->render('bet_instinct/pays/show.html.twig', [
            'pay' => $pay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_pays_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pays $pay): Response
    {
        $form = $this->createForm(PaysType::class, $pay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_pays_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/pays/edit.html.twig', [
            'pay' => $pay,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_pays_delete", methods={"POST"})
     */
    public function delete(Request $request, Pays $pay): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pay->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pay);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_pays_index', [], Response::HTTP_SEE_OTHER);
    }
}

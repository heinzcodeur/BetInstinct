<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Bankroll;
use App\Form\BetInstinct\BankrollType;
use App\Repository\BetInstinct\BankrollRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/bankroll")
 */
class BankrollController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_bankroll_index", methods={"GET"})
     */
    public function index(BankrollRepository $bankrollRepository): Response
    {
        return $this->render('bet_instinct/bankroll/index.html.twig', [
            'bankrolls' => $bankrollRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_bankroll_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bankroll = new Bankroll();
        $form = $this->createForm(BankrollType::class, $bankroll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bankroll);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_bankroll_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/bankroll/new.html.twig', [
            'bankroll' => $bankroll,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_bankroll_show", methods={"GET"})
     */
    public function show(Bankroll $bankroll): Response
    {
        return $this->render('bet_instinct/bankroll/show.html.twig', [
            'bankroll' => $bankroll,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_bankroll_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bankroll $bankroll): Response
    {
        $form = $this->createForm(BankrollType::class, $bankroll);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_bankroll_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/bankroll/edit.html.twig', [
            'bankroll' => $bankroll,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_bankroll_delete", methods={"POST"})
     */
    public function delete(Request $request, Bankroll $bankroll): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bankroll->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bankroll);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_bankroll_index', [], Response::HTTP_SEE_OTHER);
    }
}

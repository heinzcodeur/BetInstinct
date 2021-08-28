<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Type2Pari;
use App\Form\BetInstinct\Type2PariType;
use App\Repository\BetInstinct\Type2PariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/type2/pari")
 */
class Type2PariController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_type2_pari_index", methods={"GET"})
     */
    public function index(Type2PariRepository $type2PariRepository): Response
    {
        return $this->render('bet_instinct/type2_pari/index.html.twig', [
            'type2_paris' => $type2PariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_type2_pari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $type2Pari = new Type2Pari();
        $form = $this->createForm(Type2PariType::class, $type2Pari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type2Pari);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_type2_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/type2_pari/new.html.twig', [
            'type2_pari' => $type2Pari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_type2_pari_show", methods={"GET"})
     */
    public function show(Type2Pari $type2Pari): Response
    {
        return $this->render('bet_instinct/type2_pari/show.html.twig', [
            'type2_pari' => $type2Pari,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_type2_pari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Type2Pari $type2Pari): Response
    {
        $form = $this->createForm(Type2PariType::class, $type2Pari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_type2_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/type2_pari/edit.html.twig', [
            'type2_pari' => $type2Pari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_type2_pari_delete", methods={"POST"})
     */
    public function delete(Request $request, Type2Pari $type2Pari): Response
    {
        if ($this->isCsrfTokenValid('delete'.$type2Pari->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($type2Pari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_type2_pari_index', [], Response::HTTP_SEE_OTHER);
    }
}

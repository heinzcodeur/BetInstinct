<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\TypePari;
use App\Form\BetInstinct\TypePariType;
use App\Repository\BetInstinct\TypePariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/type/pari")
 */
class TypePariController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_type_pari_index", methods={"GET"})
     */
    public function index(TypePariRepository $typePariRepository): Response
    {
        return $this->render('bet_instinct/type_pari/index.html.twig', [
            'type_paris' => $typePariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_type_pari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typePari = new TypePari();
        $form = $this->createForm(TypePariType::class, $typePari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typePari);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_type_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/type_pari/new.html.twig', [
            'type_pari' => $typePari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_type_pari_show", methods={"GET"})
     */
    public function show(TypePari $typePari): Response
    {
        return $this->render('bet_instinct/type_pari/show.html.twig', [
            'type_pari' => $typePari,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_type_pari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypePari $typePari): Response
    {
        $form = $this->createForm(TypePariType::class, $typePari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_type_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/type_pari/edit.html.twig', [
            'type_pari' => $typePari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_type_pari_delete", methods={"POST"})
     */
    public function delete(Request $request, TypePari $typePari): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typePari->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typePari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_type_pari_index', [], Response::HTTP_SEE_OTHER);
    }
}

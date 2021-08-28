<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Type2choix;
use App\Form\BetInstinct\Type2choixType;
use App\Repository\BetInstinct\Type2choixRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/type2choix")
 */
class Type2choixController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_type2choix_index", methods={"GET"})
     */
    public function index(Type2choixRepository $type2choixRepository): Response
    {
        return $this->render('bet_instinct/type2choix/index.html.twig', [
            'type2choixes' => $type2choixRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_type2choix_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $type2choix = new Type2choix();
        $form = $this->createForm(Type2choixType::class, $type2choix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($type2choix);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_type2choix_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/type2choix/new.html.twig', [
            'type2choix' => $type2choix,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_type2choix_show", methods={"GET"})
     */
    public function show(Type2choix $type2choix): Response
    {
        return $this->render('bet_instinct/type2choix/show.html.twig', [
            'type2choix' => $type2choix,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_type2choix_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Type2choix $type2choix): Response
    {
        $form = $this->createForm(Type2choixType::class, $type2choix);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_type2choix_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/type2choix/edit.html.twig', [
            'type2choix' => $type2choix,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_type2choix_delete", methods={"POST"})
     */
    public function delete(Request $request, Type2choix $type2choix): Response
    {
        if ($this->isCsrfTokenValid('delete'.$type2choix->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($type2choix);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_type2choix_index', [], Response::HTTP_SEE_OTHER);
    }
}

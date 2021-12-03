<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Type2choix;
use App\Entity\BetInstinct\TypedePari;
use App\Form\BetInstinct\TypedePariType;
use App\Repository\BetInstinct\TypedePariRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/typede/pari")
 */
class TypedePariController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_typede_pari_index", methods={"GET"})
     */
    public function index(TypedePariRepository $typedePariRepository): Response
    {
        return $this->render('bet_instinct/typede_pari/index.html.twig', [
            'typede_paris' => $typedePariRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_typede_pari_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typedePari = new TypedePari();
        $form = $this->createForm(TypedePariType::class, $typedePari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $t = $this->getDoctrine()->getRepository(TypedePari::class)->findBy(['type2choix' => $typedePari->getType2choix()]);
            if (count($t) > 0) {
                $this->addFlash('danger', 'type de Pari déjà enregistré!');
                return $this->renderForm('bet_instinct/typede_pari/new.html.twig', [
                    'typedepari' => $typedePari,
                    'form' => $form,
                ]);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typedePari);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_typede_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/typede_pari/new.html.twig', [
            'typede_pari' => $typedePari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_typede_pari_show", methods={"GET"})
     */
    public function show(TypedePari $typedePari): Response
    {
        return $this->render('bet_instinct/typede_pari/show.html.twig', [
            'typede_pari' => $typedePari,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_typede_pari_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypedePari $typedePari): Response
    {
        $form = $this->createForm(TypedePariType::class, $typedePari);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_typede_pari_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/typede_pari/edit.html.twig', [
            'typede_pari' => $typedePari,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_typede_pari_delete", methods={"POST"})
     */
    public function delete(Request $request, TypedePari $typedePari): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typedePari->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typedePari);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_typede_pari_index', [], Response::HTTP_SEE_OTHER);
    }
}

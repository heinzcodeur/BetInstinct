<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Classement;
use App\Form\BetInstinct\ClassementType;
use App\Repository\BetInstinct\ClassementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/classement")
 */
class ClassementController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_classement_index", methods={"GET"})
     */
    public function index(ClassementRepository $classementRepository, EntityManagerInterface $entityManager): Response
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('c')
            ->from(Classement::class, 'c')
            ->orderBy('c.id','DESC');

        $query = $queryBuilder->getQuery();
        return $this->render('bet_instinct/classement/index.html.twig', [
            'classements' => $query->getResult(),
        ]);
    }

    /**
     * @Route("/new/{id}", name="bet_instinct_classement_new", methods={"GET","POST"})
     */
    public function new($id = null, Request $request): Response
    {
        if ($id != null) {
            $athlete = $this->getDoctrine()->getRepository(Athlete::class)->find($id);
        }
        $classement = new Classement();
        $form = $this->createForm(ClassementType::class, $classement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(isset($athlete)){
                if ($classement->getJoueur() == null) {
                    $classement->setJoueur($athlete);
                }
            }//dd($classement);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($classement);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_classement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/classement/new.html.twig', [
            'classement' => $classement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_classement_show", methods={"GET"})
     */
    public function show(Classement $classement): Response
    {
        return $this->render('bet_instinct/classement/show.html.twig', [
            'classement' => $classement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_classement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Classement $classement): Response
    {
        //$joueurTemp=new Joueur();
        //$classement->getJoueur()->setRanking($rankingTemp);
        $form = $this->createForm(ClassementType::class, $classement);
        $form->handleRequest($request);
        $joueur = $classement->getJoueur();
        if ($form->isSubmitted() && $form->isValid()) {
            $classement->setJoueur($joueur);
            //dd($classement);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_classement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/classement/edit.html.twig', [
            'classement' => $classement,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_classement_delete", methods={"POST"})
     */
    public function delete(Request $request, Classement $classement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $classement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($classement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_classement_index', [], Response::HTTP_SEE_OTHER);
    }
}

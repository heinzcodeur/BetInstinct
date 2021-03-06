<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Affiche;
use App\Entity\BetInstinct\Tournoi;
use App\Form\BetInstinct\TournoiType;
use App\Repository\BetInstinct\TournoiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/tournoi")
 */
class TournoiController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_tournoi_index", methods={"GET"})
     */
    public function index(TournoiRepository $tournoiRepository, EntityManagerInterface $entityManager): Response
    {
        $queryB=$entityManager->createQueryBuilder();
        $query=$queryB->select('t')
            ->from(Tournoi::class, 't')
            ->orderBy('t.id','DESC');

        $queryF = $query->getQuery();

        return $this->render('bet_instinct/tournoi/index.html.twig', [
            'tournois' => $queryF->getResult()
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_tournoi_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tournoi = new Tournoi();
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($tournoi->getName()==null){$tournoi->setName($tournoi->getCity()->getName());}
            if($tournoi->getSport()==null) {
                $this->addFlash('info', 'choisissez un sport pour votre tournoi');
                return $this->renderForm('bet_instinct/tournoi/new.html.twig', [
                    'tournoi' => $tournoi,
                    'form' => $form,
                ]);
            }
            //dd($tournoi);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tournoi);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_tournoi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/tournoi/new.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_tournoi_show", methods={"GET"})
     */
    public function show(Tournoi $tournoi): Response
    {
        foreach($tournoi->getAffiches() as $a){
            dump($a);
        }

        return $this->render('bet_instinct/tournoi/show.html.twig', [
            'tournoi' => $tournoi,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_tournoi_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tournoi $tournoi): Response
    {
        $form = $this->createForm(TournoiType::class, $tournoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_tournoi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/tournoi/edit.html.twig', [
            'tournoi' => $tournoi,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_tournoi_delete", methods={"POST"})
     */
    public function delete(Request $request, Tournoi $tournoi): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tournoi->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tournoi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_tournoi_index', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\City;
use App\Entity\BetInstinct\Tournoi;
use App\Form\BetInstinct\CityType;
use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/city")
 */
class CityController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_city_index", methods={"GET"})
     */
    public function index(CityRepository $cityRepository): Response
    {
        return $this->render('bet_instinct/city/index.html.twig', [
            'cities' => $cityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{tournoiId}", name="bet_instinct_city_new", methods={"GET","POST"})
     */
    public function new(Request $request, $tournoiId=null): Response
    {
        $tournoi=null;
        if($tournoiId!=null){
            $tournoi = $this->getDoctrine()->getRepository(Tournoi::class)->find($tournoiId);
        }
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($city);
            $entityManager->flush();
            $tournoi->setCity($city);
            return $this->redirectToRoute('bet_instinct_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/city/new.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_city_show", methods={"GET"})
     */
    public function show(City $city): Response
    {
        return $this->render('bet_instinct/city/show.html.twig', [
            'city' => $city,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_city_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, City $city): Response
    {
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/city/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_city_delete", methods={"POST"})
     */
    public function delete(Request $request, City $city): Response
    {
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($city);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_city_index', [], Response::HTTP_SEE_OTHER);
    }
}

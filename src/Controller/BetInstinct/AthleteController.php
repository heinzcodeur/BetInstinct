<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Classement;
use App\Form\BetInstinct\AthleteType;
use App\Repository\BetInstinct\AthleteRepository;
use App\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/bet/instinct/athlete")
 */
class AthleteController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_athlete_index", methods={"GET"})
     */
    public function index(AthleteRepository $athleteRepository, EntityManagerInterface $entityManager): Response
    {

        $athletes=$athleteRepository->findAll();
        foreach($athletes as $athlete){
            if($athlete->getRanking()==NULL) {
                $ranking=new Classement();
                Service::createRanking($athlete,1,$ranking, $entityManager);
                dump($athlete);
            }
        }

        $queryBuilder=$entityManager->createQueryBuilder();
        $queryBuilder->select('a')
                    ->from(Athlete::class,'a')
                    //->where('a.ranking.association.name')
                    ->orderBy('a.id','DESC');



        return $this->render('bet_instinct/athlete/index.html.twig', [
            //'athletes' => $queryBuilder->getQuery()->getResult()
            'athletes' => $queryBuilder->getQuery()->getResult()
        ]);
    }

    /**
     * @Route("/new/{ranking}", name="bet_instinct_athlete_new", methods={"GET","POST"})
     */
    public function new($ranking=null, Request $request, AthleteRepository $athleteRepository): Response
    {
        $athlete = new Athlete();
        $form = $this->createForm(AthleteType::class, $athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if(is_array(Service::checkAthlete($athlete,$athleteRepository)) && count(Service::checkAthlete($athlete,$athleteRepository))>0) {
                $this->addFlash('danger', 'athlete deja inscrit');
                return self::renderForm('bet_instinct/athlete/new.html.twig', [
                    'athlete' => $athlete,
                    'form' => $form]);
            }
            if ($form->get('avatar')->getData() != null) {
                $avatar = $form->get('avatar')->getData();
                $fichier = md5(uniqid()) . '.' . $avatar->guessExtension();
                $avatar->move($this->getParameter('images_athletes'), $fichier);
                $athlete->setAvatar($fichier);
            }
            $em=$this->getDoctrine()->getManager('betInstinct');
            $em->persist($athlete);
            $em->flush();

            if($athlete->getRanking()==null){
                return $this->redirectToRoute('bet_instinct_classement_new',['id'=>$athlete->getId()] );
            }

            return $this->redirectToRoute('bet_instinct_athlete_show', ['id'=>$athlete->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/athlete/new.html.twig', [
            'athlete' => $athlete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_athlete_show", methods={"GET"})
     */
    public function show(Athlete $athlete): Response
    {
        dump($athlete->getRanking());
        return $this->render('bet_instinct/athlete/show.html.twig', [
            'athlete' => $athlete,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_athlete_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Athlete $athlete): Response
    {
        $form = $this->createForm(AthleteType::class, $athlete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('avatar')->getData() != null) {

                $avatar = $form->get('avatar')->getData();//dd($avatar);
                // dd($avatar->guessExtension());
                $fichier = md5(uniqid()) . '.' . $avatar->guessExtension();
                $avatar->move($this->getParameter('images_athletes'), $fichier);
                $athlete->setAvatar($fichier);
            }
                $em = $this->getDoctrine()->getManager('betInstinct');
                $em->persist($athlete);
                $em->flush();
            return $this->redirectToRoute('bet_instinct_athlete_show', ['id'=>$athlete->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/athlete/edit.html.twig', [
            'athlete' => $athlete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_athlete_delete", methods={"POST"})
     */
    public function delete(Request $request, Athlete $athlete): Response
    {
        if ($this->isCsrfTokenValid('delete'.$athlete->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($athlete);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_athlete_index', [], Response::HTTP_SEE_OTHER);
    }
}

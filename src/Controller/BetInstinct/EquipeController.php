<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Association;
use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Equipe;
use App\Entity\BetInstinct\Pays;
use App\Form\BetInstinct\EquipeType;
use App\Repository\BetInstinct\ClassementRepository;
use App\Repository\BetInstinct\EquipeRepository;
use App\Service;
use Doctrine\ORM\EntityManagerInterface;
use Proxies\__CG__\App\Entity\BetInstinct\Classement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/equipe")
 */
class EquipeController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_equipe_index", methods={"GET"})
     */
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('bet_instinct/equipe/index.html.twig', [
            'equipes' => $equipeRepository->equipeAllIdDEsc()
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_equipe_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $equipe = new Equipe();
        $athlete = new Athlete();
        //recuperation du dernier ID insere dans la tabe classement

        $form = $this->createForm(EquipeType::class, $equipe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $t = $this->getDoctrine()->getRepository(Equipe::class)->findBy(['name' => $equipe->getName()]);
            if (count($t) > 0) {
                $this->addFlash('danger', 'Team déjà inscrite!');
                return $this->renderForm('bet_instinct/equipe/new.html.twig', [
                    'equipe' => $equipe,
                    'form' => $form,
                ]);
            }

            if ($equipe->getPays() == null) {
                $pays = new Pays();
                $pays->setName($equipe->getName());
                $pays->setShortcut(strtoupper(substr($pays->getName(), 0, 3)));
                $equipe->setPays($pays);
            }

            $athlete->setNom($equipe->getName());
            $athlete->setPrenom($equipe->getTournoi()->getName());
            $athlete->setBirthdate(new  \DateTime('1900-01-01 00:00:00'));
            $athlete->setPays($equipe->getPays());
            $athlete->setTaille(1.75);

            $entityManager = $this->getDoctrine()->getManager();
            //$asso = new Association();
            $asso = $this->getDoctrine()->getRepository(Association::class)->findOneBy(['name'=>'FIBA']);
            //$asso->setName('FIBA');
            $ranking = Service::createRanking($athlete, $asso->getId(), $entityManager);

            if (isset($pays)) {
                $entityManager->persist($pays);
            }


            $entityManager->persist($equipe);
            $entityManager->persist($athlete);
            $entityManager->persist($ranking);
            $entityManager->flush();

            $this->addFlash('success', 'nouvelle équipe ' . $equipe->getName());

            return $this->redirectToRoute('bet_instinct_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/equipe/new.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_equipe_show", methods={"GET"})
     */
    public function show(Equipe $equipe): Response
    {
        return $this->render('bet_instinct/equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_equipe_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Equipe $equipe): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $checkatl=$this->getDoctrine()->getRepository(Athlete::class)->findBy(['nom'=>$equipe->getName()]);
            if(count($checkatl)==0){
            $athlete=new Athlete();
            $athlete->setNom($equipe->getName());
            $athlete->setPrenom($equipe->getTournoi()->getName());
            $athlete->setBirthdate(new  \DateTime('1900-01-01 00:00:00'));
            $athlete->setPays($equipe->getPays());
            $athlete->setTaille(1.75);
            $this->getDoctrine()->getManager()->persist($athlete);
            }


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_equipe_delete", methods={"POST"})
     */
    public function delete(Request $request, Equipe $equipe): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($equipe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_equipe_index', [], Response::HTTP_SEE_OTHER);
    }

    static function LastId()
    {

        //$classement=$classementRepository->findOneBy([],['id'=>'DESC']);
        //return $classement->getRanking();
    }
}

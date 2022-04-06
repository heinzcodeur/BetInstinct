<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\User;
use App\Form\BetInstinct\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('bet_instinct/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_user_new", methods={"GET","POST"})
     */
   /* public function new(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }*/

    /**
     * @Route("/{id}", name="bet_instinct_user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        dump($user);
        return $this->render('bet_instinct/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserTlype::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_user_index', [], Response::HTTP_SEE_OTHER);
        }
        //dd($user);

        return $this->renderForm('bet_instinct/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_user_index', [], Response::HTTP_SEE_OTHER);
    }
}

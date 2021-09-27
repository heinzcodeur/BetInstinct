<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Bankroll;
use App\Entity\BetInstinct\Game;
use App\Entity\BetInstinct\Transaction;
use App\Form\BetInstinct\TransactionType;
use App\Repository\BetInstinct\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @Route("/bet/instinct/transaction")
 */
class TransactionController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_transaction_index", methods={"GET"})
     */
    public function index(TransactionRepository $transactionRepository, EntityManagerInterface $em): Response
    {
        $query=$em->createQueryBuilder();
        $query->select('t')
            ->from(Transaction::class,'t')
            ->orderBy('t.id','DESC');
        $transacs= $query->getQuery()->getResult();


        return $this->render('bet_instinct/transaction/index.html.twig', [
            'transactions' => $transacs,
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_transaction_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $transaction = new Transaction();
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $transaction->setAuteur($this->getUser());
            $transaction->setCreatedAt(new \DateTimeImmutable());

            if($transaction->getType()==1){
            $bankrollTab=$this->getDoctrine()->getRepository(Bankroll::class)->findBy(['owner'=>$this->getUser()->getId()]);
            $bankroll=$bankrollTab[0];
            $solde = $bankroll->getBalance();
            $bankroll->setBalance($transaction->getMontant()+$solde);
            //dd($bankroll);
                $entityManager->persist($bankroll);
                $entityManager->flush();
            }

            $entityManager->persist($transaction);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/transaction/new.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_transaction_show", methods={"GET"})
     */
    public function show(Transaction $transaction): Response
    {
        dump($transaction);
        return $this->render('bet_instinct/transaction/show.html.twig', [
            'transaction' => $transaction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_transaction_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Transaction $transaction): Response
    {
        $form = $this->createForm(TransactionType::class, $transaction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_transaction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/transaction/edit.html.twig', [
            'transaction' => $transaction,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_transaction_delete", methods={"POST"})
     */
    public function delete(Request $request, Transaction $transaction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$transaction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($transaction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_transaction_index', [], Response::HTTP_SEE_OTHER);
    }
}

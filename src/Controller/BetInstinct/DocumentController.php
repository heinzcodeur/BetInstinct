<?php

namespace App\Controller\BetInstinct;

use App\Entity\BetInstinct\Athlete;
use App\Entity\BetInstinct\Document;
use App\Form\BetInstinct\DocumentType;
use App\Repository\DocumentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bet/instinct/document")
 */
class DocumentController extends AbstractController
{
    /**
     * @Route("/", name="bet_instinct_document_index", methods={"GET"})
     */
    public function index(DocumentRepository $documentRepository): Response
    {
        return $this->render('bet_instinct/document/index.html.twig', [
            'documents' => $documentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bet_instinct_document_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        mkdir('images/titi');
        $document = new Document();
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);
        $athlete=$this->getDoctrine()->getRepository(Athlete::class)->find(19);
        //dd($athlete);
        if ($form->isSubmitted() && $form->isValid()) {

            dd($form->get('athlete')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($document);
            $entityManager->flush();

            return $this->redirectToRoute('bet_instinct_document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/document/new.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_document_show", methods={"GET"})
     */
    public function show(Document $document): Response
    {
        return $this->render('bet_instinct/document/show.html.twig', [
            'document' => $document,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bet_instinct_document_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bet_instinct_document_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bet_instinct/document/edit.html.twig', [
            'document' => $document,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="bet_instinct_document_delete", methods={"POST"})
     */
    public function delete(Request $request, Document $document): Response
    {
        if ($this->isCsrfTokenValid('delete'.$document->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($document);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bet_instinct_document_index', [], Response::HTTP_SEE_OTHER);
    }
}

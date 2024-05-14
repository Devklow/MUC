<?php

namespace App\Controller;

use App\Entity\Quete;
use App\Form\QueteType;
use App\Repository\QueteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quete", name="quete_")
 */
class QueteController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(QueteRepository $queteRepository): Response
    {
        return $this->render('quete/index.html.twig', [
            'quetes' => $queteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, QueteRepository $queteRepository): Response
    {
        $quete = new Quete();
        $form = $this->createForm(QueteType::class, $quete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $queteRepository->add($quete, true);

            return $this->redirectToRoute('quete_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quete/new.html.twig', [
            'quete' => $quete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(Quete $quete): Response
    {
        return $this->render('quete/show.html.twig', [
            'quete' => $quete,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Quete $quete, QueteRepository $queteRepository): Response
    {
        $form = $this->createForm(QueteType::class, $quete);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $queteRepository->add($quete, true);

            return $this->redirectToRoute('quete_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('quete/edit.html.twig', [
            'quete' => $quete,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, Quete $quete, QueteRepository $queteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quete->getId(), $request->request->get('_token'))) {
            $queteRepository->remove($quete, true);
        }

        return $this->redirectToRoute('quete_liste', [], Response::HTTP_SEE_OTHER);
    }
}

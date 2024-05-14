<?php

namespace App\Controller;

use App\Entity\Sort;
use App\Form\SortType;
use App\Repository\SortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sort", name="sort_")
 */
class SortController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(SortRepository $sortRepository): Response
    {
        return $this->render('sort/index.html.twig', [
            'sorts' => $sortRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, SortRepository $sortRepository): Response
    {
        $sort = new Sort();
        $form = $this->createForm(SortType::class, $sort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sortRepository->add($sort, true);

            return $this->redirectToRoute('sort_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sort/new.html.twig', [
            'sort' => $sort,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(Sort $sort): Response
    {
        return $this->render('sort/show.html.twig', [
            'sort' => $sort,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Sort $sort, SortRepository $sortRepository): Response
    {
        $form = $this->createForm(SortType::class, $sort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sortRepository->add($sort, true);

            return $this->redirectToRoute('sort_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sort/edit.html.twig', [
            'sort' => $sort,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, Sort $sort, SortRepository $sortRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sort->getId(), $request->request->get('_token'))) {
            $sortRepository->remove($sort, true);
        }

        return $this->redirectToRoute('sort_liste', [], Response::HTTP_SEE_OTHER);
    }
}

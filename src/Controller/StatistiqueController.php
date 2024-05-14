<?php

namespace App\Controller;

use App\Entity\Statistique;
use App\Form\StatistiqueType;
use App\Repository\StatistiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/statistique", name="statistique_")
 */
class StatistiqueController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(StatistiqueRepository $statistiqueRepository): Response
    {
        return $this->render('statistique/index.html.twig', [
            'statistiques' => $statistiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, StatistiqueRepository $statistiqueRepository): Response
    {
        $statistique = new Statistique();
        $form = $this->createForm(StatistiqueType::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statistiqueRepository->add($statistique, true);

            return $this->redirectToRoute('statistique_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statistique/new.html.twig', [
            'statistique' => $statistique,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(Statistique $statistique): Response
    {
        return $this->render('statistique/show.html.twig', [
            'statistique' => $statistique,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Statistique $statistique, StatistiqueRepository $statistiqueRepository): Response
    {
        $form = $this->createForm(StatistiqueType::class, $statistique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $statistiqueRepository->add($statistique, true);

            return $this->redirectToRoute('statistique_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('statistique/edit.html.twig', [
            'statistique' => $statistique,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, Statistique $statistique, StatistiqueRepository $statistiqueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$statistique->getId(), $request->request->get('_token'))) {
            $statistiqueRepository->remove($statistique, true);
        }

        return $this->redirectToRoute('statistique_liste', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Monstre;
use App\Form\MonstreType;
use App\Repository\MonstreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/monstre", name="monstre_")
 */
class MonstreController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(MonstreRepository $monstreRepository): Response
    {
        return $this->render('monstre/index.html.twig', [
            'monstres' => $monstreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, MonstreRepository $monstreRepository): Response
    {
        $monstre = new Monstre();
        $form = $this->createForm(MonstreType::class, $monstre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monstreRepository->add($monstre, true);

            return $this->redirectToRoute('monstre_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monstre/new.html.twig', [
            'monstre' => $monstre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(Monstre $monstre): Response
    {
        return $this->render('monstre/show.html.twig', [
            'monstre' => $monstre,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Monstre $monstre, MonstreRepository $monstreRepository): Response
    {
        $form = $this->createForm(MonstreType::class, $monstre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $monstreRepository->add($monstre, true);

            return $this->redirectToRoute('monstre_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('monstre/edit.html.twig', [
            'monstre' => $monstre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, Monstre $monstre, MonstreRepository $monstreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monstre->getId(), $request->request->get('_token'))) {
            $monstreRepository->remove($monstre, true);
        }

        return $this->redirectToRoute('monstre_liste', [], Response::HTTP_SEE_OTHER);
    }
}

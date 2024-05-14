<?php

namespace App\Controller;

use App\Entity\Caracteristique;
use App\Form\CaracteristiqueType;
use App\Repository\CaracteristiqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/caracteristique", name="caracteristique_")
 */
class CaracteristiqueController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(CaracteristiqueRepository $caracteristiqueRepository): Response
    {
        return $this->render('caracteristique/index.html.twig', [
            'caracteristiques' => $caracteristiqueRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, CaracteristiqueRepository $caracteristiqueRepository): Response
    {
        $caracteristique = new Caracteristique();
        $form = $this->createForm(CaracteristiqueType::class, $caracteristique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $caracteristiqueRepository->add($caracteristique, true);

            return $this->redirectToRoute('caracteristique_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('caracteristique/new.html.twig', [
            'caracteristique' => $caracteristique,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(Caracteristique $caracteristique): Response
    {
        return $this->render('caracteristique/show.html.twig', [
            'caracteristique' => $caracteristique,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Caracteristique $caracteristique, CaracteristiqueRepository $caracteristiqueRepository): Response
    {
        $form = $this->createForm(CaracteristiqueType::class, $caracteristique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $caracteristiqueRepository->add($caracteristique, true);

            return $this->redirectToRoute('caracteristique_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('caracteristique/edit.html.twig', [
            'caracteristique' => $caracteristique,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, Caracteristique $caracteristique, CaracteristiqueRepository $caracteristiqueRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caracteristique->getId(), $request->request->get('_token'))) {
            $caracteristiqueRepository->remove($caracteristique, true);
        }

        return $this->redirectToRoute('caracteristique_liste', [], Response::HTTP_SEE_OTHER);
    }
}

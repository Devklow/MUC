<?php

namespace App\Controller;

use App\Entity\LieuType;
use App\Form\LieuTypeType;
use App\Repository\LieuTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lieutype", name="lieu_type_")
 */
class LieuTypeController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(LieuTypeRepository $lieuTypeRepository): Response
    {
        return $this->render('lieu_type/index.html.twig', [
            'lieu_types' => $lieuTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, LieuTypeRepository $lieuTypeRepository): Response
    {
        $lieuType = new LieuType();
        $form = $this->createForm(LieuTypeType::class, $lieuType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lieuTypeRepository->add($lieuType, true);

            return $this->redirectToRoute('lieu_type_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lieu_type/new.html.twig', [
            'lieu_type' => $lieuType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(LieuType $lieuType): Response
    {
        return $this->render('lieu_type/show.html.twig', [
            'lieu_type' => $lieuType,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, LieuType $lieuType, LieuTypeRepository $lieuTypeRepository): Response
    {
        $form = $this->createForm(LieuTypeType::class, $lieuType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lieuTypeRepository->add($lieuType, true);

            return $this->redirectToRoute('lieu_type_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('lieu_type/edit.html.twig', [
            'lieu_type' => $lieuType,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, LieuType $lieuType, LieuTypeRepository $lieuTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lieuType->getId(), $request->request->get('_token'))) {
            $lieuTypeRepository->remove($lieuType, true);
        }

        return $this->redirectToRoute('lieu_type_liste', [], Response::HTTP_SEE_OTHER);
    }
}

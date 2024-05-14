<?php

namespace App\Controller;

use App\Entity\TypeAttribut;
use App\Form\TypeAttributType;
use App\Repository\TypeAttributRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/typeattribut", name="type_attribut_")
 */
class TypeAttributController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(TypeAttributRepository $typeAttributRepository): Response
    {
        return $this->render('type_attribut/index.html.twig', [
            'type_attributs' => $typeAttributRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, TypeAttributRepository $typeAttributRepository): Response
    {
        $typeAttribut = new TypeAttribut();
        $form = $this->createForm(TypeAttributType::class, $typeAttribut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeAttributRepository->add($typeAttribut, true);

            return $this->redirectToRoute('type_attribut_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_attribut/new.html.twig', [
            'type_attribut' => $typeAttribut,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(TypeAttribut $typeAttribut): Response
    {
        return $this->render('type_attribut/show.html.twig', [
            'type_attribut' => $typeAttribut,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeAttribut $typeAttribut, TypeAttributRepository $typeAttributRepository): Response
    {
        $form = $this->createForm(TypeAttributType::class, $typeAttribut);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeAttributRepository->add($typeAttribut, true);

            return $this->redirectToRoute('type_attribut_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_attribut/edit.html.twig', [
            'type_attribut' => $typeAttribut,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, TypeAttribut $typeAttribut, TypeAttributRepository $typeAttributRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeAttribut->getId(), $request->request->get('_token'))) {
            $typeAttributRepository->remove($typeAttribut, true);
        }

        return $this->redirectToRoute('type_attribut_liste', [], Response::HTTP_SEE_OTHER);
    }
}

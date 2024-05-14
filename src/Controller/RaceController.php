<?php

namespace App\Controller;

use App\Entity\Race;
use App\Form\RaceType;
use App\Repository\RaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/race", name="race_")
 */
class RaceController extends AbstractController
{
    /**
     * @Route("/", name="liste", methods={"GET"})
     */
    public function index(RaceRepository $raceRepository): Response
    {
        return $this->render('race/index.html.twig', [
            'races' => $raceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="nouveau", methods={"GET", "POST"})
     */
    public function new(Request $request, RaceRepository $raceRepository): Response
    {
        $race = new Race();
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raceRepository->add($race, true);

            return $this->redirectToRoute('race_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('race/new.html.twig', [
            'race' => $race,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/visualiser/{id}", name="visualiser", methods={"GET"})
     */
    public function show(Race $race): Response
    {
        return $this->render('race/show.html.twig', [
            'race' => $race,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier", methods={"GET", "POST"})
     */
    public function edit(Request $request, Race $race, RaceRepository $raceRepository): Response
    {
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raceRepository->add($race, true);

            return $this->redirectToRoute('race_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('race/edit.html.twig', [
            'race' => $race,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer", methods={"POST"})
     */
    public function delete(Request $request, Race $race, RaceRepository $raceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$race->getId(), $request->request->get('_token'))) {
            $raceRepository->remove($race, true);
        }

        return $this->redirectToRoute('race_liste', [], Response::HTTP_SEE_OTHER);
    }
}

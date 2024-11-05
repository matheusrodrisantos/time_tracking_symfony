<?php

namespace App\Controller;

use App\Entity\Vacation;
use App\Form\VacationType;
use App\Repository\VacationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/vacation')]
final class VacationController extends AbstractController
{
    #[Route(name: 'app_vacation_index', methods: ['GET'])]
    public function index(VacationRepository $vacationRepository): Response
    {
        return $this->render('vacation/index.html.twig', [
            'vacations' => $vacationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_vacation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vacation = new Vacation();
        $form = $this->createForm(VacationType::class, $vacation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($vacation);
            $entityManager->flush();

            return $this->redirectToRoute('app_vacation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vacation/new.html.twig', [
            'vacation' => $vacation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vacation_show', methods: ['GET'])]
    public function show(Vacation $vacation): Response
    {
        return $this->render('vacation/show.html.twig', [
            'vacation' => $vacation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_vacation_edit', methods: ['PUT'])]
    public function edit(Request $request, Vacation $vacation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VacationType::class, $vacation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_vacation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('vacation/edit.html.twig', [
            'vacation' => $vacation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_vacation_delete', methods: ['DELETE'])]
    public function delete(Request $request, Vacation $vacation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vacation->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($vacation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_vacation_index', [], Response::HTTP_SEE_OTHER);
    }
}

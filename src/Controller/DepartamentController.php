<?php

namespace App\Controller;

use App\Entity\Departament;
use App\Form\DepartamentType;
use App\Repository\DepartamentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/departament')]
final class DepartamentController extends AbstractController
{
    #[Route(name: 'app_departament_index', methods: ['GET'])]
    public function index(DepartamentRepository $departamentRepository): Response
    {
        return $this->render('departament/index.html.twig', [
            'departaments' => $departamentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_departament_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $departament = new Departament();
        $form = $this->createForm(DepartamentType::class, $departament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($departament);
            $entityManager->flush();

            return $this->redirectToRoute('app_departament_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('departament/new.html.twig', [
            'departament' => $departament,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_departament_show', methods: ['GET'])]
    public function show(Departament $departament): Response
    {
        return $this->render('departament/show.html.twig', [
            'departament' => $departament,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_departament_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Departament $departament, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DepartamentType::class, $departament);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_departament_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('departament/edit.html.twig', [
            'departament' => $departament,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_departament_delete', methods: ['POST'])]
    public function delete(Request $request, Departament $departament, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departament->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($departament);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_departament_index', [], Response::HTTP_SEE_OTHER);
    }
}

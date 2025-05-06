<?php

namespace App\Controller;

use App\Entity\RepairPart;
use App\Form\RepairPartForm;
use App\Repository\RepairPartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/repair/part')]
final class RepairPartController extends AbstractController
{
    #[Route(name: 'app_repair_part_index', methods: ['GET'])]
    public function index(RepairPartRepository $repairPartRepository): Response
    {
        return $this->render('repair_part/index.html.twig', [
            'repair_parts' => $repairPartRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_repair_part_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repairPart = new RepairPart();
        $form = $this->createForm(RepairPartForm::class, $repairPart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($repairPart);
            $entityManager->flush();

            return $this->redirectToRoute('app_repair_part_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('repair_part/new.html.twig', [
            'repair_part' => $repairPart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_repair_part_show', methods: ['GET'])]
    public function show(RepairPart $repairPart): Response
    {
        return $this->render('repair_part/show.html.twig', [
            'repair_part' => $repairPart,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_repair_part_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RepairPart $repairPart, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RepairPartForm::class, $repairPart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_repair_part_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('repair_part/edit.html.twig', [
            'repair_part' => $repairPart,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_repair_part_delete', methods: ['POST'])]
    public function delete(Request $request, RepairPart $repairPart, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$repairPart->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($repairPart);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_repair_part_index', [], Response::HTTP_SEE_OTHER);
    }
}

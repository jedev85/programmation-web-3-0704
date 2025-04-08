<?php

namespace App\Controller;

use App\Entity\Soigneur;
use App\Form\SoigneurType;
use App\Repository\SoigneurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class SoigneurController extends AbstractController
{
    public function __construct(
        private readonly SoigneurRepository $soigneurRepository,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    #[Route('/soigneur', name: 'app_soigneur_index', methods: ['GET'])]
    public function index(): Response
    {
        $soigneurs = $this->soigneurRepository->findAll();

        return $this->render('soigneur/index.html.twig', [
            'soigneurs' => $soigneurs,
        ]);
    }

    #[isGranted('ROLE_ADMIN')]
    #[Route('/soigneur/add', name: 'soigneur_add')]
    public function add(Request $request): Response
    {
        $soigneur = new Soigneur();
        $form = $this->createForm(SoigneurType::class, $soigneur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $soigneur = $form->getData();

            $this->entityManager->persist($soigneur);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_soigneur_index');
        }

        return $this->render('form/add_or_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/soigneur/{id}/edit', name: 'soigneur_edit')]
    public function edit(Request $request): Response
    {
        $soigneur = $this->soigneurRepository->find($request->get('id'));

        if (null === $soigneur) {
            return $this->redirectToRoute('app_soigneur_index');
        }

        $form = $this->createForm(SoigneurType::class, $soigneur);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $soigneur = $form->getData();

            $this->entityManager->persist($soigneur);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_soigneur_index');
        }

        return $this->render('form/add_or_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

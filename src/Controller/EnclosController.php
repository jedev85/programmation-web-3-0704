<?php

namespace App\Controller;

use App\Entity\Enclos;
use App\Form\EnclosType;
use App\Repository\EnclosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EnclosController extends AbstractController
{
    public function __construct(private readonly EnclosRepository $enclosRepository, private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('/enclos', name: 'app_enclos_index', methods: ['GET'])]
    public function index(Request $request): Response
    {
        $enclos = $this->enclosRepository->findAll();
        if ($request->get('search')){
            $enclos = $this->enclosRepository->findBy(['nom' => $request->get('search')]);
        }

        return $this->render('enclos/index.html.twig', [
            'enclos' => $enclos,
        ]);
    }

    #[Route('/enclos/add', name: 'enclos_add')]
    public function add(Request $request): Response
    {
        $enclos = new Enclos();
        $form = $this->createForm(EnclosType::class, $enclos);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $enclos = $form->getData();

            $this->entityManager->persist($enclos);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_enclos_index');
        }

        return $this->render('form/add_or_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/enclos/{id}/edit', name: 'enclos_edit')]
    public function edit(Request $request): Response
    {
        $enclos = $this->enclosRepository->find($request->get('id'));

        if (null === $enclos) {
            return $this->redirectToRoute('app_enclos_index');
        }

        $form = $this->createForm(EnclosType::class, $enclos);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $enclos = $form->getData();

            $this->entityManager->persist($enclos);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_enclos_index');
        }

        return $this->render('form/add_or_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

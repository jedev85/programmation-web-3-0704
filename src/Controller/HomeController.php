<?php

namespace App\Controller;

use App\Entity\Pingouin;
use App\Form\PingouinType;
use App\Repository\PingouinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    public function __construct(
        private readonly PingouinRepository $pingouinRepository,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $pingouins = $this->pingouinRepository->findAll();

        return $this->render('home/index.html.twig', [
            'pingouins' => $pingouins,
        ]);
    }

    #[Route('/pingouin/add', name: 'pingouin_add')]
    public function add(Request $request): Response
    {
        $pingouin = new Pingouin();
        $form = $this->createForm(PingouinType::class, $pingouin);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pingouin = $form->getData();

            $this->entityManager->persist($pingouin);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/add_or_edit_pingouin.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/pingouin/{id}/edit', name: 'pingouin_edit')]
    public function edit(Request $request): Response
    {
        $pingouin = $this->pingouinRepository->find($request->get('id'));

        if (null === $pingouin) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(PingouinType::class, $pingouin);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pingouin = $form->getData();

            $this->entityManager->persist($pingouin);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('home/add_or_edit_pingouin.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

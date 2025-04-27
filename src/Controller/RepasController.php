<?php

namespace App\Controller;

use App\Entity\Pingouin;
use App\Entity\Repas;
use App\Form\RepasType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RepasController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    #[Route('/repas/add', name: 'repas_add')]
    public function add(Request $request): Response
    {
        $repas = new Repas();
        if ($request->get('pingouin_id')){
            $pingouin = $this->entityManager->getRepository(Pingouin::class)->find($request->get('pingouin_id'));
            if ($pingouin){
                $repas->setPingouin($pingouin);
            }
        }
        $form = $this->createForm(RepasType::class, $repas);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repas = $form->getData();

            $this->entityManager->persist($repas);
            $this->entityManager->flush();

            return $this->redirectToRoute('pingouin_show', ['id' => $repas->getPingouin()->getId()]);
        }

        return $this->render('form/add_or_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/repas/{id}/edit', name: 'repas_edit')]
    public function edit(Request $request): Response
    {
        $repas = $this->entityManager->getRepository(Repas::class)->find($request->get('id'));

        if (null === $repas) {
            return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(RepasType::class, $repas);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repas = $form->getData();

            $this->entityManager->persist($repas);
            $this->entityManager->flush();

            return $this->redirectToRoute('pingouin_show', ['id' => $repas->getPingouin()->getId()]);
        }

        return $this->render('form/add_or_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

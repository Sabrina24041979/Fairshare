<?php

namespace App\Controller;

use App\Entity\MemberGroup;
use App\Form\MemberGroupType;
use App\Repository\MemberGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/member/group')]
class MemberGroupController extends AbstractController
{
    #[Route('/', name: 'app_member_group_index', methods: ['GET'])]
    public function index(MemberGroupRepository $memberGroupRepository): Response
    {
        return $this->render('member_group/index.html.twig', [
            'member_groups' => $memberGroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_member_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $memberGroup = new MemberGroup();
        $form = $this->createForm(MemberGroupType::class, $memberGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($memberGroup);
            $entityManager->flush();

            return $this->redirectToRoute('app_member_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('member_group/new.html.twig', [
            'member_group' => $memberGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_member_group_show', methods: ['GET'])]
    public function show(MemberGroup $memberGroup): Response
    {
        return $this->render('member_group/show.html.twig', [
            'member_group' => $memberGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_member_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MemberGroup $memberGroup, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MemberGroupType::class, $memberGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_member_group_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('member_group/edit.html.twig', [
            'member_group' => $memberGroup,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_member_group_delete', methods: ['POST'])]
    public function delete(Request $request, MemberGroup $memberGroup, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$memberGroup->getId(), $request->request->get('_token'))) {
            $entityManager->remove($memberGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_member_group_index', [], Response::HTTP_SEE_OTHER);
    }
}

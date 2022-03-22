<?php

namespace App\Controller;

use App\Entity\TypesRepas;
use App\Form\TypesRepasType;
use App\Repository\TypesRepasRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_SUPERADMIN')")
 * @Route("/admin/repas")
 */
class CrudRepasController extends AbstractController
{
    /**
     * @Route("/", name="app_crud_repas_index", methods={"GET"})
     */
    public function index(TypesRepasRepository $typesRepasRepository): Response
    {
        return $this->render('crud_repas/index.html.twig', [
            'types_repas' => $typesRepasRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_crud_repas_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypesRepasRepository $typesRepasRepository): Response
    {
        $typesRepa = new TypesRepas();
        $form = $this->createForm(TypesRepasType::class, $typesRepa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesRepasRepository->add($typesRepa);
            return $this->redirectToRoute('app_crud_repas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_repas/new.html.twig', [
            'types_repa' => $typesRepa,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_crud_repas_show", methods={"GET"})
     */
    public function show(TypesRepas $typesRepa): Response
    {
        return $this->render('crud_repas/show.html.twig', [
            'types_repa' => $typesRepa,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_crud_repas_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypesRepas $typesRepa, TypesRepasRepository $typesRepasRepository): Response
    {
        $form = $this->createForm(TypesRepasType::class, $typesRepa);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesRepasRepository->add($typesRepa);
            return $this->redirectToRoute('app_crud_repas_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_repas/edit.html.twig', [
            'types_repa' => $typesRepa,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_crud_repas_delete", methods={"POST"})
     */
    public function delete(Request $request, TypesRepas $typesRepa, TypesRepasRepository $typesRepasRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesRepa->getId(), $request->request->get('_token'))) {
            $typesRepasRepository->remove($typesRepa);
        }

        return $this->redirectToRoute('app_crud_repas_index', [], Response::HTTP_SEE_OTHER);
    }
}

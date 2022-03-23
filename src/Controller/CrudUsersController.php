<?php

namespace App\Controller;

use App\Entity\TypesUsers;
use App\Form\TypesUsersType;
use App\Repository\TypesUsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_SUPERADMIN')")
 * @Route("/admin/users")
 */
class CrudUsersController extends AbstractController
{
    /**
     * @Route("/", name="app_crud_users_index", methods={"GET"})
     */
    public function index(TypesUsersRepository $typesUsersRepository): Response
    {
        return $this->render('crud_users/index.html.twig', [
            'types_users' => $typesUsersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_crud_users_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypesUsersRepository $typesUsersRepository): Response
    {
        $typesUser = new TypesUsers();
        $form = $this->createForm(TypesUsersType::class, $typesUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesUsersRepository->add($typesUser);
            return $this->redirectToRoute('app_crud_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_users/new.html.twig', [
            'types_user' => $typesUser,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_crud_users_show", methods={"GET"})
     */
    public function show(TypesUsers $typesUser): Response
    {
        return $this->render('crud_users/show.html.twig', [
            'types_user' => $typesUser,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_crud_users_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypesUsers $typesUser, TypesUsersRepository $typesUsersRepository): Response
    {
        $form = $this->createForm(TypesUsersType::class, $typesUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesUsersRepository->add($typesUser);
            return $this->redirectToRoute('app_crud_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_users/edit.html.twig', [
            'types_user' => $typesUser,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_crud_users_delete", methods={"POST"})
     */
    public function delete(Request $request, TypesUsers $typesUser, TypesUsersRepository $typesUsersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesUser->getId(), $request->request->get('_token'))) {
            $typesUsersRepository->remove($typesUser);
        }

        return $this->redirectToRoute('app_crud_users_index', [], Response::HTTP_SEE_OTHER);
    }
}

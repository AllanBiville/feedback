<?php

namespace App\Controller;

use App\Entity\TypesCategories;
use App\Form\TypesCategoriesType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypesCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_SUPERADMIN')")
 * @Route("/admin/categories")
 */
class CrudCategoriesController extends AbstractController
{
    /**
     * @Route("/", name="app_crud_categories_index", methods={"GET"})
     */
    public function index(TypesCategoriesRepository $typesCategoriesRepository): Response
    {
        return $this->render('crud_categories/index.html.twig', [
            'types_categories' => $typesCategoriesRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}/changeStatus", name="app_crud_changestatus", methods={"GET", "POST"})
     */
    public function changeStatus(Request $request, TypesCategories $typesCategory, EntityManagerInterface $entityManager): Response
    {
      
        $status = $typesCategory->getStatut();
        
        if ($status == "1"){
            $typesCategory->setStatut(0);
        } else {
            $typesCategory->setStatut(1);
        }
        

        $entityManager->flush();

        return $this->redirectToRoute('app_crud_categories_index', [], Response::HTTP_SEE_OTHER);
        

    }
    /**
     * @Route("/new", name="app_crud_categories_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypesCategoriesRepository $typesCategoriesRepository): Response
    {
        $typesCategory = new TypesCategories();
        $form = $this->createForm(TypesCategoriesType::class, $typesCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesCategoriesRepository->add($typesCategory);
            return $this->redirectToRoute('app_crud_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_categories/new.html.twig', [
            'types_category' => $typesCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_crud_categories_show", methods={"GET"})
     */
    public function show(TypesCategories $typesCategory): Response
    {
        return $this->render('crud_categories/show.html.twig', [
            'types_category' => $typesCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_crud_categories_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypesCategories $typesCategory, TypesCategoriesRepository $typesCategoriesRepository): Response
    {
        $form = $this->createForm(TypesCategoriesType::class, $typesCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typesCategoriesRepository->add($typesCategory);
            return $this->redirectToRoute('app_crud_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_categories/edit.html.twig', [
            'types_category' => $typesCategory,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_crud_categories_delete", methods={"POST"})
     */
    public function delete(Request $request, TypesCategories $typesCategory, TypesCategoriesRepository $typesCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typesCategory->getId(), $request->request->get('_token'))) {
            $typesCategoriesRepository->remove($typesCategory);
        }

        return $this->redirectToRoute('app_crud_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}

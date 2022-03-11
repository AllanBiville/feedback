<?php

namespace App\Controller;


use App\Entity\Avis;
use App\Form\VisitorType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypesCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VisitorController extends AbstractController
{
    /**
     * @Route("/visitor", name="app_visitor")
     */
    public function index(TypesCategoriesRepository $typesCategoriesRepository,Request $request, EntityManagerInterface $entityManager): Response
    {
        $avis = new Avis();
        $form = $this->createForm(VisitorType::class, $avis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           
            dump($avis);
            dump($request);
            $entityManager->persist($avis);
            $entityManager->flush();

            // return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('visitor/index.html.twig', [
            'controller_name' => 'VisitorController',
            'categories' => $typesCategoriesRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }
}

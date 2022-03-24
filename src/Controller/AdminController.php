<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    /**
     * @Security("is_granted('ROLE_ADMIN')")
     */

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
        /**
     * @Route("/admin/commentaire", name="app_admin_commentaire")
     */
    public function commentaire(AvisRepository $avisRepository): Response
    {
        return $this->render('admin/commentaire.html.twig', [
            'commentaires' => $avisRepository->findAllCommentary(),
        ]);
    }
}

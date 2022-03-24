<?php

namespace App\Controller;

use App\Repository\AvisRepository;
use App\Repository\TypesUsersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    /**
     * @Route("/admin/tauxDeVote", name="app_admin_tauxdevote")
     */
    public function tauxDeVote(AvisRepository $avisRepository, TypesUsersRepository $typesUsersRepository): Response
    {
        $tableauCounts = array();
        foreach ($typesUsersRepository->findAll() as $tu) {
            $countParClasses = $avisRepository->TauxDeVote($tu->getId());
            $tableauCounts[] = $countParClasses[0];
        }


        $tableauCounts = json_encode([
            'labels' => ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            'label' => '# of Votes',
            'datasets' => [
                [
                    'backgroundColor' => [
                        'rgba(255,1,0)',
                        'rgba(255, 71, 9)',
                        'rgba(255, 174, 9)',
                        'rgba(166, 217, 79)',
                        'rgba(82, 192, 0)'],
                    'borderColor' => [
                        'rgba(255, 0, 0)',
                        'rgba(255, 71, 9)',
                        'rgba(255, 174, 9)',
                        'rgba(166, 217, 79)',
                        'rgba(82, 192, 0)'],
                    'data' => [
                        12, 19, 3, 5, 2, 3
                    ],
                ],
            ],
        ]);  

    


        return $this->render('admin/tauxdevote.html.twig', [
            'tableauCounts' => $tableauCounts,
            
        ]);
    }
}

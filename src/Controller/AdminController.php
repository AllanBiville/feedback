<?php

namespace App\Controller;


use App\Repository\TypesUsersRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Dompdf\Dompdf;
use App\Form\GraphType;
use App\Repository\AvisRepository;
use App\Repository\TypesCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_ADMIN')")
 * @Route("/admin", name="")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="app_admin")
     */
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    /**
     * @Route("/commentaire", name="app_admin_commentaire")
     */
    public function commentaire(AvisRepository $avisRepository): Response
    {
        return $this->render('admin/commentaire.html.twig', [
            'commentaires' => $avisRepository->findAllCommentary(),
        ]);
    }
    /**
     * @Route("/tauxDeVote", name="app_admin_tauxdevote")
     */
    public function tauxDeVote(AvisRepository $avisRepository, TypesUsersRepository $typesUsersRepository): Response
    {
        $tableauCounts = array();
        foreach ($typesUsersRepository->findAll() as $tu) {
            $countParClasses = $avisRepository->TauxDeVote($tu->getId());
            $tableauCounts[] = $countParClasses[0];
        }
        return $this->render('admin/tauxdevote.html.twig', [
            'tableauCounts' => $tableauCounts,
            
        ]);
    }
    
    /**
     * @Route("/graph", name="app_admin_graph")
     */
    public function graph(Request $request, TypesCategoriesRepository $typesCategoriesRepository, AvisRepository $avisRepository): Response
    {
        $form = $this->createForm(GraphType::class);

        $form->handleRequest($request);
        $startdate = date('Y-m-d');
        $enddate = date('Y-m-d');
        $repas = 'Midi';

        if ($form->isSubmitted() && $form->isValid()) {
            $value = $request->get('graph');

            if (isset($value['startDate'])) {
                $startdate = $value['startDate'];
            }
            if (isset($value['endDate'])) {
                $enddate = $value['endDate'];
            }
            if (isset($value['repas'])) {
                $repas = $value['repas'];
            }
        }

        $categoriesFromDatabase = $typesCategoriesRepository->findAllActive();
        $categoriesWithdata = array();
        foreach ($categoriesFromDatabase as $categorie) {
            $typeCategorieEtoileNotes = array();
            for ($i=1; $i <= 5 ; $i++) { 
                $typeCategorieEtoileNote = $avisRepository->countData($i, $categorie->getShortName(), $startdate, $enddate);
                if (empty($typeCategorieEtoileNote)) {
                    // dump("accueil1 (" . $i .") est vide ");
                    $typeCategorieEtoileNotes[] = 0;
                } else {
                    // dump("accueil1 (" . $i .") = " . print_r($typeCategorieEtoileNote[0], true));
                    $typeCategorieEtoileNotes[] = $typeCategorieEtoileNote[0]['count'];
                }                               
            };
            $data = json_encode([
                'labels' => ['1 étoiles','2 étoiles','3 étoiles','4 étoiles','5 étoiles'],
                'datasets' => [
                    [
                        'label2' => $categorie->getShortName(),
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
                        'data' => $typeCategorieEtoileNotes,
                    ],
                ],
            ]);  
            $categorie->setData($data);
            $categoriesWithdata[] = $categorie;
        };

        return $this->render('admin/graph.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'startDate' => $startdate,
            'endDate' => $enddate,
            'repas' => $repas,
            'categories' => $categoriesWithdata,
        ]);

        // $dompdf = new Dompdf();

        // $contents = $this->renderView('admin/graph.html.twig', [
        //     'form' => $form->createView(),
        //     'startDate' => $startdate,
        //     'endDate' => $enddate,
        //     'repas' => $repas,
        //     'categories' => $categoriesWithdata,
        // ]);

        // $dompdf->loadHtml($contents);

        // $dompdf->setPaper('A4', 'portrait');

        // $dompdf->render();

        // $fichier= 'Avis.pdf';

        // return $dompdf->stream($fichier);
    }
}

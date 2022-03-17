<?php

namespace App\Controller;

use App\Form\GraphType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
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
     * @Route("/graph", name="app_admin_graph")
     */
    public function graph(Request $request): Response
    {
        $form = $this->createForm(GraphType::class);

        $form->handleRequest($request);
        $startdate = date('Y/m/d');
        $enddate = date('Y/m/d');
        $repas = 'Midi';
 

        if ($form->isSubmitted() && $form->isValid()) {
                $value = $request->get('graph');

                if (isset($value['startDate'])) {
                   $startdate=$value['startDate'];
                }
                if (isset($value['endDate'])) {
                    $enddate=$value['endDate'];
                }
                if (isset($value['repas'])) {
                    $repas=$value['repas'];
                }
            }

        return $this->render('admin/graph.html.twig', [
            'controller_name' => 'AdminController',
            'form' => $form->createView(),
            'startDate' => $startdate,
            'endDate' => $enddate,
            'repas' => $repas,
        ]);
    }
}

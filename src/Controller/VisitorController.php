<?php

namespace App\Controller;


use App\Entity\Avis;
use App\Form\AvisType;
use App\Form\CodePinType;
use App\Entity\AvisTypesCategories;
use App\Repository\QrcodePinRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TypesCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    /**
     * @Route("/visitor", name="app_visitor")
     */
class VisitorController extends AbstractController
{
    /**
     * @Route("/", name="app_visitor")
     */
    public function codePin(RequestStack $requestStack,QrcodePinRepository $pinRepository, Request $request): Response
    {
            $form = $this->createForm(CodePinType::class);
            $form->handlerequest($request);
    
            if ($form->isSubmitted() && $form->isValid()){
                $value= $request->get('pin_qr_code');
                dump($value);
                $pin = $value['pin'];
                
                // $session = $requestStack->getSession();
                // $session->set('pinOK', 'pinOK');
                // $this->addFlash('danger', 'Mauvais code pin !');
    
                // if ($pinRepository->searchPin($pin) != null){
                //     return $this->redirectToRoute("qrcode_visitor");
                // }
            }
        return $this->render('visitor/codepin.html.twig', [
            'form' => $form->createView(),

        ]);
    }


    // public function form(TypesCategoriesRepository $typesCategoriesRepository, Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $avis = new Avis();
        
    //     $form = $this->createForm(AvisType::class, $avis);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {
    //         foreach ($typesCategoriesRepository->findAll() as $tc){
    //             $note = $request->get($tc->getId());
    //             $atc = new AvisTypesCategories();
    //             $atc->setAvis($avis);
    //             $atc->setTypesCategories($tc);
    //             $atc->setNote($note);
    //             $entityManager->persist($atc);
    //         }

    //         $entityManager->persist($avis);

    //         $entityManager->flush();

    //         // return $this->redirectToRoute('user_index', [], Response::HTTP_SEE_OTHER);
    //     }
    //     return $this->render('visitor/index.html.twig', [
    //         'controller_name' => 'VisitorController',
    //         'categories' => $typesCategoriesRepository->findAll(),
    //         'form' => $form->createView(),
    //     ]);
    // }
}

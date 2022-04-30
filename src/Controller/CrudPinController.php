<?php

namespace App\Controller;

use App\Entity\QrcodePin;
use App\Form\QrcodePinType;
use App\Repository\QrcodePinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Security("is_granted('ROLE_SUPERADMIN')")
 * @Route("/admin/pin")
 */
class CrudPinController extends AbstractController
{
    /**
     * @Route("/edit", name="app_crud_pin_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, QrcodePinRepository $qrcodePinRepository,EntityManagerInterface $em): Response
    {
        $qrcodePin = $qrcodePinRepository->searchPin();
        $form = $this->createForm(QrcodePinType::class, $qrcodePin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($qrcodePin);
            $em->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_pin/edit.html.twig', [
            'qrcode_pin' => $qrcodePin,
            'form' => $form,
        ]);
    }
}

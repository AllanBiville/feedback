<?php

namespace App\Controller;

use App\Entity\QrcodePin;
use App\Form\QrcodePinType;
use App\Repository\QrcodePinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pin")
 */
class CrudPinController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="app_crud_pin_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, QrcodePin $qrcodePin, QrcodePinRepository $qrcodePinRepository): Response
    {
        $form = $this->createForm(QrcodePinType::class, $qrcodePin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $qrcodePinRepository->add($qrcodePin);
            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('crud_pin/edit.html.twig', [
            'qrcode_pin' => $qrcodePin,
            'form' => $form,
        ]);
    }
}

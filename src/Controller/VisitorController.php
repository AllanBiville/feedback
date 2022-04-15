<?php

namespace App\Controller;


use Dompdf\Dompdf;
use Dompdf\Options;
use App\Entity\Avis;
use App\Form\AvisType;
use App\Form\CodePinType;
use Endroid\QrCode\QrCode;
use App\Entity\QrcodeToken;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\Color\Color;
use App\Entity\AvisTypesCategories;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use App\Repository\QrcodePinRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QrcodeTokenRepository;
use App\Repository\TypesCategoriesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    /**
     * @Route("/visitor", name="app_visitor")
     */
class VisitorController extends AbstractController
{
    /**
     * @Route("/", name="_pin")
     */
    public function codePin(RequestStack $requestStack,QrcodePinRepository $pinRepository, Request $request): Response
    {
            $form = $this->createForm(CodePinType::class);
            $form->handlerequest($request);
            $session = $requestStack->getSession();

            if (isset($session)){
                $session->set('pin', 'False');
            }
            if ($form->isSubmitted() && $form->isValid()){
                $value= $request->get('code_pin');
                $value = $value['pin'];
                $session->set('pin', 'True');
                if ($pinRepository->searchPin()->getPin() == $value){
                    return $this->redirectToRoute("app_visitor_qrcode");
                } else {
                    $this->addFlash('danger', 'Mauvais code pin !');
                    return $this->redirectToRoute("app_visitor_pin");
                }
            }
        return $this->render('visitor/codepin.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/qrcode", name="_qrcode")
     */
    public function QrCode(RequestStack $requestStack, QrcodeTokenRepository $qrCodeTokenRepository,EntityManagerInterface $manager,Request $request): Response
    {
        $session = $requestStack->getSession();
        $pin = $session->get('pin');

        if ($pin != "True"){
             return $this->redirectToRoute("app_visitor_pin");
        } 
        
        $date = date("d-m-y");
        $req = $qrCodeTokenRepository->tokenExist($date);
       
        if ( $req != null){
            // si token existe
            $token = $req->getToken(); 
        } else {
            // si token existe pas
            $token = bin2hex(random_bytes(50));
            $qrCodeToken = new QrcodeToken();
            $qrCodeToken->setDate($date);
            $qrCodeToken->setToken($token);
            $manager->persist($qrCodeToken);
            $manager->flush();
        }
        
        
       
       $ip = $request->server->get('SERVER_NAME');
       
       $url = 'https://'.$ip.'/visitor/form?token='.$token;
       
        $writer = new PngWriter();
        $qrCode = QrCode::create($url)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(500)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));


        //$label = Label::create('Label')
        //->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();

        return $this->render('visitor/qrcode.html.twig',[
            'data_url' => $dataUri,

        ]);    
    }


    /**
     * @Route("/pdf", name="_pdf")
     */
    public function pdf(RequestStack $requestStack, QrcodeTokenRepository $qrCodeTokenRepository,EntityManagerInterface $manager,Request $request): Response
    {
        $date = date("d-m-y");
        $req = $qrCodeTokenRepository->tokenExist($date);
       
        if ( $req != null){
            // si token existe
            $token = $req->getToken(); 
        } else {
            // si token existe pas
            $token = bin2hex(random_bytes(50));
            $qrCodeToken = new QrcodeToken();
            $qrCodeToken->setDate($date);
            $qrCodeToken->setToken($token);
            $manager->persist($qrCodeToken);
            $manager->flush();
        }
        
        
       
       $ip = $request->server->get('SERVER_NAME');
       
       $url = 'https://'.$ip.'/visitor/form?token='.$token;
       
        $writer = new PngWriter();
        $qrCode = QrCode::create($url)
        ->setEncoding(new Encoding('UTF-8'))
        ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
        ->setSize(500)
        ->setMargin(10)
        ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
        ->setForegroundColor(new Color(0, 0, 0))
        ->setBackgroundColor(new Color(255, 255, 255));


        //$label = Label::create('Label')
        //->setTextColor(new Color(255, 0, 0));

        $result = $writer->write($qrCode);
        $dataUri = $result->getDataUri();
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('visitor/qrcodepdf.html.twig', [
            'title' => "PDF",
            'data_url' => $dataUri,
            'date' => $date,
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)

		// return new Response($dompdf->stream("qrcode_$date.pdf", 
		//     ["Attachment" => true]), 
		// 	Response::HTTP_OK, 
		// 	['content-type' => 'application/pdf']
		// );
        $dompdf->stream("qrcode_.".$date."_.pdf", [
            "Attachment" => true
        ], ['content-type' => 'application/pdf']);
        return new Response();   
    }
    /**
     * @Route("/form", name="_form")
     */
    public function form(RequestStack $requestStack,TypesCategoriesRepository $typesCategoriesRepository,QrcodeTokenRepository $qrCodeTokenRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = $requestStack->getSession();
        $token = $_GET['token'];
        $date = date("d-m-y");
         if ($qrCodeTokenRepository->tokenVerify($date)->getToken() != $token){
            return $this->render('visitor/error_token.html.twig', [
            ]);
         } 
        $avis = new Avis();
        
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($session->get('send') == "True"){
                return $this->redirectToRoute("app_visitor_spam");
            }

            $avis->setDate(date('Y-m-d'));
            
            foreach ($typesCategoriesRepository->findAllActive() as $tc){
                $note = $request->get($tc->getId());
                $atc = new AvisTypesCategories();
                $atc->setAvis($avis);
                $atc->setTypesCategories($tc);
                $atc->setNote($note);
                $entityManager->persist($atc);
                dump($note);
            }

            $entityManager->persist($avis);

            $entityManager->flush();

            return $this->redirectToRoute("app_visitor_save");
        }
        return $this->render('visitor/form.html.twig', [
            'controller_name' => 'VisitorController',
            'categories' => $typesCategoriesRepository->findAllActive(),
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/save", name="_save")
     */
    public function save(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $session->set('send', 'True');
        return $this->render('visitor/save.html.twig');
    }
        /**
     * @Route("/spam", name="_spam")
     */
    public function spam(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        return $this->render('visitor/spam.html.twig');
    }
}
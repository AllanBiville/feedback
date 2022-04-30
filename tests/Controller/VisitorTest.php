<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VisitorTest extends WebTestCase
{
    public function testVisitorRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/visitor/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('FeedBack - Code Pin');

        $this->assertSelectorExists('h2:contains("Code Pin")');
        $this->assertSelectorExists('h3:contains("Pour accédez à la génération du QRCode, veuillez entrez le code PIN !")');
        $this->assertCount(2, $crawler->filter('input'));
    }

    public function testQrcodeRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/visitor/');
        $client->submitForm('Accédez au QRCode', ['code_pin[pin]' => '12345']);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('FeedBack - QRCode');

        $this->assertSelectorExists('a:contains("PDF QRcode")');
        $this->assertCount(1, $crawler->filter('img'));
    }
    // public function testQRCodePDFRoute(): void
    // {
    //     // $client = static::createClient();
    //     // $crawler = $client->request('GET', '/visitor/pdf');
    //     // dump($crawler);
    //     // $this->assertResponseIsSuccessful();
    //     // $this->assertSelectorExists('h2:contains("Scannez moi pour laisser un avis sur votre repas!")');

    //     // $this->assertPageTitleContains('FeedBack - Code Pin');

    //     // $this->assertSelectorExists('h2:contains("Code Pin")');
    //     // $this->assertSelectorExists('h3:contains("Pour accédez à la génération du QRCode, veuillez entrez le code PIN !")');
    //     // $this->assertCount(2, $crawler->filter('input'));
    // }
}

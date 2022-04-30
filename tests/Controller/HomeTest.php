<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeTest extends WebTestCase
{
    public function testHomeRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('FeedBack - Accueil');

        $this->assertCount(2, $crawler->filter('p'));
        $this->assertSelectorExists('p:contains("Accédez au panel administrateur")');
        $this->assertSelectorExists('p:contains("Accédez à la génération du QRCode")');
    }
}

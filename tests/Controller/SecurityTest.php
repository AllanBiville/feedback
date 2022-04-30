<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityTest extends WebTestCase
{
    public function testLoginRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('FeedBack - Connexion');

        $this->assertSelectorExists('h1:contains("Accédez au panel administrateur")');
        $this->assertCount(3, $crawler->filter('input'));
    }

    public function testLogoutRoute(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/logout');
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('FeedBack - Accueil');

        $this->assertSelectorExists('p:contains("Accédez au panel administrateur")');
        $this->assertSelectorExists('p:contains("Accédez à la génération du QRCode")');
    }
}

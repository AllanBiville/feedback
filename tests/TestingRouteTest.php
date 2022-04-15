<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TestingRouteTest extends WebTestCase
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

    public function testQRCodeRoute(): void
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
    public function loginSuperadmin($username = 'superadmin', $role = 'ROLE_SUPERADMIN')
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');

        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken($username, $firewallName, array($role));
        $session->set('_security_' . $firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        return $client;
    }
    public function testAdminRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Accueil');

        $this->assertSelectorExists('h1:contains("Bonjour")');
    }

    public function testGraphRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/graph');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Graphique');

        $this->assertSelectorExists('h1:contains("Graphique")');
    }

    public function testCommentaireRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/commentaire');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Commentaire');

        $this->assertSelectorExists('h4:contains("Les derniers commentaires...")');
    }

    public function testTauxDeVoteRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/tauxDeVote');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Taux de vote');

        $this->assertSelectorExists('h1:contains("Taux de vote")');
    }
    public function testCrudPinRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/pin/1/edit');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Modifier PIN');

        $this->assertSelectorExists('h1:contains("Modifier code PIN (Qrcode)")');
        $this->assertCount(2, $crawler->filter('input'));
    }

    public function testCrudUserIndexRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/user/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Utilisateurs');

        $this->assertSelectorExists('h1:contains("Affichage des utilisateurs")');
    }
    public function testCrudUserNewRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/user/new');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Créer utilisateur');

        $this->assertSelectorExists('h1:contains("Créer utilisateur")');
        $this->assertCount(3, $crawler->filter('input'));
    }

    public function testCrudUserEditRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/user/1/edit');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Modifier utilisateur');

        $this->assertSelectorExists('h1:contains("Modifier utilisateur")');
        $this->assertCount(3, $crawler->filter('input'));
    }

    public function testCrudCategorieIndexRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/categories/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Catégories');

        $this->assertSelectorExists('h1:contains("Affichage des catégories")');
    }
    public function testCrudCategorieNewRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/categories/new');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Créer catégorie');

        $this->assertSelectorExists('h1:contains("Créer catégorie")');
        $this->assertCount(3, $crawler->filter('input'));
    }

    public function testCrudCategorieEditRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/categories/1/edit');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Modifier catégorie');

        $this->assertSelectorExists('h1:contains("Modifier catégorie")');
        $this->assertCount(3, $crawler->filter('input'));
    }

    public function testCrudClassesIndexRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/users/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Classes');

        $this->assertSelectorExists('h1:contains("Affichage des classes")');
    }
    public function testCrudClassesNewRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/users/new');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Créer classe');

        $this->assertSelectorExists('h1:contains("Créer classe")');
        $this->assertCount(2, $crawler->filter('input'));
    }

    public function testCrudClassesEditRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/users/1/edit');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Modifier classe');

        $this->assertSelectorExists('h1:contains("Modifier classe")');
        $this->assertCount(2, $crawler->filter('input'));
    }

    public function testCrudRepasIndexRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/repas/');
        $this->assertResponseIsSuccessful();

        $this->assertPageTitleContains('Panel Administrateur - Repas');

        $this->assertSelectorExists('h1:contains("Affichage des repas")');
    }
    public function testCrudRepasNewRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/repas/new');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Créer repas');

        $this->assertSelectorExists('h1:contains("Créer repas")');
        $this->assertCount(2, $crawler->filter('input'));
    }

    public function testCrudRepasEditRoute(): void
    {
        $client = $this->loginSuperadmin();
        $crawler = $client->request('GET', '/admin/repas/1/edit');
        $this->assertResponseIsSuccessful();
        $this->assertPageTitleContains('Panel Administrateur - Modifier repas');

        $this->assertSelectorExists('h1:contains("Modifier repas")');
        $this->assertCount(2, $crawler->filter('input'));
    }
}

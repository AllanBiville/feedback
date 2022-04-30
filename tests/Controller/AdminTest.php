<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AdminTest extends WebTestCase
{
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
}

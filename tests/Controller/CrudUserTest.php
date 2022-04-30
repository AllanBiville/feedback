<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CrudUserTest extends WebTestCase
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
}

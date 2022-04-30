<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CrudRepasTest extends WebTestCase
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

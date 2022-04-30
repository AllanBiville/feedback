<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CrudUsersTest extends WebTestCase
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
}

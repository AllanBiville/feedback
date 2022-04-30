<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class CrudCategoriesTest extends WebTestCase
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
}

<?php

namespace App\Tests;

use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class TestRouteLoginTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Accédez au panel administrateur');    
    }

    public function testGraphUserAdmin()
    {
        $client = $this->logIn('admin', 'ROLE_ADMIN');
        $crawler = $client->request('GET', '/admin/graph');

        $firewallName = 'main';
        $firewallContext = 'main';

        $this->assertSame(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h2', 'Graphique');   
    }


    /**
     * Create the Authentification Token
     * 
     * @return Client A Client instance
     */
    public function logIn($username='admin', $role='ROLE_ADMIN')
    {
        $client = static::createClient();
        $session = $client->getContainer()->get('session');

        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken($username, null, $firewallName, array($role));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);

        return $client;
    }
}

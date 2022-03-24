<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestRouteLoginTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');
        $this->assertSelectorTextContains('h1', 'Accédez au panel administrateur');    
    }
}

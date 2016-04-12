<?php

namespace FanFerret\DevelopmentBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dev/template/index/');

        $this->assertContains('Hello World', $client->getResponse()->getContent());
    }
}

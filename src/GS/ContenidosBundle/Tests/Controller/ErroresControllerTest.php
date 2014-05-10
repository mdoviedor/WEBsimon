<?php

namespace GS\ContenidosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ErroresControllerTest extends WebTestCase
{
    public function testAlertageneral()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'contenidos/errores/alertaGeneral');
    }

}

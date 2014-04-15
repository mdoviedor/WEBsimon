<?php

namespace GS\ConsultasBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConsultasRecursoControllerTest extends WebTestCase
{
    public function testBusquedaavanzada()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Busquedaavanzada');
    }

}

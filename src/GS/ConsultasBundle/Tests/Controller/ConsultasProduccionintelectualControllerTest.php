<?php

namespace GS\ConsultasBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConsultasProduccionintelectualControllerTest extends WebTestCase
{
    public function testBusquedaavanzada()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Busquedaavanzada');
    }

}

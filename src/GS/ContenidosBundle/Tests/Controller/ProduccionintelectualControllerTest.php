<?php

namespace GS\ContenidosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduccionintelectualControllerTest extends WebTestCase
{
    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'contenidos/produccionIntelectual/');
    }

    public function testVer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'contenidos/produccionIntelectual/ver/');
    }

}

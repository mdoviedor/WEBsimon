<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportesControllerTest extends WebTestCase
{
    public function testInformacioncolciencias()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/informacionColciencias');
    }

}

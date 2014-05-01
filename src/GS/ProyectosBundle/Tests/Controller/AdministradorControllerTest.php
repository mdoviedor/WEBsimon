<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministradorControllerTest extends WebTestCase
{
    public function testVistaherramientas()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/');
    }

}

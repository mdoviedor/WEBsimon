<?php

namespace GS\ContenidosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UsuariosControllerTest extends WebTestCase
{
    public function testVer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'contenidos/usuarios/ver');
    }

}

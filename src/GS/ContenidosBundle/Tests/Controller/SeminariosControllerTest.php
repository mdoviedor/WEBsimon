<?php

namespace GS\ContenidosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SeminariosControllerTest extends WebTestCase
{
    public function testVistaseminario()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'contenidos/seminario/vista');
    }

}

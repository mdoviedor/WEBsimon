<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministrarseminarioControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarSeminarios/crear');
    }

    public function testModificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarSeminarios/modificar');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarSeminarios/');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarSeminarios/eliminar');
    }

}

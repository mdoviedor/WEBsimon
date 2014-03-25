<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministrarproduccionintelectualControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarProduccionIntelectual/crear');
    }

    public function testModificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarProduccionIntelectual/modificar');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarProduccionIntelectual/eliminar');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarProduccionIntelectual');
    }

}

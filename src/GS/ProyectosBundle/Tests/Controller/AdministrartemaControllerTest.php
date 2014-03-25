<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministrartemaControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarTema/crear');
    }

    public function testModificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarTema/modificar');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarTema/eliminar');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarTema');
    }

}

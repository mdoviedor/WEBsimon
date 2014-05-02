<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdministrarrecursoControllerTest extends WebTestCase
{
    public function testCrear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarRecurso/crear');
    }

    public function testModificar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarRecurso/modificar');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarRecurso/eliminar');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'administrador/administrarRecurso/');
    }

}

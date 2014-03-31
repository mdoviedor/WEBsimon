<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DesarrollarproduccionintelectualControllerTest extends WebTestCase
{
    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/');
    }

    public function testAgregarbibliografia()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/bibliografia/agregarBibliografia');
    }

    public function testEliminarbibliografia()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/bibliografia/eliminarBibliografia');
    }

    public function testModificarbibliografia()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/bibliografia/modificarBibliografia');
    }

    public function testBuscarbibliografia()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/bibliografia/buscarBibliografia');
    }

    public function testAgregaractividadcronograma()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/cronograma/agregarActividadCronograma');
    }

    public function testEliminaractividadcronograma()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/cronograma/eliminarActividadCronograma');
    }

    public function testModificaractividadcronograma()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/produccionIntelectual/cronograma/modificarActividadCronograma');
    }

}

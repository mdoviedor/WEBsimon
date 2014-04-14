<?php

namespace GS\ProyectosBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MensajesControllerTest extends WebTestCase
{
    public function testEnviar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/enviar');
    }

    public function testLeer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/leer');
    }

    public function testEliminar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/eliminar‡');
    }

    public function testBuscar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/');
    }

    public function testBuscarenviado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/enviado');
    }

    public function testBuscareliminado()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/eliminado');
    }

    public function testRestaurar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'usuario/mensajes/restaurar');
    }

}

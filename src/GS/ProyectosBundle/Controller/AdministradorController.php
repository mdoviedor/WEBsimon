<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministradorController extends Controller
{
    public function VistaherramientasAction()
    {
          return $this->render('GSProyectosBundle:Administrador:Vistaherramientas.html.twig');
    }

}

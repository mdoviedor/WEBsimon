<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Usuario;
use GS\ProyectosBundle\Entity\TemaUsuario;

class ReportesController extends Controller {

    public function InformacioncolcienciasAction() {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $temaUsuario = new TemaUsuario();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->findAll();
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->buscarTemaAsignado();

        return $this->render('GSProyectosBundle:Reportes:Informacioncolciencias.html.twig', array('usuarios' => $usuario, 'produccionEnDesarrollo' => $temaUsuario));
    }

}

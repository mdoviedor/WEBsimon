<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ContenidosBundle\Entity\Usuario;

class UsuariosController extends Controller {

    public function VerAction() {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('GSContenidosBundle:Usuario')->findAll();
        return $this->render('GSContenidosBundle:Usuarios:ver.html.twig', array('usuarios' => $usuario));
    }

}

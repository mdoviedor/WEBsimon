<?php

namespace GS\ConsultasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Tema;
use Symfony\Component\HttpFoundation\Request;

class ConsultasTemaController extends Controller {
    /*
     * Accion para realizar una busqueda avanzada de los temas y su disponibilidad
     * Implementada en la plantilla Busqueda avanzada
     */

    public function BusquedaavanzadaAction(Request $request, $limite) {

        $tema = new Tema();
        $em = $this->getDoctrine()->getManager();
        $titulo = $request->request->get('campoTitulo');
        $estado = $request->request->get('radioEstadoTema');        

        if (!$estado && $estado != 0) {
            $estado = 'XXX';
        }
        if (!$titulo) {
            $titulo = 'XXX';
        }

        $tema = $em->getRepository('GSConsultasBundle:Tema')->busquedaAvanzada($titulo, $estado, $limite);

        if (!$tema) {
            echo '<div class="alert alert-info"><b>No se encontro ningun resultado.</b> Intentelo de nuveo.</div>';
        }

        return $this->render('GSConsultasBundle:ConsultasTema:Busquedaavanzada.html.twig', array(
                    'temas' => $tema));
    }

    /*
     * Accion para realizar una busqueda avanzada de los temas y su disponibilidad pero con mas opciones
     * Implementada en la plantilla ver mas
     */

    public function VermasAction($titulo, $estado) {
        $tema = new Tema();
        $em = $this->getDoctrine()->getEntityManager();
        $tema = $em->getRepository('GSConsultasBundle:Tema')->verMas($titulo, $estado);

        return $this->render('GSConsultasBundle:ConsultasTema:verMas.html.twig', array('temas' => $tema));
    }

}

<?php

namespace GS\ConsultasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Produccionintelectual;
use GS\ConsultasBundle\Entity\TemaUsuario;
use GS\ConsultasBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;

class ConsultasProduccionintelectualController extends Controller {
    /*
     * Accion para realizar una busqueda avanzada de la produccion intelectual 
     * Implementada en la plantilla Busqueda avanzada
     */

    public function BusquedaavanzadaAction(Request $request, $limite) {
        $estado = true;
        $produccionIntelectual = new Produccionintelectual(); // objeto del Modelo Produccionintelectual
        $em = $this->getDoctrine()->getManager();
        /*
         * Asignacion de los campos recibidos del formulario a
         * las variables.
         */
        $numeroresultados = $limite;

        $primernombre = $request->request->get('campoPrimerNombre', 'null');
        $primerapellido = $request->request->get('campoSegundoNombre', 'null');
        $titulo = $request->request->get('campoTitulo', 'null');
        $tipoproduccion = $request->request->get('listaTipoProduccion', 'null');
        $desde = $request->request->get('fechaDesde', 'null');
        $hasta = $request->request->get('fechaHasta', 'null');
        //$destacado = $request->request->get('destacado', 'XXX');

        if (!$titulo) {
            $titulo = "XXXXXXX";
        }
        if (!$primerapellido) {
            $primerapellido = "XXXXXXX";
        }
        if (!$primernombre) {
            $primernombre = "XXXXXXX";
        }
        if (!$tipoproduccion) {
            $tipoproduccion = "XXXXXXX";
        }
        if (!$desde) {
            $desde = '1000-07-08';
        }
        if (!$hasta) {
            $hasta = '1100-07-08';
        }
        $produccionIntelectual = $em->getRepository('GSConsultasBundle:Produccionintelectual')->busquedaAvanzada(
                $estado, $titulo, $tipoproduccion, $numeroresultados, $primernombre, $primerapellido, $desde, $hasta);

        if (!$produccionIntelectual) {
            echo '<div class="alert alert-info"><b>No se encontro ningun resultado.</b> Intentelo de nuveo.</div>';
        }

        return $this->render('GSConsultasBundle:ConsultasProduccionintelectual:Busquedaavanzada.html.twig', array('produccionIntelectual' => $produccionIntelectual));
    }

    /*
     * Accion para realizar una busqueda avanzada de la produccion intelectual por parte de la comunidad 
     * debido a que tiene privilegios mas limitados
     * Implementada en la plantilla busqueda avanzada comunidad
     * Recibe un formulario y el limite del tamaño de la busqueda. 
     */

    public function BusquedaavanzadacomunidadAction(Request $request, $limite) {
        $estado = true;
        $produccionIntelectual = new Produccionintelectual();
        $em = $this->getDoctrine()->getManager();
        $numeroresultados = $limite;

        /*
         * Asignacion de los campos recibidos del formulario a
         * las variables.
         */
        $primernombre = $request->request->get('campoPrimerNombre', 'null');
        $primerapellido = $request->request->get('campoSegundoNombre', 'null');
        $titulo = $request->request->get('campoTitulo', 'null');
        $tipoproduccion = $request->request->get('listaTipoProduccion', 'null');
        $desde = $request->request->get('fechaDesde', 'null');
        $hasta = $request->request->get('fechaHasta', 'null');
        //$destacado = $request->request->get('destacado', 'XXX');

        if (!$titulo) {
            $titulo = "XXXXXXX";
        }
        if (!$primerapellido) {
            $primerapellido = "XXXXXXX";
        }
        if (!$primernombre) {
            $primernombre = "XXXXXXX";
        }
        if (!$tipoproduccion) {
            $tipoproduccion = "XXXXXXX";
        }
        if (!$desde) {
            $desde = '1000-07-08';
        }
        if (!$hasta) {
            $hasta = '1100-07-08';
        }
        $produccionIntelectual = $em->getRepository('GSConsultasBundle:Produccionintelectual')->busquedaAvanzada(
                $estado, $titulo, $tipoproduccion, $numeroresultados, $primernombre, $primerapellido, $desde, $hasta);

        if (!$produccionIntelectual) {
            echo '<div class="alert alert-info"><b>No se encontro ningun resultado.</b> Intentelo de nuveo.</div>';
        }

        return $this->render('GSConsultasBundle:ConsultasProduccionintelectual:Busquedaavanzadacomunidad.html.twig', array(
                    'produccionesIntelectuales' => $produccionIntelectual));
    }

    public function VistaperfilAction($id, $limite) {
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario();
        $produccionIntelectual = new Produccionintelectual();
        $usuario = new Usuario();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->findBy(array('user' => $id));

        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->buscarProduccionUsuario($usuario[0]->getNumerodocumentoidentidad(), $limite);
        return $this->render('GSConsultasBundle:ConsultasProduccionintelectual:Vistaperfil.html.twig', array('id' => $id, 'usuario' => $usuario, 'produccionIntelectual' => $produccionIntelectual));
    }

    public function VistaperfilcomunidadAction($id, $limite) {
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario();
        $produccionIntelectual = new Produccionintelectual();
        $usuario = new Usuario();
        $usuario = $em->getRepository('GSContenidosBundle:Usuario')->findBy(array('user' => $id));
        $produccionIntelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccionUsuario($usuario[0]->getNumerodocumentoidentidad(), $limite);
        return $this->render('GSConsultasBundle:ConsultasProduccionintelectual:Vistaperfil.html.twig', array('id' => $id, 'usuario' => $usuario, 'produccionIntelectual' => $produccionIntelectual));
    }

}

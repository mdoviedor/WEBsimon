<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ContenidosBundle\Entity\Produccionintelectual;
use GS\ContenidosBundle\Entity\Tipoproduccion;
use GS\ContenidosBundle\Entity\TemaUsuario;
use GS\ContenidosBundle\Entity\Tema;
use GS\ContenidosBundle\Entity\Usuario;
use GS\ContenidosBundle\Entity\TemaBibliografia;

class ProduccionintelectualController extends Controller {

    public function BuscarAction($tamano, $parametro) {
        $valor = null;
        $produccionintelectual = new Produccionintelectual();
        $produccionIntelectualDestacada = new Produccionintelectual();
        $produccionIntelectualMasVista = new Produccionintelectual();
        $tipoProduccion = new Tipoproduccion();
        $em = $this->getDoctrine()->getManager();

        if ($parametro == "XXX") {
            $produccionintelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->findBy(array(), array('fecharegistro' => 'DESC'), $tamano);
            $tipoProduccion = $em->getRepository('GSConsultasBundle:Tipoproduccion')->findAll();
            $produccionIntelectualDestacada = $em->getRepository('GSContenidosBundle:Produccionintelectual')->findBy(array('destacado' => true, 'estado' => true));
            $produccionIntelectualMasVista = $em->getRepository('GSContenidosBundle:Produccionintelectual')->findBy(array('estado' => true), array('vecesvisto' => 'DESC'), 5);
        } else {
            $valor = $parametro;
            $produccionintelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccion($tamano, $parametro);
        }

        return $this->render('GSContenidosBundle:Produccionintelectual:Buscar.html.twig', array(
                    'produccionIntelectual' => $produccionintelectual, 'tipoProduccion' => $tipoProduccion,
                    'produccionIntelectualDestacada' => $produccionIntelectualDestacada,
                    'produccionIntelectualMasVista' => $produccionIntelectualMasVista, 'valor' => $valor, 'tamano' => $tamano));
    }

    public function VerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = new Produccionintelectual();
        $temaUsuario = new TemaUsuario();
        $temaBibliografia = new TemaBibliografia();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id);
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $produccionIntelectual->getTema()->getIdtema()));
        $temaBibliografia = $em->getRepository('GSProyectosBundle:TemaBibliografia')->findBy(array('tema' => $produccionIntelectual->getTema()->getIdtema()));
        $numero = $produccionIntelectual->getVecesvisto();
        $produccionIntelectual->setVecesvisto($numero + 1);
        $em->persist($produccionIntelectual);
        $em->flush();
        return $this->render('GSContenidosBundle:Produccionintelectual:Ver.html.twig', array('produccionIntelectual' => $produccionIntelectual, 'temaUsuario' => $temaUsuario, 'temaBibliografia' => $temaBibliografia));
    }

    public function VistaperfilAction($id, $limite) {
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario();
        $produccionIntelectual = new Produccionintelectual();
        $usuario = new Usuario();
        $usuario = $em->getRepository('GSContenidosBundle:Usuario')->findBy(array('user' => $id));
        $produccionIntelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccionUsuario($usuario[0]->getNumerodocumentoidentidad(), $limite);
        return $this->render('GSContenidosBundle:Produccionintelectual:Vistaperfil.html.twig', array('id' => $id, 'usuario' => $usuario, 'produccionIntelectual' => $produccionIntelectual));
    }

    /*
     * Accion para mostrar un alista de temas ofertados. 
     * Los temas ofertados son aquello que no tienen usuario asignado
     */

    public function TemasofertadosAction() {
        $em = $this->getDoctrine()->getManager();
        $tema = new Tema();
        $tema = $em->getRepository('GSContenidosBundle:Tema')->buscarTemaOfertado();
        return $this->render('GSContenidosBundle:Produccionintelectual:Temaofertado.html.twig', array('temaOfertado' => $tema));
    }

    /*
     * Accion para decodificar la la descripcion del tema.
     * Recibe la descripcion de un tema. 
     */

    public function DecodificardescripciontemaAction($descripcion) {
        $descripcionTema = html_entity_decode($descripcion);
        return $this->render('GSContenidosBundle:Produccionintelectual:Decodificardescripcion.html.twig', array('descripcion' => $descripcionTema));
    }

    public function UltimostemasofertadosAction() {
        $em = $this->getDoctrine()->getManager();
        $tema = new Tema();
        $tema = $em->getRepository('GSContenidosBundle:Tema')->buscarUltimosTemasOfertados();
        return $this->render('GSContenidosBundle:Produccionintelectual:Ultimostemasofertados.html.twig', array('temas' => $tema));
    }

    public function VertemaofertadoAction($id) {
        $em = $this->getDoctrine()->getManager();
        $tema = new Tema();
        $tema = $em->getRepository('GSContenidosBundle:Tema')->find($id);
        return $this->render('GSContenidosBundle:Produccionintelectual:Vertemaofertado.html.twig', array('tema' => $tema));
    }

    /*
     * Acción para visualizar el elemento bibliografico con su respectiva lectura con proposito.
     * Recibe el idbibliografia correspondiente al modelo Bibliografia; id del elemento
     * bibliografico que se quiere visualizar
     */

    public function BibliografiavistaAction($id) {
        $em = $this->getDoctrine()->getManager();
        $bibliografia = new Bibliografia();
        $lecturaConProposito = new Lecturaconproposito();
        $bibliografia = $em->getRepository('GSProyectosBundle:Bibliografia')->find($id);
        $lecturaConProposito = $em->getRepository('GSProyectosBundle:Lecturaconproposito')->findBy(array('bibliografia' => $id));
        return $this->render('GSContenidosBundle:Produccionintelectual:Bibliografiavista.html.twig', array('bibliografia' => $bibliografia, 'lecturaConProposito' => $lecturaConProposito));
    }

    public function ProducciondestacadaAction() {
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = new Produccionintelectual();
        $produccionIntelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->findBy(array('estado' => true, 'destacado' => true), array('fecharegistro' => 'DESC'), 5);
        return $this->render('GSContenidosBundle:Produccionintelectual:Producciondestacada.html.twig', array('produccionIntelectual' => $produccionIntelectual));
    }

//    public function VerproducciondestacadaAction($id) {
//        $em = $this->getDoctrine()->getManager();
//        $tema = new Tema();
//        $tema = $em->getRepository('GSContenidosBundle:Tema')->find($id);
//        return $this->render('GSContenidosBundle:Produccionintelectual:Vertemaofertado.html.twig', array('tema' => $tema));
//    }

}

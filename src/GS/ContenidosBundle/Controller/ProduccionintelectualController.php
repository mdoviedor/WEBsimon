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
        $produccionintelectual = new Produccionintelectual();
        $produccionIntelectualDestacada = new Produccionintelectual();
        $produccionIntelectualMasVista = new Produccionintelectual();

        $tipoProduccion = new Tipoproduccion();
        $em = $this->getDoctrine()->getManager();
        $produccionintelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccion($tamano, $parametro);
        $produccionIntelectualDestacada = $em->getRepository('GSContenidosBundle:Produccionintelectual')->findBy(array('destacado' => true));
        $produccionIntelectualMasVista = $em->getRepository('GSContenidosBundle:Produccionintelectual')->findBy(array(), array('vecesvisto' => 'DESC'), 5);
        $tipoProduccion = $em->getRepository('GSConsultasBundle:Tipoproduccion')->findAll();
        return $this->render('GSContenidosBundle:Produccionintelectual:Buscar.html.twig', array('produccionIntelectual' => $produccionintelectual, 'tipoProduccion' => $tipoProduccion, 'produccionIntelectualDestacada' => $produccionIntelectualDestacada, 'produccionIntelectualMasVista' => $produccionIntelectualMasVista));
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

}

<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ContenidosBundle\Entity\Produccionintelectual;
use GS\ContenidosBundle\Entity\Tipoproduccion;
use GS\ContenidosBundle\Entity\TemaUsuario;
use GS\ContenidosBundle\Entity\Usuario;
use GS\ContenidosBundle\Entity\TemaBibliografia;

class ProduccionintelectualController extends Controller {

    public function BuscarAction($tamano, $parametro) {
        $produccionintelectual = new Produccionintelectual();
        $tipoProduccion = new Tipoproduccion();
        $em = $this->getDoctrine()->getManager();
        $produccionintelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccion($tamano, $parametro);
        $tipoProduccion = $em->getRepository('GSConsultasBundle:Tipoproduccion')->findAll();
        return $this->render('GSContenidosBundle:Produccionintelectual:Buscar.html.twig', array('produccionIntelectual' => $produccionintelectual, 'tipoProduccion' => $tipoProduccion));
    }

    public function VerAction($id) {
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = new Produccionintelectual();
        $temaUsuario = new TemaUsuario();
        $temaBibliografia = new TemaBibliografia();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id);
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $produccionIntelectual->getTema()->getIdtema()));
        $temaBibliografia = $em->getRepository('GSProyectosBundle:TemaBibliografia')->findBy(array('tema' => $produccionIntelectual->getTema()->getIdtema()));
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

}

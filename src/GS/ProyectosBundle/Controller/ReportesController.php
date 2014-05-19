<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Usuario;
use GS\ProyectosBundle\Entity\Produccionintelectual;
use GS\ProyectosBundle\Entity\Tipoproduccion;
use GS\ProyectosBundle\Entity\TemaUsuario;

class ReportesController extends Controller {

    public function InformacioncolcienciasAction() {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        $tipoProduccion = new Tipoproduccion();
        $temaUsuario = new TemaUsuario();
        $produccionAnoCurso = new Produccionintelectual();
        $produccionTotal = new Produccionintelectual();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->findAll();
        $tipoProduccion = $em->getRepository('GSProyectosBundle:Tipoproduccion')->findAll();
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->buscarTemaAsignado();
        $produccionAnoCurso = $em->getRepository('GSProyectosBundle:Produccionintelectual')->buscarProduccionAnoCurso();
        $produccionTotal = $em->getRepository('GSProyectosBundle:Produccionintelectual')->findBy(array(), array('fecharegistro' => 'DESC'));


        return $this->render('GSProyectosBundle:Reportes:Informacioncolciencias.html.twig', array('produccionTotal' => $produccionTotal, 'tipoProduccion' => $tipoProduccion, 'produccionAnoCurso' => $produccionAnoCurso, 'usuarios' => $usuario, 'produccionEnDesarrollo' => $temaUsuario));
    }

}

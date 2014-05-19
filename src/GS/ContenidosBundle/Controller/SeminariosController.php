<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ContenidosBundle\Entity\Seminario;

class SeminariosController extends Controller {
    /*
     * Vista de un listado de seminarios propuesto por usuario. 
     * Se recibe la variable limite, correspondiente al numero total de resultados que se mostraran
     * No se pueden ver los seminarios en estado no publico (Estado = false).
     */

    public function VistaseminarioAction($limite) {
        $seminario = new Seminario();
        $em = $this->getDoctrine()->getManager();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->findBy(array('estado' => true), array('fecharegistro' => 'DESC'), $limite);
        return $this->render('GSContenidosBundle:Seminarios:Vistaseminario.html.twig', array('seminarios' => $seminario, 'limite' => $limite));
    }

}

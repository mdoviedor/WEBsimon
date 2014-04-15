<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ContenidosBundle\Entity\Produccionintelectual;
use GS\ContenidosBundle\Entity\Tipoproduccion;

class ProduccionintelectualController extends Controller {

    public function BuscarAction($tamano, $parametro) {
        $produccionintelectual = new Produccionintelectual();
        $tipoProduccion = new Tipoproduccion();
        $em = $this->getDoctrine()->getManager();
        $produccionintelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccion($tamano, $parametro);
        $tipoProduccion = $em->getRepository('GSConsultasBundle:Tipoproduccion')->findAll();
        return $this->render('GSContenidosBundle:Produccionintelectual:Buscar.html.twig', array('produccionIntelectual' => $produccionintelectual, 'tipoProduccion' => $tipoProduccion));
    }

    public function VerAction() {
        
    }

}

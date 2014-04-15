<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ContenidosBundle\Entity\Produccionintelectual;

class ProduccionintelectualController extends Controller {

    public function BuscarAction($tamano, $parametro) {
        $produccionintelectual = new Produccionintelectual();
        $em = $this->getDoctrine()->getManager();
        $produccionintelectual = $em->getRepository('GSContenidosBundle:Produccionintelectual')->buscarProduccion($tamano, $parametro);
        return $this->render('GSContenidosBundle:Produccionintelectual:Buscar.html.twig', array('produccionIntelectual' => $produccionintelectual));
    }

    public function VerAction() {
        
    }

}

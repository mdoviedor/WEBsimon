<?php

namespace GS\ConsultasBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Produccionintelectual;

class ConsultasProduccionintelectualController extends Controller
{
    /*
     * Accion para realizar una busqueda avanzada de la produccion intelectual 
     * Implementada en la plantilla Busqueda avanzada
     */
            public function BusquedaavanzadaAction($estado,$titulo,$tipoproduccion,$numeroresultados,$primernombre,$primerapellido)
        {
             $produccionIntelectual = new Produccionintelectual(); // objeto del Modelo Produccionintelectual
             $em = $this->getDoctrine()->getEntityManager();
             $produccionIntelectual = $em->getRepository('GSConsultasBundle:Produccionintelectual')->busquedaAvanzada($estado,$titulo,$tipoproduccion,$numeroresultados,$primernombre,$primerapellido);
             

             return $this->render('GSConsultasBundle:ConsultasProduccionintelectual:Busquedaavanzada.html.twig', array('produccionesIntelectuales' => $produccionIntelectual));


        }
        
     /*
     * Accion para realizar una busqueda avanzada de la produccion intelectual por parte de la comunidad 
      * debido a que tiene privilegios mas limitados
     * Implementada en la plantilla busqueda avanzada comunidad
     */
          public function BusquedaavanzadacomunidadAction($titulo,$tipoproduccion,$numeroresultados,$primernombre,$primerapellido)
        {
             $estado = 3;
             $produccionIntelectual = new Produccionintelectual();
             $em = $this->getDoctrine()->getManager();
             $produccionIntelectual = $em->getRepository('GSConsultasBundle:Produccionintelectual')->busquedaAvanzada($estado,$titulo,$tipoproduccion,$numeroresultados,$primernombre,$primerapellido);            
             return $this->render('GSConsultasBundle:ConsultasProduccionintelectual:Busquedaavanzadacomunidad.html.twig', array('produccionesIntelectuales' => $produccionIntelectual));
        }
    

}

<?php

namespace GS\ConsultasBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Recursos;

class ConsultasRecursoController extends Controller
{
     /*
     * Accion para realizar la busqueda avanzada de los recursos que tiene el grupo simon de investigacion
     * Implementada en la plantilla Busqueda avanzada
     */
    public function BusquedaavanzadaAction($nombre,$tiporecurso,$numeroresultados)
    {
         $recurso = new Recursos();
         $em = $this->getDoctrine()->getEntityManager();
         $recurso = $em->getRepository('GSConsultasBundle:Recursos')->busquedaAvanzada($nombre,$tiporecurso,$numeroresultados   );
    
         
         return $this->render('GSConsultasBundle:ConsultasRecurso:Busquedaavanzada.html.twig', array('recursos' => $recurso));

         
    }

}

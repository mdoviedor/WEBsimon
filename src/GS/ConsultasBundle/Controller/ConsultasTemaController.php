<?php

namespace GS\ConsultasBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Tema;

class ConsultasTemaController extends Controller
{
     /*
     * Accion para realizar una busqueda avanzada de los temas y su disponibilidad
     * Implementada en la plantilla Busqueda avanzada
     */
     public function BusquedaavanzadaAction($titulo,$estado,$numeroresultados)
    {
         $tema = new Tema();
         $em = $this->getDoctrine()->getEntityManager();
         $tema = $em->getRepository('GSConsultasBundle:Tema')->busquedaAvanzada($titulo,$estado,$numeroresultados);
    
         return $this->render('GSConsultasBundle:ConsultasTema:Busquedaavanzada.html.twig', array('temas' => $tema));

         
    }
    
     /*
     * Accion para realizar una busqueda avanzada de los temas y su disponibilidad pero con mas opciones
     * Implementada en la plantilla ver mas
     */
    
    public function VermasAction($titulo,$estado)
    {
         $tema = new Tema();
         $em = $this->getDoctrine()->getEntityManager();
         $tema = $em->getRepository('GSConsultasBundle:Tema')->verMas($titulo,$estado);
    
         return $this->render('GSConsultasBundle:ConsultasTema:verMas.html.twig', array('temas' => $tema));

         
    }
    
    
    
    
    
}

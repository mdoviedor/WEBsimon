<?php

namespace GS\ConsultasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Usuario;
use GS\ConsultasBundle\Entity\User;

class ConsultasusuarioController extends Controller {

     /*
     * Accion para realizar una busqueda avanzada de los usuarios por parte del administrador 
     * Implementada en la plantilla Busqueda avanzada
     */
    public function BusquedaavanzadaAction($numerodocumentoidentidad, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $email,$numeroresultados) {

        $usuario = new Usuario();
        $user = new User();
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $em->getRepository('GSConsultasBundle:Usuario')->busquedaAvanzada($numerodocumentoidentidad, $primernombre, $segundonombre, $primerapellido, $segundoapellido,$numeroresultados);

        $user = $em->getRepository('GSConsultasBundle:User')->findBy(array('email' => $email));
        if($user){
            $usuario = $em->getRepository('GSConsultasBundle:Usuario')->find($user->getUsername());
        }
        
        return $this->render('GSConsultasBundle:Consultasusuario:Busquedaavanzada.html.twig', array('usuarios' => $usuario));
    }
    
     /*
     * Accion para realizar una busqueda avanzada de los usuarios por parte del administrador, pero con mas informacion 
     * Implementada en la plantilla ver mas
     */
    public function VermasAction($numerodocumentoidentidad,$primernombre, $segundonombre, $primerapellido, $segundoapellido, $email) {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $em->getRepository('GSConsultasBundle:Usuario')->verMas($numerodocumentoidentidad, $primernombre, $segundonombre, $primerapellido, $segundoapellido,$email);
        return $this->render('GSConsultasBundle:Consultasusuario:verMas.html.twig', array('usuarios' => $usuario));
    }
 
}

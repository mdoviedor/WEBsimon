<?php

namespace GS\ConsultasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ConsultasBundle\Entity\Usuario;
use GS\ConsultasBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class ConsultasusuarioController extends Controller {
    /*
     * Accion para realizar una busqueda avanzada de los usuarios por parte del administrador 
     * Implementada en la plantilla Busqueda avanzada
     */

    public function BusquedaavanzadaAction(Request $request, $numeroresultados) {

        $usuario = new Usuario();
        $user = new User();
        $em = $this->getDoctrine()->getManager();
        $numerodocumentoidentidad = $request->request->get('campoNumeroDocumentoIdentidad','XXX');
        $primernombre = $request->request->get('campoPrimerNombre','XXX');
        $segundonombre = $request->request->get('campoSegundoNombre','XXX');
        $primerapellido = $request->request->get('campoPrimerApellido','XXX');
        $segundoapellido = $request->request->get('campoSegundoApellido','XXX');
        
        if(!$primernombre){
            $primernombre = 'XXX';
        }
         if(!$segundonombre){
            $segundonombre = 'XXX';
        }
         if(!$primerapellido){
            $primerapellido = 'XXX';
        }
         if(!$segundoapellido){
            $segundoapellido = 'XXX';
        }
        if(!$numerodocumentoidentidad){
            $numerodocumentoidentidad = 'XXX';
        }
        $usuario = $em->getRepository('GSConsultasBundle:Usuario')->busquedaAvanzada($numerodocumentoidentidad, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $numeroresultados);

        if(!$usuario){
            echo '<div class="alert alert-warning"><b>No se encontro ningun resultado.</b> Intentelo de nuveo ...</div>';
        }        
//        $user = $em->getRepository('GSConsultasBundle:User')->findBy(array('email' => $email));
//        if($user){
//            $usuario = $em->getRepository('GSConsultasBundle:Usuario')->find($user->getUsername());
//        }
//        
        return $this->render('GSConsultasBundle:Consultasusuario:Busquedaavanzada.html.twig', array('usuarios' => $usuario));
    }

    /*
     * Accion para realizar una busqueda avanzada de los usuarios por parte del administrador, pero con mas informacion 
     * Implementada en la plantilla ver mas
     */

    public function VermasAction($numerodocumentoidentidad, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $email) {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getEntityManager();
        $usuario = $em->getRepository('GSConsultasBundle:Usuario')->verMas($numerodocumentoidentidad, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $email);
        return $this->render('GSConsultasBundle:Consultasusuario:verMas.html.twig', array('usuarios' => $usuario));
    }

}

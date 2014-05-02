<?php

namespace GS\ContenidosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
 /*
  * Al cliente, hacer la peticion de acceso al index, se redirecciona a la ruta /login.
  */
    function indexAction() {
         if ($this->get('security.context')->isGranted('ROLE_ADMINISTRADOR')) {//Existe una sesion con el usuario Rol ADMINISTRADOR
         return $this->redirect($this->generateUrl('gs_proyectos_vistaherramientas'));
//            return $this->redirect($this->generateUrl('fundeuis_administrador_inicio'));
        } elseif ($this->get('security.context')->isGranted('ROLE_USUARIO')) {
//            $userManager = $this->get('security.context')->getToken()->getUser(); // se contie la sesion del usuario
//            $user = $userManager->getEmail(); // se le asiga a la variable user el nombre del usuario. 
//            $em = $this->getDoctrine()->getManager(); // Se crea la conexion co la base de datos
//            $usuario = $em->getRepository('FundeuisInscripcionBundle:Usuario')->findBycorreoelectronico($user); // Se consulta por el correo electronico
//            if ($usuario) {
              return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_buscar'));
//            } else {
//                return $this->redirect($this->generateUrl('fundeuis_usuario_registro'));
//                //eturn $this->render('FundeuisInscripcionBundle:Usuario:registro.html.twig'); //Se redirecciona al formulario de inicio
//            }
                    
        } else {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }
        
    }
}

<?php

/*
 * Controlador para el manejo de la gestion de usuarios.
 * Estan definidas las acciones: buscar, crear, modificar y eliminar.
 */

namespace GS\UsuarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use GS\UsuarioBundle\Entity\Usuario;
use GS\UsuarioBundle\Entity\Tema;
use GS\UsuarioBundle\Form\UsuarioType;
use GS\UsuarioBundle\Form\UserType;
use GS\UserBundle\Entity\User;

class AdministrarController extends Controller {

    public function CrearAction(Request $request) {

        $usuario = new Usuario(); // Objeto del modelos Usuario
        $u = new User(); // Objeto del modelo User
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $user = $userManager->createUser();
        /*
         * FORMULARIO
         */
        $formUsuario = $this->createForm(new UsuarioType(), $usuario); //Formulario para el registro de los usuarios 

        if ($request->getMethod() == 'POST') {
            $formUsuario->handleRequest($request); // Asignacion de valores obtenidos en el request al formulario formUsuario
            if ($formUsuario->isValid()) {
                $numeroDocumentoIdentidad = $formUsuario->get('numerodocumentoidentidad')->getData(); // Se obtiene el valor del campo numerodocumentoidentidad
                $email = $formUsuario->get('email')->getData(); // Se obtiene el valor del campo email
                $enable = $formUsuario->get('enable')->getData(); // Se obtiene el valor del campo enable          
                $tipousuario = $formUsuario->get('tipousuario')->getViewData(); // Se obtiene el valor del campo tipousuario

                $u->setUsername($numeroDocumentoIdentidad); // Intancia del objeto U
                $u->setEnabled($enable); // Instancia del objeto U
                $u->setPlainPassword($numeroDocumentoIdentidad); // Instancia del objeto U
                $u->setEmail($email); // Instamcia del objeto U

                if ($tipousuario == '1') {
                    $u->r('ROLE_ADMINISTRADOR'); // Instancia del objeto U  
                } else {
                    $u->r('ROLE_USUARIO'); // Instancia del objeto U
                }


                $userManager->updateUser($u); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush(); //Guarda en la base de datos U

                $em = $this->getDoctrine()->getManager(); //

                $fechaRegistro = new \DateTime("now");
                //$modified = $fechaRegistro->setTimezone(new \DateTimezone("America/Bogota"));
                $usr = $em->getRepository('GSUsuarioBundle:User')->findBy(array('username' => $numeroDocumentoIdentidad)); // Busqueda del usuario por el numero de documento de identidad
                $usuario->setUser($usr[0]); //Instancia del objeto usuario
                $usuario->setFecharegistro($fechaRegistro); //Instancia del objeto usuario

                $em = $this->getDoctrine()->getManager(); //
                $em->persist($usuario); //
                $em->flush(); //Guarda en la base de datos U

                return $this->redirect($this->generateUrl('gs_usuario_buscar'));
            }
        }

        return $this->render('GSUsuarioBundle:Administrar:crear.html.twig', array('formUsuario' => $formUsuario->createView()));
    }

    public function ModificarAction(Request $request, $id, $mensaje) {
        $usuario = new Usuario(); // Objeto del modelos Usuario
        $usuarioType = new UsuarioType();
        $userType = new UserType();
        $u = new User(); // Objeto del modelo User
        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $user = $userManager->createUser();
        $em = $this->getDoctrine()->getManager();
        /*
         * CONSULTA
         */
        $usuario = $em->getRepository('GSUsuarioBundle:Usuario')->find($id);
        $u = $userManager->findUserByUsername($id);

        /*
         * FORMULARIO
         */
        $formUsuario = $this->createForm($usuarioType, $usuario); //Formulario para el registro de los usuarios 
        $formUser = $this->createForm($userType);


        if ($request->getMethod() == 'POST') {
            $formUsuario->handleRequest($request); // Asignacion de valores obtenidos en el request al formulario formUsuario
            $formUser->handleRequest($request);
            if ($formUsuario->isValid()) {
                $numeroDocumentoIdentidad = $formUsuario->get('numerodocumentoidentidad')->getData(); // Se obtiene el valor del campo numerodocumentoidentidad
                $email = $formUsuario->get('email')->getData(); // Se obtiene el valor del campo email
                $password = $formUser->get('password')->getData(); // Se obtiene el valor del campo password
                $enable = $formUsuario->get('enable')->getData(); // Se obtiene el valor del campo enable          
                $tipousuario = $formUsuario->get('tipousuario')->getViewData(); // Se obtiene el valor del campo tipousuario

                $u->setUsername($numeroDocumentoIdentidad); // Intancia del objeto U
                $u->setEnabled($enable); // Instancia del objeto U
                $u->setEmail($email); // Instamcia del objeto U
                if ($password) {
                    $u->setPlainPassword($password); // Instancia del objeto U
                }
                if ($tipousuario == '1') {
                    $u->r('ROLE_ADMINISTRADOR'); // Instancia del objeto U  
                } else {
                    $u->r('ROLE_USUARIO'); // Instancia del objeto U
                }
                $userManager->updateUser($u, false); //Actualizacion del contenido del manejador
                $this->getDoctrine()->getManager()->flush(); //Guarda en la base de datos U

                $em = $this->getDoctrine()->getManager(); //

                $fechaRegistro = new \DateTime("now");
                $modified = $fechaRegistro->setTimezone(new \DateTimezone("America/Bogota"));
                $usr = $em->getRepository('GSUsuarioBundle:User')->findBy(array('username' => $numeroDocumentoIdentidad)); // Busqueda del usuario por el numero de documento de identidad
                $usuario->setUser($usr[0]); //Instancia del objeto usuario
                $usuario->setFecharegistro($modified); //Instancia del objeto usuario

                $em = $this->getDoctrine()->getManager(); //
                $em->persist($usuario); //
                $em->flush(); //Guarda en la base de datos U
                $mensaje = "1";
                return $this->redirect($this->generateUrl('gs_usuario_modificar', array('id' => $id, 'mensaje' => $mensaje)));
            }
            $mensaje = "0";
        }

        return $this->render('GSUsuarioBundle:Administrar:modificar.html.twig', array('formUser' => $formUser->createView(), 'formUsuario' => $formUsuario->createView(), 'id' => $id, 'mensaje' => $mensaje, 'email' => $u->getEmail()));
    }

    public function AgregarespaciotrabajoAction() {
        $tema = new Tema();
        $em = $this->getDoctrine()->getManager();
        $temasDisponibles = $em->getRepository('GSUsuarioBundle:Tema')->findBy(array('estado' => true));
        return $this->render('GSUsuarioBundle:Administrar:agregarespaciotrabajo.html.twig', array('temasDisponibles' => $temasDisponibles));
    }

    public function EliminarAction($id) {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('GSUsuarioBundle:Usuario')->find($id);
        $em->remove($usuario);
        $em->flush();

        return $this->redirect($this->generateUrl('gs_usuario_buscar'));
    }

    public function BuscarAction($limite, $parametro) {
        $em = $this->getDoctrine()->getManager();
        $usuario = new Usuario();
        if ($parametro != "" || $parametro == "XXX") {
            $usuario = $em->getRepository('GSUsuarioBundle:Usuario')->buscarUsuarios($parametro, $limite);
        } else {
            $usuario = $em->getRepository('GSUsuarioBundle:Usuario')->findBy(array(), array('fecharegistro' => 'DESC'), $limite);
        }

        return $this->render('GSUsuarioBundle:Administrar:buscar.html.twig', array('usuarios' => $usuario, 'limite' => $limite));
    }

}

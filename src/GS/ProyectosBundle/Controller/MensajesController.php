<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Entity\Mensajeenviado;
use GS\ProyectosBundle\Entity\Mensajerecibido;
use GS\ProyectosBundle\Entity\Usuario;
use GS\ProyectosBundle\Entity\User;
use GS\ProyectosBundle\Form\MensajeenviadoType;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;

class MensajesController extends Controller {
    /*
     * Con este Action, se almacenan los datos en la tabalas MensajeEnviado
     * y MensajeRecibido respectivamente, a trasves de los Modelos Mensajeenviado y
     * Mensajerecibido. 
     * El remitente es tomado de la sesión. 
     * El value de los posibles destinatarios mostrado es el email, del modelo User. 
     * Para recuperar el usuario, primero se realiza una busqueda del Username del modelo User
     * como condición el correo electronico. 
     * Luego se realiza la consulta en el modelo Usuario usando como condición el Username. 
     */

    public function EnviarAction(Request $request) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager(); //Instancia del manejador de doctrine

        $identificadorFecha = new IdentificadorFecha(); //Objeto de la clase identificador fecha
        $mensajeEnviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
        $usuario = new Usuario(); //Objeto del modelo Usuario. Se intanciara con los datos del usuario de la sesion
        $usuarios = new Usuario(); //Objeto del modelo Usuario. Se asignan todos los usuarios disponibles. 
        $destinatario = new Usuario(); //Objeto del modelo Usuario. 
        $users = new User(); //Objeto del modelo User. 
        $formMensajeEnviado = $this->createForm(new MensajeenviadoType(), $mensajeEnviado); //Formulario del modelo MensajeEnviado
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);

        if ($request->getMethod() == 'POST') {
            $formMensajeEnviado->handleRequest($request);
            if ($formMensajeEnviado->isValid()) {
                $para = $request->request->get('para');
                $mensaje = $request->request->get('editor');
                $fechaRegistro = new \DateTime("now");
                $asunto = $formMensajeEnviado->get('asunto')->getData();
                foreach ($para as $value) { //El registro se crea para cada destinatario
                    $enviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
                    $recibido = new Mensajerecibido(); //Objeto del modelo Mensajerecibido
                    $em = $this->getDoctrine()->getManager();
                    $users = $em->getRepository('GSProyectosBundle:User')->findBy(array('email' => $value));
                    $destinatario = $em->getRepository('GSProyectosBundle:Usuario')->findBy(array('numerodocumentoidentidad' => $users[0]->getUsername()));
                    /*
                     * Se toma la fecha del momento en el servidor. 
                     */
                    $enviado->setFecha($fechaRegistro);
                    $recibido->setFecha($fechaRegistro);
                    /*
                     * Se instancia el id del mensaje enviado con la nueva llave primari
                     */
                    $ultimoRegistro = $em->getRepository('GSProyectosBundle:Mensajerecibido')->buscarUltimoMensajeRecibido();
                    $recibido->setIdmensajerecibido($identificadorFecha->generarIdMensajeRecibido($ultimoRegistro));

                    $ultimoRegistro = $em->getRepository('GSProyectosBundle:Mensajeenviado')->buscarUltimoMensajeEnviado();
                    $enviado->setIdmensajeenviado($identificadorFecha->generarIdMensajeEnviado($ultimoRegistro));

                    $recibido->setMensaje($mensaje);
                    $recibido->setDe($usuario);
                    $recibido->setPara($destinatario[0]);
                    $recibido->setAsunto($asunto);
                    //
                    $enviado->setMensaje($mensaje);
                    $enviado->setDe($usuario);
                    $enviado->setPara($destinatario[0]);
                    $enviado->setAsunto($asunto);
                    //
                    $em->persist($enviado);
                    $em->flush($enviado);
                    //
                    $em->persist($recibido);
                    $em->flush($recibido);
                    return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
                }
            }
        }
        $usuarios = $em->getRepository('GSProyectosBundle:Usuario')->findBy(array(), array('primernombre' => 'ASC'));

        return $this->render('GSProyectosBundle:Mensajes:Enviar.html.twig', array('formMensajeEnviado' => $formMensajeEnviado->createView(), 'usuarios' => $usuarios));
    }

    public function LeerAction() {
        
    }

    public function EliminarAction() {
        
    }

    public function BuscarAction() {
        return $this->render('GSProyectosBundle:Mensajes:Buscar.html.twig');
    }

    public function BuscarenviadoAction() {
        
    }

    public function BuscareliminadoAction() {
        
    }

    public function RestaurarAction() {
        
    }

    public function NumeromensajesAction() {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $recibido = new Mensajerecibido();
        $em = $this->getDoctrine()->getManager();
        $recibido = $em->getRepository('GSProyectosBundle:Mensajerecibido')->contarMensajesNoLeidos($user);
        

        return $this->render('GSProyectosBundle:Mensajes:Numeromensajes.html.twig', array('recibido' => $recibido[0]));
    }

}

<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Entity\Mensajeenviado;
use GS\ProyectosBundle\Entity\Mensajerecibido;
use GS\ProyectosBundle\Entity\Mensajeborrado;
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
        try {
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
                    $integrantes = $request->request->get('integrantes');
                    $exintegrantes = $request->request->get('exintegrantes');
                    $mensaje = $request->request->get('editor');
                    $fechaRegistro = new \DateTime("now");
                    $asunto = $formMensajeEnviado->get('asunto')->getData();
                    if ($para) {
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

                            $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                                    ->setSubject($asunto)
                                    ->setFrom($usuario->getUser()->getEmail())
                                    ->setTo($destinatario[0]->getUser()->getEmail())
                                    ->setBody(
                                    $this->renderView(
                                            'GSProyectosBundle:Mensajes:emailnotificacion.html.twig'
                                    ), 'text/html'
                            );
                            $this->get('mailer')->send($message);
                        }
                        return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
                    } elseif ($exintegrantes && $integrantes) {
                        $todos = $em->getRepository('GSProyectosBundle:User')->findAll();
                        foreach ($todos as $value) { //El registro se crea para cada destinatario
                            $enviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
                            $recibido = new Mensajerecibido(); //Objeto del modelo Mensajerecibido
                            $em = $this->getDoctrine()->getManager();

                            $destinatario = $em->getRepository('GSProyectosBundle:Usuario')->findOneBy(array('numerodocumentoidentidad' => $value->getUsername()));
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
                            $recibido->setPara($destinatario);
                            $recibido->setAsunto($asunto);
                            //
                            $enviado->setMensaje($mensaje);
                            $enviado->setDe($usuario);
                            $enviado->setPara($destinatario);
                            $enviado->setAsunto($asunto);
                            //
                            $em->persist($enviado);
                            $em->flush($enviado);
                            //
                            $em->persist($recibido);
                            $em->flush($recibido);



                            $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                                    ->setSubject($asunto)
                                    ->setFrom($usuario->getUser()->getEmail())
                                    ->setTo($destinatario->getUser()->getEmail())
                                    ->setBody(
                                    $this->renderView(
                                            'GSProyectosBundle:Mensajes:emailnotificacion.html.twig'
                                    ), 'text/html'
                            );
                            $this->get('mailer')->send($message);
                        }
                        return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
                    } elseif ($integrantes) {
                        $integrantes = new User();
                        $integrantes = $em->getRepository('GSProyectosBundle:User')->findBy(array('enabled' => true));

                        foreach ($integrantes as $value) { //El registro se crea para cada destinatario
                            $enviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
                            $recibido = new Mensajerecibido(); //Objeto del modelo Mensajerecibido
                            $destinatario = new Usuario();
                            $em = $this->getDoctrine()->getManager();

                            $destinatario = $em->getRepository('GSProyectosBundle:Usuario')->findOneBy(array('numerodocumentoidentidad' => $value->getUsername()));
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
                            $recibido->setPara($destinatario);
                            $recibido->setAsunto($asunto);
                            //
                            $enviado->setMensaje($mensaje);
                            $enviado->setDe($usuario);
                            $enviado->setPara($destinatario);
                            $enviado->setAsunto($asunto);
                            //
                            $em->persist($enviado);
                            $em->flush($enviado);
                            //
                            $em->persist($recibido);
                            $em->flush($recibido);


                            $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                                    ->setSubject($asunto)
                                    ->setFrom($usuario->getUser()->getEmail())
                                    ->setTo($destinatario->getUser()->getEmail())
                                    ->setBody(
                                    $this->renderView(
                                            'GSProyectosBundle:Mensajes:emailnotificacion.html.twig'
                                    ), 'text/html'
                            );
                            $this->get('mailer')->send($message);
                        }
                        return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
                    } else if ($exintegrantes) {
                        $exintegrantes = $em->getRepository('GSProyectosBundle:User')->findBy(array('enabled' => false));

                        foreach ($exintegrantes as $value) { //El registro se crea para cada destinatario
                            $enviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
                            $recibido = new Mensajerecibido(); //Objeto del modelo Mensajerecibido
                            $em = $this->getDoctrine()->getManager();

                            $destinatario = $em->getRepository('GSProyectosBundle:Usuario')->findOneBy(array('numerodocumentoidentidad' => $value->getUsername()));
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
                            $recibido->setPara($destinatario);
                            $recibido->setAsunto($asunto);
                            //
                            $enviado->setMensaje($mensaje);
                            $enviado->setDe($usuario);
                            $enviado->setPara($destinatario);
                            $enviado->setAsunto($asunto);
                            //
                            $em->persist($enviado);
                            $em->flush($enviado);
                            //
                            $em->persist($recibido);
                            $em->flush($recibido);



                            $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                                    ->setSubject($asunto)
                                    ->setFrom($usuario->getUser()->getEmail())
                                    ->setTo($destinatario->getUser()->getEmail())
                                    ->setBody(
                                    $this->renderView(
                                            'GSProyectosBundle:Mensajes:emailnotificacion.html.twig'
                                    ), 'text/html'
                            );
                            $this->get('mailer')->send($message);
                        }
                        return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
                    }
         
                    return $this->redirect($this->generateUrl('gs_proyectos_mensajes_enviar' ));
                }
            }
            $usuarios = $em->getRepository('GSProyectosBundle:Usuario')->findBy(array(), array('primernombre' => 'ASC'));

            return $this->render('GSProyectosBundle:Mensajes:Enviar.html.twig', array('formMensajeEnviado' => $formMensajeEnviado->createView(), 'usuarios' => $usuarios));
        } catch (\Exception $exc) {
            echo $exc->getTraceAsString();
            return $this->redirect($this->generateUrl('gs_contenidos_errores_alertageneral'));
        }
    }

    public function LeerAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $mensajeRecibido = new Mensajerecibido();
        $em = $this->getDoctrine()->getManager();
        $mensajeRecibido = $em->getRepository('GSProyectosBundle:MensajeRecibido')->find($id);
        if ($user == $mensajeRecibido->getPara()->getNumerodocumentoidentidad()) {

            $mensajeRecibido->setRevisado(true);
            $em->persist($mensajeRecibido);
            $em->flush($mensajeRecibido);


            $mensaje = html_entity_decode($mensajeRecibido->getMensaje()); //Decodificar caracteres especiales utiliciados para almacenar el mensaje

            return $this->render('GSProyectosBundle:Mensajes:Leer.html.twig', array('mensajeRecibido' => $mensajeRecibido, 'mensaje' => $mensaje));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        }
    }

    public function LeerenviadoAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $mensajeEnviado = new Mensajeenviado();
        $em = $this->getDoctrine()->getManager();
        $mensajeEnviado = $em->getRepository('GSProyectosBundle:Mensajeenviado')->find($id);
        if ($user == $mensajeEnviado->getDe()->getNumerodocumentoidentidad()) {
            $mensaje = html_entity_decode($mensajeEnviado->getMensaje()); //Decodificar caracteres especiales utiliciados para almacenar el mensaje
            return $this->render('GSProyectosBundle:Mensajes:Leer.html.twig', array('mensajeRecibido' => $mensajeEnviado, 'mensaje' => $mensaje));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        }
    }

    public function LeereliminadoAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $mensajeBorrado = new Mensajeborrado();
        $em = $this->getDoctrine()->getManager();
        $mensajeBorrado = $em->getRepository('GSProyectosBundle:Mensajeborrado')->find($id);
        if ($user == $mensajeBorrado->getPara()->getNumerodocumentoidentidad()) {
            $mensaje = html_entity_decode($mensajeBorrado->getMensaje()); //Decodificar caracteres especiales utiliciados para almacenar el mensaje
            return $this->render('GSProyectosBundle:Mensajes:Leer.html.twig', array('mensajeRecibido' => $mensajeBorrado, 'mensaje' => $mensaje));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        }
    }

    public function EliminarborradoAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $mensajeborrado = new Mensajeborrado();
        $em = $this->getDoctrine()->getManager();
        $mensajeborrado = $em->getRepository('GSProyectosBundle:Mensajeborrado')->find($id);
        if ($user == $mensajeborrado->getPara()->getNumerodocumentoidentidad()) {
            $em->remove($mensajeborrado);
            $em->flush($mensajeborrado);
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscareliminado'));
        }
    }

    public function EliminarenviadoAction(Request $request) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $id = $request->request->get('radioMensaje');

        $em = $this->getDoctrine()->getManager();
        foreach ($id as $value) {
            $mensajeenviado = new Mensajeenviado();
            $mensajeenviado = $em->getRepository('GSProyectosBundle:Mensajeenviado')->find($value);
            if ($user == $mensajeenviado->getDe()->getNumerodocumentoidentidad()) {
                $em->remove($mensajeenviado);
                $em->flush($mensajeenviado);
            }
        }
        return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscarenviado'));
    }

    public function EliminarAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $identificadorFecha = new IdentificadorFecha(); //Objeto de la clase identificador fecha
        $mensajeRecibido = new Mensajerecibido();
        $mensajeBorrado = new Mensajeborrado();
        $em = $this->getDoctrine()->getManager();
        $mensajeRecibido = $em->getRepository('GSProyectosBundle:Mensajerecibido')->find($id);
        if ($user == $mensajeRecibido->getPara()->getNumerodocumentoidentidad()) {
            $fechaRegistro = new \DateTime("now");
            $ultimoRegistro = $em->getRepository('GSProyectosBundle:Mensajeborrado')->buscarUltimoMensajeBorrado();
            $mensajeBorrado->setIdmensajeborrado($identificadorFecha->generarIdMensajeBorrado($ultimoRegistro));
            $mensajeBorrado->setAsunto($mensajeRecibido->getAsunto());
            $mensajeBorrado->setMensaje($mensajeRecibido->getMensaje());
            $para = $em->getRepository('GSProyectosBundle:Usuario')->find($mensajeRecibido->getPara()->getNumerodocumentoidentidad());
            $de = $em->getRepository('GSProyectosBundle:Usuario')->find($mensajeRecibido->getDe()->getNumerodocumentoidentidad());
            $mensajeBorrado->setPara($para);
            $mensajeBorrado->setDe($de);
            $mensajeBorrado->setRevisado($mensajeRecibido->getRevisado());
            $mensajeBorrado->setFecha($fechaRegistro);

            $em->persist($mensajeBorrado);
            $em->flush($mensajeBorrado);

            $em->remove($mensajeRecibido);
            $em->flush($mensajeRecibido);

            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        }
    }

    public function BuscarAction($limite) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $mensajeRecibido = new Mensajerecibido();
        $em = $this->getDoctrine()->getManager();
        $mensajeRecibido = $em->getRepository('GSProyectosBundle:MensajeRecibido')->findBy(array('para' => $user), array('fecha' => 'DESC'), $limite);
        return $this->render('GSProyectosBundle:Mensajes:Buscar.html.twig', array('recibidos' => $mensajeRecibido, 'limite' => $limite));
    }

    public function BuscarenviadoAction($limite) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $limite = 30;
        $mensajeEnviado = new Mensajeenviado();
        $em = $this->getDoctrine()->getManager();
        $mensajeEnviado = $em->getRepository('GSProyectosBundle:Mensajeenviado')->findBy(array('de' => $user), array('fecha' => 'DESC'), $limite);
        return $this->render('GSProyectosBundle:Mensajes:Buscarenviado.html.twig', array('enviados' => $mensajeEnviado, 'limite' => $limite));
    }

    public function BuscareliminadoAction($limite) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $mensajeBorrado = new Mensajeborrado();
        $em = $this->getDoctrine()->getManager();
        $mensajeBorrado = $em->getRepository('GSProyectosBundle:Mensajeborrado')->findBy(array('para' => $user), array('fecha' => 'DESC'), $limite);
        return $this->render('GSProyectosBundle:Mensajes:Buscareliminado.html.twig', array('eliminados' => $mensajeBorrado, 'limite' => $limite));
    }

    public function RestaurarAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $identificadorFecha = new IdentificadorFecha(); //Objeto de la clase identificador fecha
        $mensajeRecibido = new Mensajerecibido();
        $mensajeBorrado = new Mensajeborrado();
        $em = $this->getDoctrine()->getManager();
        $mensajeBorrado = $em->getRepository('GSProyectosBundle:Mensajeborrado')->find($id);
        if ($user == $mensajeBorrado->getPara()->getNumerodocumentoidentidad()) {
            $fechaRegistro = new \DateTime("now");
            $ultimoRegistro = $em->getRepository('GSProyectosBundle:Mensajerecibido')->buscarUltimoMensajeRecibido();
            $mensajeRecibido->setIdmensajerecibido($identificadorFecha->generarIdMensajeRecibido($ultimoRegistro));
            $mensajeRecibido->setAsunto($mensajeBorrado->getAsunto());
            $mensajeRecibido->setMensaje($mensajeBorrado->getMensaje());
            $para = $em->getRepository('GSProyectosBundle:Usuario')->find($mensajeBorrado->getPara()->getNumerodocumentoidentidad());
            $de = $em->getRepository('GSProyectosBundle:Usuario')->find($mensajeBorrado->getDe()->getNumerodocumentoidentidad());
            $mensajeRecibido->setPara($para);
            $mensajeRecibido->setDe($de);
            $mensajeRecibido->setRevisado($mensajeBorrado->getRevisado());
            $mensajeRecibido->setFecha($fechaRegistro);

            $em->persist($mensajeRecibido);
            $em->flush($mensajeRecibido);

            $em->remove($mensajeBorrado);
            $em->flush($mensajeBorrado);

            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        }
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

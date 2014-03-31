<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Entity\Tema;
use GS\ProyectosBundle\Entity\Espaciotrabajo;
use GS\ProyectosBundle\Entity\Usuario;
use GS\ProyectosBundle\Entity\TemaUsuario;
use GS\ProyectosBundle\Form\TemaType;
use GS\ProyectosBundle\Form\EspaciotrabajoType;
use GS\ProyectosBundle\Form\TemaUsuarioType;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;

//use Symfony\Component\Serializer\Serializer;
//use Symfony\Component\Serializer\Encoder\XmlEncoder;
//use Symfony\Component\Serializer\Encoder\JsonEncoder;
//use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;

class AdministrartemaController extends Controller {

    public function CrearAction(Request $request) {
        $tema = new Tema();
        $formTema = $this->createForm(new TemaType(), $tema);

        if ($request->getMethod() == 'POST') {
            $formTema->handleRequest($request);
            if ($formTema->isValid()) {

                $descripcion = $request->request->get('editor');
                $tema->setDescripcion($descripcion);
                $fechaRegistro = new \DateTime("now");
                $tema->setFecharegistro($fechaRegistro);
                $fechaInicioPublicacion = $formTema->get('fechainiciopublicacion')->getData();
                if ($fechaInicioPublicacion) {
                    $tema->setFechainiciopublicacion($fechaInicioPublicacion);
                } else {
                    $tema->setFechainiciopublicacion($fechaRegistro);
                }
                $fechaFinPublicacion = $formTema->get('fechafinpublicacion')->getData();
                if ($fechaFinPublicacion) {
                    $tema->setFechafinpublicacion($fechaFinPublicacion);
                }
                $tema->setVecesvisto(0);
                $tema->setFechamodificacion($fechaRegistro);
                $tema->setEstado(true);

                $em = $this->getDoctrine()->getManager();
                $em->persist($tema);
                $em->flush();

                return $this->redirect($this->generateUrl('gs_proyectos_tema_buscar'));
               
            }
        }
        return $this->render('GSProyectosBundle:Administrartema:crear.html.twig', array('formTema' => $formTema->createView()));
    }

    public function ModificarAction() {
        
    }

    public function EliminarAction() {
//        $encoders = array(new XmlEncoder(), new JsonEncoder());
//        $normalizers = array(new GetSetMethodNormalizer());
//
//        $serializer = new Serializer($normalizers, $encoders);
//        $usuario = new Usuario();
//        $em = $this->getDoctrine()->getManager();
//        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->findAll();
//
//        $jsonContent = $serializer->serialize($usuario, 'json');
//
//        echo $jsonContent;
    }

    public function BuscarAction() {
        return $this->render('GSProyectosBundle:Administrartema:buscar.html.twig');
    }

    /*
     * Asignar uno o varios usuarios a un tema. 
     * Al ser asignado un usuario al tema, inmediatamente el tema sera despublicado
     * del banco de temas de la pagina principal. 
     */

    public function AsignarusuarioAction(Request $request, $tema) {
        $temaUsuario = new TemaUsuario(); // Objeto del modelo Tema Usuario
        $identificadorFecha = new IdentificadorFecha(); // Objeto de la calse IdentificarFecha
        $formTemaUsuario = $this->createForm(new TemaUsuarioType, $temaUsuario); // Formulario TemaUsuario
        $em = $this->getDoctrine()->getManager();
        $idTema = $tema;
        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($idTema);

        if ($request->getMethod() == 'POST') {
            $formTemaUsuario->handleRequest($request);
            if ($formTemaUsuario->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $ultimoTemaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->buscarUltimoTemaUsuario(); //Consulta del identificador del ultimo temaUsuario registrado
                $temaUsuario->setIdtemaUsuario($identificadorFecha->generarIdTemaUsuario($ultimoTemaUsuario)); //Se genera el nuevo identificador para temaUsuario y se instancia el modelo
                $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($request->request->get('busquedaUsuario'));
                $temaUsuario->setUsuario($usuario); //Se instancia el modelo temaUsuario con el usuario
                $temaUsuario->setTema($tema);
                $em->persist($temaUsuario);
                $em->flush();

                return $this->redirect($this->generateUrl('gs_proyectos_tema_asignarsuario', array('tema' => $idTema)));
            }
        }

        $usuariosAsignados = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $idTema));
        return $this->render('GSProyectosBundle:Administrartema:asignarusuario.html.twig', array('formTemaUsuario' => $formTemaUsuario->createView(), 'tema' => $tema, 'usuariosAsignados' => $usuariosAsignados));
    }

    public function EliminarusuarioasignadoAction(Request $request, $id) {
        $temaUsuario = new TemaUsuario();
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = $em->getRepository("GSProyectosBundle:TemaUsuario")->find($id);
        $tema = $temaUsuario->getTema()->getIdtema();
        $em->remove($temaUsuario);
        $em->flush();
        return $this->redirect($this->generateUrl('gs_proyectos_tema_asignarsuario', array('tema' => $tema)));
    }

    public function AsignarespaciotrabajoAction(Request $request, $tema) {
        $espacioTrabajo = new Espaciotrabajo();
        $identificadorFecha = new IdentificadorFecha();
        $formEspacioTrabajo = $this->createForm(new EspaciotrabajoType, $espacioTrabajo);
        $em = $this->getDoctrine()->getManager();
        $idTema = $tema;
        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($idTema);

        if ($request->getMethod() == 'POST') {
            $formEspacioTrabajo->handleRequest($request);
     
            if ($formEspacioTrabajo->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $ultimoEspacioTrabajo = $em->getRepository('GSProyectosBundle:Espaciotrabajo')->buscarUltimoEspacioTrabajo();
                $espacioTrabajo->setIdespaciotrabajo($identificadorFecha->generarIdEspacioTrabajo($ultimoEspacioTrabajo));
                $espacioTrabajo->setTema($tema);
                $espacioTrabajo->setCompartirdirector(false);
                $espacioTrabajo->setCompartirmiembros(false);

                $em->persist($espacioTrabajo);
                $em->flush();

                return $this->redirect($this->generateUrl('gs_proyectos_tema_asignarespaciotrabajo', array('tema' => $idTema)));
            }
        }

        $espaciosAsignados = $em->getRepository('GSProyectosBundle:Espaciotrabajo')->findBy(array('tema' => $idTema));
        return $this->render('GSProyectosBundle:Administrartema:asignarespaciotrabajo.html.twig', array('formEspacioTrabajo' => $formEspacioTrabajo->createView(), 'tema' => $tema, 'espaciosAsignados' => $espaciosAsignados));
    }
    
        public function EliminarespaciotrabajoAction(Request $request, $id) {
        $espacioTrabajo = new Espaciotrabajo();
        $em = $this->getDoctrine()->getManager();
        $espacioTrabajo = $em->getRepository("GSProyectosBundle:Espaciotrabajo")->find($id);
        $tema = $espacioTrabajo->getTema()->getIdtema();
        $em->remove($espacioTrabajo);
        $em->flush();
        return $this->redirect($this->generateUrl('gs_proyectos_tema_asignarespaciotrabajo', array('tema' => $tema)));
    }

    /*
     * Buscar usuario con el primer nombre y con el primer apellido para asignar usuario a un tema. 
     * Los usuarios pueden ser de cualquier tipo. 
     */

    public function BuscarusuarioAction($primernombre, $primerapellido) {
        $usuario = new Usuario();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->buscarUsuarios($primernombre, $primerapellido);
        return $this->render('GSProyectosBundle:Administrartema:buscarusuario.html.twig', array('usuarios' => $usuario));
    }

}

<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Entity\Recursos;
use GS\ProyectosBundle\Entity\Usuario;
use GS\ProyectosBundle\Form\RecursosType;

class AdministrarrecursoController extends Controller {

    public function CrearAction(Request $request) {

        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $recurso = new Recursos();
        $usuario = new Usuario();

        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);
        $formRecurso = $this->createForm(new RecursosType(), $recurso);
        if ($request->getMethod() == 'POST') {
            $formRecurso->handleRequest($request);
            if ($formRecurso->isValid()) {
                $descripcion = $request->request->get('editor');
                $fechaRegistro = new \DateTime("now");
                $recurso->setUsuario($usuario);
                $recurso->setDescripcion($descripcion);
                $recurso->setFecharegistro($fechaRegistro);
                $recurso->setFechamodificacion($fechaRegistro);
                $fechaInicio = $formRecurso->get('fechainiciopublicacion')->getData();
                if (!$fechaInicio) {
                    $recurso->setFechainiciopublicacion($fechaRegistro);
                }

                $em->persist($recurso);
                $em->flush($recurso);

                return $this->redirect($this->generateUrl('gs_proyectos_recursos_buscar'));
            }
        }
        return $this->render('GSProyectosBundle:Administrarrecurso:Crear.html.twig', array('formRecurso' => $formRecurso->createView()));
    }

    public function ModificarAction(Request $request, $id) {


        $recurso = new Recursos();
        $em = $this->getDoctrine()->getManager();
        $recurso = $em->getRepository('GSProyectosBundle:Recursos')->find($id);
        $formRecurso = $this->createForm(new RecursosType(), $recurso);
        if ($request->getMethod() == 'POST') {
            $formRecurso->handleRequest($request);
            if ($formRecurso->isValid()) {
                $descripcion = $request->request->get('editor');
                $recurso->setDescripcion($descripcion);
                $em->persist($recurso);
                $em->flush($recurso);
                return $this->redirect($this->generateUrl('gs_proyectos_recursos_modificar', array('id' => $id)));
            }
        }
        $descripcionRecurso = html_entity_decode($recurso->getDescripcion());
        return $this->render('GSProyectosBundle:Administrarrecurso:Modificar.html.twig', array('formRecurso' => $formRecurso->createView(), 'descripcion' => $descripcionRecurso, 'id' => $id));
    }

    public function EliminarAction($id) {
        $em = $this->getDoctrine()->getManager();
        $recursos = new Recursos();
        $recursos = $em->getRepository('GSProyectosBundle:Recursos')->find($id);
        $em->remove($recursos);
        $em->flush();
        return $this->redirect($this->generateUrl('gs_proyectos_recursos_buscar'));
    }

    public function BuscarAction() {
        $em = $this->getDoctrine()->getManager();
        $recursos = new Recursos();
        $recursos = $em->getRepository('GSProyectosBundle:Recursos')->findBy(array(), array('idrecursos' => 'DESC'), 30);
        return $this->render('GSProyectosBundle:Administrarrecurso:Buscar.html.twig', array('recursos' => $recursos));
    }

}

<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Seminario;
use GS\ProyectosBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Form\SeminarioType;

class AdministrarseminarioController extends Controller {
    /*
     * Acción para crear un nuevo seminario. 
     */

    public function CrearAction(Request $request) {

        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();

        $seminario = new Seminario();
        $usuario = new Usuario();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);

        $formSeminario = $this->createForm(new SeminarioType(), $seminario);

        if ($request->getMethod() == "POST") {
            $formSeminario->handleRequest($request);
            if ($formSeminario->isValid()) {
                $descripcion = $request->request->get('editor');
                $seminario->setDescripcion($descripcion);

                $fechaRegistro = new \DateTime("now");
                $seminario->setFecharegistro($fechaRegistro);
                $seminario->setFechamodificacion($fechaRegistro);
                if (!$formSeminario->get('fechainiciopublicacion')->getData()) {
                    $seminario->setFechainiciopublicacion($fechaRegistro);
                }
                $seminario->setUsuario($usuario);

                $em->persist($seminario);
                $em->flush();

                return $this->redirect($this->generateUrl('gs_proyectos_seminarios_buscar'));
            }
        }
        return $this->render('GSProyectosBundle:Administrarseminario:Crear.html.twig', array('formSeminario' => $formSeminario->createView()));
    }

    /*
     * Accion para modificar seminario.
     * Se recibe el idseminario del modelo Seminario
     */

    public function ModificarAction(Request $request, $id) {

        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();

        $seminario = new Seminario();
        $usuario = new Usuario();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->find($id);
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);

        $formSeminario = $this->createForm(new SeminarioType(), $seminario);

        if ($request->getMethod() == "POST") {
            $formSeminario->handleRequest($request);
            if ($formSeminario->isValid()) {
                $descripcion = $request->request->get('editor');
                $seminario->setDescripcion($descripcion);
                $fechaRegistro = new \DateTime("now");
                $seminario->setFechamodificacion($fechaRegistro);
                $seminario->setUsuario($usuario);
                $em->persist($seminario);
                $em->flush();

                return $this->redirect($this->generateUrl('gs_proyectos_seminarios_buscar'));
            }
        }
        $descripcionSeminario = html_entity_decode($seminario->getDescripcion());

        return $this->render('GSProyectosBundle:Administrarseminario:Modificar.html.twig', array('descripcion' => $descripcionSeminario, 'idSeminario' => $id, 'formSeminario' => $formSeminario->createView()));
    }

    /*
     * Accion para eliminar seminario.
     * Se recibe el idseminario del modelo Seminario
     */

    public function BuscarAction() {
        $seminario = new Seminario();
        $em = $this->getDoctrine()->getManager();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->findBy(array(), array('fecharegistro' => 'DESC'), 30);
        return $this->render('GSProyectosBundle:Administrarseminario:Buscar.html.twig', array('seminarios' => $seminario));
    }

    public function EliminarAction($id) {
        $em = $this->getDoctrine()->getManager();
        $seminario = new Seminario();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->find($id);
        $em->remove($seminario);
        $em->flush();

        return $this->redirect($this->generateUrl('gs_proyectos_seminarios_buscar'));
    }

}

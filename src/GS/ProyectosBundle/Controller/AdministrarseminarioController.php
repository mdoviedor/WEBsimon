<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Seminario;
use GS\ProyectosBundle\Entity\Categoriapublicacion;
use GS\ProyectosBundle\Entity\CategoriaSeminario;
use GS\ProyectosBundle\Entity\Usuario;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;
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

        $categoriaPublicacion = new Categoriapublicacion();
        $categoriaSeminario = new CategoriaSeminario();
        $identificadorFecha = new IdentificadorFecha();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);
        $categoriaPublicacion = $em->getRepository('GSProyectosBundle:Categoriapublicacion')->findAll();

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

                /*
                 * Guardar Categoría
                 */
                $categoria = $request->request->get('categoriaPublicacion');
                $contador;
                if ($categoria) {
                    foreach ($categoria as $value) {
                        $categoriaSeminario = new CategoriaSeminario();
                        $ultimoRegistro = new CategoriaSeminario();
                        $ultimoRegistro = $em->getRepository('GSProyectosBundle:CategoriaSeminario')->findBy(array(), array('idcategoriaSeminario' => 'DESC'), 1);
                        $categoriaSeminario->setIdcategoriaSeminario($identificadorFecha->generarIdCategoriaSeminario($ultimoRegistro[0]->getIdcategoriaSeminario()));
                        $categoriaSeminario->setSeminario($seminario);
                        $categoriaPublicacion = $em->getRepository('GSProyectosBundle:Categoriapublicacion')->find($value);
                        $categoriaSeminario->setCategoriapublicacion($categoriaPublicacion);
                        $em->persist($categoriaSeminario);
                        $em->flush();
                    }
                }

                return $this->redirect($this->generateUrl('gs_proyectos_seminarios_buscar'));
            }
        }
        return $this->render('GSProyectosBundle:Administrarseminario:Crear.html.twig', array('categoriaPublicacion' => $categoriaPublicacion, 'formSeminario' => $formSeminario->createView()));
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

        $categoriaPublicacion = new Categoriapublicacion();
        $categoriaSeminario = new CategoriaSeminario();
        $identificadorFecha = new IdentificadorFecha();
        $seminario = new Seminario();
        $usuario = new Usuario();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->find($id);
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);
        $categoriaPublicacion = $em->getRepository('GSProyectosBundle:Categoriapublicacion')->findAll();
        $categoriaSeminario = $em->getRepository('GSProyectosBundle:CategoriaSeminario')->findBy(array('seminario' => $id));

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

                /*
                 * Eliminar Categoría Seminario                 
                 */

                if ($categoriaSeminario) {
                    foreach ($categoriaSeminario as $value) {
                        $em = $this->getDoctrine()->getManager();
                        $em->remove($value);
                        $em->flush();
                    }
                }

                /*
                 * Guardar Categoría
                 */
                $categoria = $request->request->get('categoriaPublicacion');
                if ($categoria) {
                    foreach ($categoria as $value) {
                        $categoriaSeminario = new CategoriaSeminario();
                        $ultimoRegistro = new CategoriaSeminario();
                        $ultimoRegistro = $em->getRepository('GSProyectosBundle:CategoriaSeminario')->findBy(array(), array('idcategoriaSeminario' => 'DESC'), 1);
                        $categoriaSeminario->setIdcategoriaSeminario($identificadorFecha->generarIdCategoriaSeminario($ultimoRegistro[0]->getIdcategoriaSeminario()));
                        $categoriaSeminario->setSeminario($seminario);
                        $categoriaPublicacion = $em->getRepository('GSProyectosBundle:Categoriapublicacion')->find($value);
                        $categoriaSeminario->setCategoriapublicacion($categoriaPublicacion);
                        $em->persist($categoriaSeminario);
                        $em->flush();
                    }

                    return $this->redirect($this->generateUrl('gs_proyectos_seminarios_buscar'));
                }
            }
        }
        $descripcionSeminario = html_entity_decode($seminario->getDescripcion());

        return $this->render('GSProyectosBundle:Administrarseminario:Modificar.html.twig', array('categoriaPublicacion' => $categoriaPublicacion, 'categoriaSeminario' => $categoriaSeminario, 'descripcion' => $descripcionSeminario, 'idSeminario' => $id, 'formSeminario' => $formSeminario->createView()));
    }

    /*
     * Accion para eliminar seminario.
     * Se recibe el idseminario del modelo Seminario
     */

    public function BuscarAction(Request $request, $limite, $parametro) {
        $seminario = new Seminario();
        $em = $this->getDoctrine()->getManager();
        $valor = null;
        if ($parametro == 'XXX') {
            $seminario = $em->getRepository('GSProyectosBundle:Seminario')->findBy(array(), array('fecharegistro' => 'DESC'), $limite);
        } else {
            $valor = $parametro;
            $seminario = $em->getRepository('GSProyectosBundle:Seminario')->buscarSeminarioParametro($limite, $parametro);
        }
        return $this->render('GSProyectosBundle:Administrarseminario:Buscar.html.twig', array('seminarios' => $seminario, 'valor' => $valor, 'limite' => $limite));
    }

    public function EliminarAction($id) {
        $em = $this->getDoctrine()->getManager();
        $seminario = new Seminario();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->find($id);
        $em->remove($seminario);
        $em->flush();

        return $this->redirect($this->generateUrl('gs_proyectos_seminarios_buscar'));
    }

    /*
     * Vista de un listado de seminarios propuesto por usuario. 
     * Se recibe la variable limite, correspondiente al numero total de resultados que se mostraran
     * No se pueden ver los seminarios en estado no publico (Estado = false).
     */

    public function VistaseminarioAction($limite) {
        $seminario = new Seminario();
        $em = $this->getDoctrine()->getManager();
        $seminario = $em->getRepository('GSProyectosBundle:Seminario')->findBy(array('estado' => true), array('fecharegistro' => 'DESC'), $limite);

        return $this->render('GSProyectosBundle:Administrarseminario:Vistaseminario.html.twig', array('seminarios' => $seminario, 'limite' => $limite));
    }

}

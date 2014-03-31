<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use GS\ProyectosBundle\Entity\TemaUsuario;
use GS\ProyectosBundle\Entity\Tema;

class DesarrollarproduccionintelectualController extends Controller {

    public function BuscarAction() {
        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:buscar.html.twig');
    }

    public function AgregarbibliografiaAction() {
        
    }

    public function EliminarbibliografiaAction() {
        
    }

    public function ModificarbibliografiaAction() {
        
    }

    public function BuscarbibliografiaAction() {
        
    }

    public function AgregaractividadcronogramaAction() {
        
    }

    public function EliminaractividadcronogramaAction() {
        
    }

    public function ModificaractividadcronogramaAction() {
        
    }

    public function VistaAction($id) {

        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */

        $temaUsuario = new TemaUsuario(); // Objeto del modelo TemaUsuario
        $em = $this->getDoctrine()->getManager(); // Manejador
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id)); // Consulta 

        /*
         *Si el usuario es participante del proyecto podra ver el entorno de 
         * trabajo para desarrollar la produccion intelectual 
         */
        foreach ($temaUsuario as $value) {             
            if ($value->getUsuario()->getNumerodocumentoidentidad() == $user) {
                return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:vista.html.twig', array('temaUsuario' => $temaUsuario, 'user' => $user));
            }
        }
        return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_buscar')); // Ruta tomada si el usuario que intenta acceder no tiene privilegios.
    }

}

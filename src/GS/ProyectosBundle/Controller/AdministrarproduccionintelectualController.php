<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Produccionintelectual;
use GS\ProyectosBundle\Form\ProduccionintelectualType;
use GS\ProyectosBundle\Entity\TemaUsuario;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;

class AdministrarproduccionintelectualController extends Controller {

    public function CrearAction(Request $request) {
        $produccionIntelectual = new Produccionintelectual();
        $identircarFecha = new IdentificadorFecha();
        $formProduccionIntelectual = $this->createForm(new ProduccionintelectualType(), $produccionIntelectual);

        if ($request->getMethod() == 'POST') {
            $formProduccionIntelectual->handleRequest($request);
            if($formProduccionIntelectual->isValid()){
                $em = $this->getDoctrine()->getManager();
                $ultimoRegistro = $em->getRepository('GSProyectosBundle:ProduccionIntelectual')->buscarUltimoProduccionIntelectual();
                $produccionIntelectual->setIdproduccionintelectual($identircarFecha->generarIdProduccionIntelectual($ultimoRegistro));
                
                $identircarFecha->generarIdProduccionIntelectual($ultimoRegistro);
            }
        }



        return $this->render('GSProyectosBundle:Administrarproduccionintelectual:crear.html.twig', array('formProduccionIntelectual' => $formProduccionIntelectual->createView()));
    }

    public function ModificarAction() {
        
    }

    public function EliminarAction() {
        
    }

    public function BuscarAction() {
        
    }

    public function BuscarparticipantesAction($id) {
        $temaUsuario = new TemaUsuario();
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id));

        return $this->render('GSProyectosBundle:Administrarproduccionintelectual:buscarparticipantes.html.twig', array('temaUsuario' => $temaUsuario));
    }

}

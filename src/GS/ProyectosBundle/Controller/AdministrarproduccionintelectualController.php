<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Produccionintelectual;
use GS\ProyectosBundle\Form\ProduccionintelectualType;
use GS\ProyectosBundle\Entity\TemaUsuario;
use GS\ProyectosBundle\Entity\Tema;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AdministrarproduccionintelectualController extends Controller {
    /*
     * Cargar un nuevo archivo en .zip correspondiente a la produccion intelectual 
     * desarrollada y terminada.
     */
    public function CrearAction(Request $request) {
        $produccionIntelectual = new Produccionintelectual(); // objeto del Modelo Produccionintelectual
        $tema = new Tema(); // objeto del Modelo Tema
        $identircarFecha = new IdentificadorFecha(); // Objeto de la clase Identificador fecha
        $formProduccionIntelectual = $this->createForm(new ProduccionintelectualType(), $produccionIntelectual); //Formulario del modelo Produccionintelectual
        $mensaje = 0;

        if ($request->getMethod() == 'POST') {
            $formProduccionIntelectual->bind($request);
            if ($formProduccionIntelectual->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $ultimoRegistro = $em->getRepository('GSProyectosBundle:ProduccionIntelectual')->buscarUltimoProduccionIntelectual(); // Obtener el ultimo registro hecho en Produccionintelectual
                $produccionIntelectual->setIdproduccionintelectual($identircarFecha->generarIdProduccionIntelectual($ultimoRegistro)); // Crear e instanciar la llave primaria en Produccionintelectual

                $fechaRegistro = new \DateTime("now"); //Obtener la fecha de ahora.

                $fechaInicioPublicacion = $formProduccionIntelectual->get('fechainiciopublicacion')->getData(); // Se obtenie la fecha registrada en el formulario
                if (!$fechaInicioPublicacion) { // Si la fecha en nula, se le asigna la fecha de ahora. 
                    $produccionIntelectual->setFechainiciopublicacion($fechaRegistro);
                }
                $produccionIntelectual->setFechamodificacion($fechaRegistro); //Instancia del modelo Produccionintelectual, fechamodificacion
                $produccionIntelectual->setFecharegistro($fechaRegistro); //Instancia del modelo Produccionintelectual, fecharegistro
                $produccionIntelectual->setVecesvisto(0);  //Instancia del modelo Produccionintelectual, Veces Visto

                /*
                 * MANEJO DEL ARCHIVO
                 */
                $em = $this->getDoctrine()->getManager();
                $idTema = $formProduccionIntelectual->get('tema')->getViewData(); //Se obtiene el id del tema, del formulario
                //Generación del nombre y direccion del archivo
                $tipoProduccion = $formProduccionIntelectual->get('tipoproduccion')->getViewData();
                $dir = 'produccionIntelectual/';
                $nombreArchivo = $idTema . $tipoProduccion . rand(10000, 99999);
                $produccionIntelectual->setNombre($nombreArchivo); //Instancia del modelo Produccionintelectual, nombre


                $file = $formProduccionIntelectual['archivo']->getData();
                $extension = $file->guessExtension(); //Obtener la extensión del archivo cargado
                if ($extension && $extension == "zip") {
                    $file->move($dir, $nombreArchivo . '.' . $extension); //Mover el archivo al directorio
                    $produccionIntelectual->setArchivo($dir); //Instancia del modelo Produccionintelectual, arcivo
                    $em->persist($produccionIntelectual);
                    $em->flush();

                    /*
                     * Cambio del estado del tema, para que desaparezca automaticamente del listado de posible temas para
                     * asignar produccion intelectual
                    */

                    $em = $this->getDoctrine()->getManager();
                    $tema = $em->getRepository('GSProyectosBundle:Tema')->find($produccionIntelectual->getTema());
                    $tema->setEstado(false);
                    $em->persist($tema);
                    $em->flush();

                    return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar', array('limite' => '30')));
                } 
            }
            $mensaje = 1;
        }
        return $this->render('GSProyectosBundle:Administrarproduccionintelectual:crear.html.twig', array('formProduccionIntelectual' => $formProduccionIntelectual->createView(), 'mensaje' => $mensaje));
    }

    public function ModificarAction() {
        
    }

    public function EliminarAction() {
        
    }

    public function BuscarAction() {
        $produccionIntelectual = new Produccionintelectual();
        $temaUsuario = new TemaUsuario();
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->findBy(array(), array('tema' => 'DESC', 'fecharegistro' => 'DESC'), 30);


        return $this->render('GSProyectosBundle:Administrarproduccionintelectual:buscar.html.twig', array('produccionIntelectual' => $produccionIntelectual));
    }

    /*
     * Accion para buscar participantes de un proyecto de manera dinamica.
     * Implementada en la plantilla crear produccion intelectual
     */
    public function BuscarparticipantesAction($id) {
        $temaUsuario = new TemaUsuario();
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id));
        return $this->render('GSProyectosBundle:Administrarproduccionintelectual:buscarparticipantes.html.twig', array('temaUsuario' => $temaUsuario));
    }
    
    //Funcion para cambiar el estado del tema tras asignarle una carga de produccion intelectual
    public function HabilitartemaAction($id) {
        $produccionIntelectual = new Produccionintelectual(); // objeto del modelo ProduccionIntelectual
        $tema = new Tema();// objeto del modelo Tema 
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id); // Consulta de la produccion que contiene el tema a ser cambiado
        $em = $this->getDoctrine()->getManager();
        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($produccionIntelectual->getTema()->getIdtema());// Consulta del tema
        if ($tema->getEstado()) { //Cambio del estado
            $tema->setEstado(false);
        } else {
            $tema->setEstado(true);
        }
        $em->persist($tema);
        $em->flush();
        return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar'));
    }

}

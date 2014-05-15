<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GS\ProyectosBundle\Entity\Produccionintelectual;
use GS\ProyectosBundle\Form\ProduccionintelectualType;
use GS\ProyectosBundle\Entity\TemaUsuario;
use GS\ProyectosBundle\Entity\Tipoproduccion;
use GS\ProyectosBundle\Entity\Tema;
use Symfony\Component\HttpFoundation\Request;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

class AdministrarproduccionintelectualController extends Controller {
    /*
     * Cargar un nuevo archivo en .zip correspondiente a la produccion intelectual 
     * desarrollada y terminada.
     */

    public function CrearAction(Request $request) {
        try {
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
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return $this->redirect($this->generateUrl('gs_contenidos_errores_alertageneral'));
        }
    }

    /*
     * Acción para modificar la producción intelectual
     */

    public function ModificarAction(Request $request, $id) {
        try {
            $em = $this->getDoctrine()->getManager();
            $produccionIntelectual = new Produccionintelectual(); // objeto del Modelo Produccionintelectual
            $tema = new Tema(); // objeto del Modelo Tema       
            $identircarFecha = new IdentificadorFecha(); // Objeto de la clase Identificador fecha
            $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id);
            $tema = $em->getRepository('GSProyectosBundle:Tema')->find($produccionIntelectual->getTema()->getIdtema());
            $tema->setEstado(true);
            $em->persist($tema);
            $em->flush();
            $formProduccionIntelectual = $this->createForm(new ProduccionintelectualType(), $produccionIntelectual); //Formulario del modelo Produccionintelectual
            $mensaje = 0;
            if ($request->getMethod() == 'POST') {
                $formProduccionIntelectual->bind($request);
                if ($formProduccionIntelectual->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $fechaRegistro = new \DateTime("now"); //Obtener la fecha de ahora.                
                    $produccionIntelectual->setFechamodificacion($fechaRegistro);

                    /*
                     * MANEJO DEL ARCHIVO
                     */

                    //Generación del nombre y direccion del archivo
                    $idTema = $formProduccionIntelectual->get('tema')->getViewData(); //Se obtiene el id del tema, del formulario
                    $tipoProduccion = $formProduccionIntelectual->get('tipoproduccion')->getViewData();
                    $dir = 'produccionIntelectual/';
                    $nombreArchivo = $idTema . $tipoProduccion . rand(10000, 99999);


                    $archivo = $formProduccionIntelectual->get('archivo')->getData();
                    if ($archivo) {
                        $extension = $archivo->guessExtension(); //Obtener la extensión del archivo cargado
                        if ($extension && $extension == "zip") {
                            $fs = new Filesystem(); // Objeto para la manipulación de archivos fisicos en el servidor
                            $fs->remove($dir . $produccionIntelectual->getNombre() . '.zip'); // Eliminar la producción intelectual

                            $produccionIntelectual->setNombre($nombreArchivo); //Instancia del modelo Produccionintelectual, nombre

                            $archivo->move($dir, $nombreArchivo . '.' . $extension);
                            $em->persist($produccionIntelectual);
                            $em->flush();
                            $tema = $em->getRepository('GSProyectosBundle:Tema')->find($produccionIntelectual->getTema()->getIdtema());
                            $tema->setEstado(false);
                            $em->persist($tema);
                            $em->flush();
                            return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar'));
                        } else {
                            $mensaje = 1;
                        }
                    } else {
                        $em->persist($produccionIntelectual);
                        $em->flush();
                        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($produccionIntelectual->getTema()->getIdtema());
                        $tema->setEstado(false);
                        $em->persist($tema);
                        $em->flush();
                        return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar'));
                    }
                }
            }
            return $this->render('GSProyectosBundle:Administrarproduccionintelectual:modificar.html.twig', array('produccionIntelectual' => $produccionIntelectual, 'formProduccionIntelectual' => $formProduccionIntelectual->createView(), 'mensaje' => $mensaje));
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
            return $this->redirect($this->generateUrl('gs_contenidos_errores_alertageneral'));
        }
    }

    /*
     * Acción para eliminar la producción intelectual
     */

    public function EliminarAction($id) {
        $em = $this->getDoctrine()->getManager();
        $produccionintelectual = new Produccionintelectual();
        $produccionintelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id);
        $fs = new Filesystem();
        $fs->remove($produccionintelectual->getArchivo() . $produccionintelectual->getNombre() . '.zip');
        $em->remove($produccionintelectual);
        $em->flush();
        return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar'));
    }

    /*
     * Acción para buscar la producción intelectual. 
     * Los ultimos 30 registros     
     */

    public function BuscarAction($limite, $parametro) {
        $valor = null;
        $produccionIntelectual = new Produccionintelectual();
        $temaUsuario = new TemaUsuario();
        $tipoProduccion = new Tipoproduccion();
        $em = $this->getDoctrine()->getManager();

        if ($parametro == 'XXX') {
            $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->findBy(array(), array('tema' => 'DESC', 'fecharegistro' => 'DESC'), $limite);
        } else {
            $valor = $parametro;
        }
        $tipoProduccion = $em->getRepository('GSProyectosBundle:Tipoproduccion')->findAll();



        return $this->render('GSProyectosBundle:Administrarproduccionintelectual:buscar.html.twig', array('produccionIntelectual' => $produccionIntelectual, 'tipoProduccion' => $tipoProduccion, 'valor' => $valor, 'limite' => $limite));
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
        $tema = new Tema(); // objeto del modelo Tema 
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id); // Consulta de la produccion que contiene el tema a ser cambiado
        $em = $this->getDoctrine()->getManager();
        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($produccionIntelectual->getTema()->getIdtema()); // Consulta del tema
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

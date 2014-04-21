<?php

namespace GS\ProyectosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserManagerInterface;
use GS\ProyectosBundle\Entity\TemaUsuario;
use GS\ProyectosBundle\Entity\Usuario;
use GS\UserBundle\Entity\User;
use GS\ProyectosBundle\Entity\TemaBibliografia;
use GS\ProyectosBundle\Entity\Tema;
use GS\ProyectosBundle\Entity\Produccionintelectual;
use GS\ProyectosBundle\Entity\Espaciotrabajo;
use GS\ProyectosBundle\Entity\Cronograma;
use GS\ProyectosBundle\Form\CronogramaType;
use GS\ProyectosBundle\Entity\Bibliografia;
use GS\ProyectosBundle\Entity\Lecturaconproposito;
use GS\ProyectosBundle\Form\BibliografiaType;
use GS\ProyectosBundle\Form\LecturaconpropositoType;
use GS\ProyectosBundle\Funciones\IdentificadorFecha;
use GS\ProyectosBundle\Funciones\RedimencionarImagen;
use GS\ProyectosBundle\Form\UsuarioType;
use GS\ProyectosBundle\Entity\Mensajeenviado;
use GS\ProyectosBundle\Entity\Mensajerecibido;
use GS\ProyectosBundle\Entity\Mensajeborrado;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

class DesarrollarproduccionintelectualController extends Controller {
    /*
     * Produccion en desarrollo del usuario. 
     * Pagina inicia de acceso, tras inicio de sesión del usuario.
     * A traves del username obtenido por la sesión del usuario se 
     * consulta la trabla tema_usuario a traves del modelo TemaUsuario, así
     * se trae toda la producción en desarrollo en la cual participa el Usuario,
     * sea en calidad de Autor, Codirector o Director.  
     * 
     */

    public function BuscarAction() {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario();
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('usuario' => $user));

        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:buscar.html.twig', array('temaUsuario' => $temaUsuario));
    }

    /*
     * Buscar los miembros que hacen parte del desarrollo. Sea cual sea la función. 
     * Un metodo alternativo llamado desde algunas plantillas para mostrar a los 
     * participantes. 
     * 
     */

    public function BuscarmiembroAction($tema, $funcion) {
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario();
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $tema, 'funcionusuario' => $funcion));
        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:buscarmiembros.html.twig', array('temaUsuario' => $temaUsuario));
    }

    /*
     * Agregar y modificar lectura con proposito correspondiente a una bibliografia. 
     * Se recibe el id correspondiente al idBibliografia de la que se requiere crear o modificar 
     * la lectura con proposito. 
     * Se comprueba que la lectura con proposito corresponda a la bibliografia del usuario
     * que esta intentando crearla; sino corresponde se restringe el acceso. 
     */

    function AgregarlecturapropositoAction(Request $request, $id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $lecturaConProposito = new Lecturaconproposito(); //Objeto del modelo Lecturaconproposito
        $lectura = new Lecturaconproposito(); //Objeto del modelo Lecturaconproposito
        $bibliografia = new Bibliografia(); //Objeto del modelo Bibliografia
        $temaBibliografia = new TemaBibliografia(); //Objeto del modelo Temabibliografia
        $temaUsuario = new TemaUsuario(); //Objeto del modelo Temausuario
        $identificadorFecha = new IdentificadorFecha(); // Objeto de la clase IdentificaorFehca
        $em = $this->getDoctrine()->getManager();

        $temaBibliografia = $em->getRepository('GSProyectosBundle:TemaBibliografia')->findBy(array('bibliografia' => $id)); //Consulta para obtener el idTema que corresponde a la Bibliografia
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $temaBibliografia[0]->getTema()->getIdtema(), 'usuario' => $user)); //Consultar si el tema corresponde al usuario

        $lectura = $em->getRepository('GSProyectosBundle:Lecturaconproposito')->findBy(array('bibliografia' => $id)); //Consulta para comprobar la existencia de una lectura con proposito correspondiente a la bibliografia

        if ($lectura) { //Si existe una lectura con proposito correspondiente a la bibliografia
            $lecturaConProposito = $em->getRepository('GSProyectosBundle:Lecturaconproposito')->find($lectura[0]->getBibliografia()->getIdbibliografia());
            $formLecturaConProposito = $this->createForm(new LecturaconpropositoType(), $lecturaConProposito); // Se crea el formulario con los datos del modelo Lectura con proposito, puesto corresponde a una modificación
        } else {
            $formLecturaConProposito = $this->createForm(new LecturaconpropositoType(), $lecturaConProposito); //Se crea el formulario vacion, para una nueva lectura con proposito
        }

        if ($temaUsuario) {

            if ($request->getMethod() == 'POST') {
                $formLecturaConProposito->handleRequest($request);
                if ($formLecturaConProposito->isValid()) {
                    if (!$lectura) { // Si es falso, indica que la lectura con proposito se va a crear, de lo contrario se modificara. 
                        $ultimoRegistro = $em->getRepository('GSProyectosBundle:Lecturaconproposito')->buscarUltimaLectura();
                        $lecturaConProposito->setIdlecturaconproposito($identificadorFecha->generarIdLecturaConProposito($ultimoRegistro));
                        $bibliografia = $em->getRepository('GSProyectosBundle:Bibliografia')->find($id);
                        $lecturaConProposito->setBibliografia($bibliografia);
                        $fechaRegistro = new \DateTime("now");
                        $lecturaConProposito->setFecharegistro($fechaRegistro);
                    }

                    $em->persist($lecturaConProposito);
                    $em->flush($lecturaConProposito);
                }
            }
            return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Agregarlecturaproposito.html.twig', array('formLecturaConProposito' => $formLecturaConProposito->createView(), 'idBibliografia' => $id));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_buscar'));
        }
    }

    /*
     * Recibe el idtema correspondiente al modelo Tema.
     * Acción para agregar una nueva cita bibliografica a un tema.
     * Se guarda en la tabla Bibliografia a traves del modelo Bibliografia y 
     * en la tabala TemaBibliografia a traves del modelo Tema. 
     */

    public function AgregarbibliografiaAction(Request $request, $id) {

        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario(); // Objeto del modelo TemaUsuario
        $tema = new Tema(); // Objeto del modelo Tema
        $bibliografia = new Bibliografia(); // Objeto del modelo Bibliografia
        $temaBibliografia = new TemaBibliografia(); // Objeto del modelo TemaBibliografia
        $identificadorFecha = new IdentificadorFecha(); // Objeto de la clase IdentificaorFehca
        $formBibliografia = $this->createForm(new BibliografiaType(), $bibliografia); // Formulario del modelo Bibliografia 
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id)); // Consulta 

        /*
         * Si el usuario es participante del proyecto podra ver el entorno de 
         * trabajo para desarrollar la produccion intelectual 
         */

        foreach ($temaUsuario as $value) {
            if ($value->getUsuario()->getNumerodocumentoidentidad() == $user) { //Si el usuario es propietario del tema que intenta modificar
                if ($request->getMethod() == 'POST') {
                    $formBibliografia->handleRequest($request);
                    if ($formBibliografia->isValid()) { // Si el formulario es validao
                        $em = $this->getDoctrine()->getManager();
                        $ultimoRegistro = $em->getRepository('GSProyectosBundle:Bibliografia')->buscarUltimoBibliografia();
                        $bibliografia->setIdbibliografia($identificadorFecha->generarIdBibliografia($ultimoRegistro)); // Generacion de llave primaria del nuevo registro a partir del ultimo hecho en la bd

                        $fechaRegistro = new \DateTime("now");
                        $bibliografia->setFecharegistro($fechaRegistro);

                        /*
                         * MANEJO DEL ARCHIVO
                         */

                        //Generación del nombre y direccion del archivo    
                        if ($formBibliografia->get('archivo')->getData()) {
                            $dir = 'bibliografia/';
                            $nombreArchivo = $id . rand(10000, 99999);
                            $bibliografia->setNombrearchivo($nombreArchivo); //Instancia del modelo Produccionintelectual, nombre
                            $file = $formBibliografia['archivo']->getData();
                            $extension = $file->guessExtension(); //Obtener la extensión del archivo cargado
                            if ($extension && $extension == "zip") {
                                $file->move($dir, $nombreArchivo . '.' . $extension); //Mover el archivo al directorio
                                $bibliografia->setArchivo($dir); //Instancia del modelo Produccionintelectual, arcivo
                                $em->persist($bibliografia);
                                $em->flush();

                                /*
                                 * Guardar Registro. TemaBibliografia
                                 */

                                $em = $this->getDoctrine()->getManager();
                                $ultimoRegistro = $em->getRepository('GSProyectosBundle:TemaBibliografia')->buscarUltimoTemaBibliografia();
                                $temaBibliografia->setIdtemaBibliografia($identificadorFecha->generarIdTemaBibliografia($ultimoRegistro));  // Generacion de llave primaria del nuevo registro a partir del ultimo hecho en la bd
                                $tema = $em->getRepository('GSProyectosBundle:Tema')->find($id);

                                $temaBibliografia->setTema($tema);
                                $temaBibliografia->setBibliografia($bibliografia);

                                $em->persist($temaBibliografia);
                                $em->flush();

                                return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar', array('limite' => '30')));
                            }
                        } else {

                            $em->persist($bibliografia);
                            $em->flush();

                            /*
                             * Guardar Registro. TemaBibliografia
                             */

                            $em = $this->getDoctrine()->getManager();
                            $ultimoRegistro = $em->getRepository('GSProyectosBundle:TemaBibliografia')->buscarUltimoTemaBibliografia();
                            $temaBibliografia->setIdtemaBibliografia($identificadorFecha->generarIdTemaBibliografia($ultimoRegistro));
                            $tema = $em->getRepository('GSProyectosBundle:Tema')->find($id);

                            $temaBibliografia->setTema($tema);
                            $temaBibliografia->setBibliografia($bibliografia);

                            $em->persist($temaBibliografia);
                            $em->flush();

                            return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_vista', array('id' => $id)));
                        }
                        //return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_vista', array('id' => $id)));
                    }
                }
                return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Agregarbibliografia.html.twig', array('formBibliografia' => $formBibliografia->createView(), 'idTema' => $id));
            }
        }
    }

    public function EliminarbibliografiaAction($id, $idbibliografia) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario(); // Objeto del modelo TemaUsuario
        $tema = new Tema(); // Objeto del modelo Tema
        $bibliografia = new Bibliografia(); // Objeto del modelo Bibliografia
        $temaBibliografia = new TemaBibliografia(); // Objeto del modelo TemaBibliografia
        $bibliografia = $em->getRepository('GSProyectosBundle:Bibliografia')->find($idbibliografia);
    }

    public function ModificarbibliografiaAction(Request $request, $id, $idbibliografia) {

        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();
        $temaUsuario = new TemaUsuario(); // Objeto del modelo TemaUsuario
        $tema = new Tema(); // Objeto del modelo Tema
        $bibliografia = new Bibliografia(); // Objeto del modelo Bibliografia
        $temaBibliografia = new TemaBibliografia(); // Objeto del modelo TemaBibliografia
        $identificadorFecha = new IdentificadorFecha(); // Objeto de la clase IdentificaorFehca
        $bibliografia = $em->getRepository('GSProyectosBundle:Bibliografia')->find($idbibliografia);
        $formBibliografia = $this->createForm(new BibliografiaType(), $bibliografia); // Formulario del modelo Bibliografia 
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id, 'usuario' => $user)); // Consulta 
        $temaBibliografia = $em->getRepository('GSProyectosBundle:TemaBibliografia')->findBy(array('tema' => $id, 'bibliografia' => $idbibliografia));
        /*
         * Si el usuario es participante del proyecto podra ver el entorno de 
         * trabajo para desarrollar la produccion intelectual 
         */

        if ($temaUsuario && $temaBibliografia) { //Si el usuario es propietario del tema que intenta modificar
            if ($request->getMethod() == 'POST') {
                $formBibliografia->handleRequest($request);
                if ($formBibliografia->isValid()) { // Si el formulario es validao
                    $em = $this->getDoctrine()->getManager();

                    $fechaRegistro = new \DateTime("now");
                    $bibliografia->setFecharegistro($fechaRegistro);

                    /*
                     * MANEJO DEL ARCHIVO
                     */

                    //Generación del nombre y direccion del archivo    
                    if ($formBibliografia->get('archivo')->getData()) {
                        if ($bibliografia->getNombrearchivo()) {
                            $fs = new Filesystem();
                            $fs->remove($bibliografia->getArchivo(), $bibliografia->getNombrearchivo());
                        }
                        $dir = 'bibliografia/';
                        $nombreArchivo = $id . rand(10000, 99999);
                        $bibliografia->setNombrearchivo($nombreArchivo); //Instancia del modelo Produccionintelectual, nombre
                        $file = $formBibliografia['archivo']->getData();
                        $extension = $file->guessExtension(); //Obtener la extensión del archivo cargado
                        if ($extension && $extension == "zip") {
                            $file->move($dir, $nombreArchivo . '.' . $extension); //Mover el archivo al directorio
                            $bibliografia->setArchivo($dir); //Instancia del modelo Produccionintelectual, arcivo
                            $em->persist($bibliografia);
                            $em->flush();

                            return $this->redirect($this->generateUrl('gs_proyectos_produccionintelectual_buscar', array('limite' => '30')));
                        }
                    } else {

                        $em->persist($bibliografia);
                        $em->flush();

                        /*
                         * Guardar Registro. TemaBibliografia
                         */

//                        $em = $this->getDoctrine()->getManager();
//                        $ultimoRegistro = $em->getRepository('GSProyectosBundle:TemaBibliografia')->buscarUltimoTemaBibliografia();
//                        $temaBibliografia->setIdtemaBibliografia($identificadorFecha->generarIdTemaBibliografia($ultimoRegistro));
//                        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($id);
//
//                        $temaBibliografia->setTema($tema);
//                        $temaBibliografia->setBibliografia($bibliografia);
//
//                        $em->persist($temaBibliografia);
//                        $em->flush();

                        return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_vista', array('id' => $id)));
                    }
                    //return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_vista', array('id' => $id)));
                }
            }
            return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Modificarbibliografia.html.twig', array('formBibliografia' => $formBibliografia->createView(), 'idTema' => $id, 'idBibliografia' => $idbibliografia));
        }
    }

    public function BuscarbibliografiaAction() {
        
    }

    /*
     * Recibe el idtema correspondiente al modelo Tema.
     * Acción para agregar una actividad al cronograma del proyecto en desarrollo.
     * Se verifica si el usuario que intenta agregar la actividad es autor y es 
     * participante del proyecto.
     */

    public function AgregaractividadcronogramaAction(Request $request, $id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $temaUsuario = new TemaUsuario(); // Objeto del modelo TemaUsuario
        $cronograma = new Cronograma();
        $tema = new Tema();
        $identificadorFecha = new IdentificadorFecha();
        $formCronograma = $this->createForm(new CronogramaType(), $cronograma);
        $em = $this->getDoctrine()->getManager();

        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id)); // Consulta 
        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($id); // Consulta 

        /*
         * Si el usuario es participante del proyecto podra ver el entorno de 
         * trabajo para desarrollar la produccion intelectual 
         */

        foreach ($temaUsuario as $value) {
            if ($value->getUsuario()->getNumerodocumentoidentidad() == $user) {
                if ($request->getMethod() == 'POST') {
                    $formCronograma->handleRequest($request);
                    if ($formCronograma->isValid()) {
                        $em = $this->getDoctrine()->getManager();
                        $ultimoRegistro = $em->getRepository('GSProyectosBundle:Cronograma')->buscarUltimoCronograma();
                        $cronograma->setIdcronograma($identificadorFecha->generarIdCronograma($ultimoRegistro));
                        $cronograma->setTema($tema);
                        $em->persist($cronograma);
                        $em->flush();
                        return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_vista', array('id' => $id)));

//                 $fechaRegistro = new \DateTime("now"); //Obtener la fecha de ahora                 
//                 $cronograma->setFecharegistro($fechaRegistro);
                    }
                }
                return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Agregaractividadcronograma.html.twig', array('formCronograma' => $formCronograma->createView(), 'idTema' => $id));
            }
        }

        return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_buscar')); // Ruta tomada si el usuario que intenta acceder no tiene privilegios.
    }

    public function EliminaractividadcronogramaAction() {
        
    }

    public function ModificaractividadcronogramaAction() {
        
    }

    /*
     * Recibe el idtema correspondiente al modelo Tema.
     * Acción que permite generar una vista global del proyecto en 
     * desarrollo. Si el usuario es participante del proyecto podra ver el 
     * entorno de trabajo
     */

    public function VistaAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */

        $tema = new Tema();
        $espacioTrabajo = new Espaciotrabajo(); // Objeto del modelo Espaciotrabajo
        $temaUsuario = new TemaUsuario(); // Objeto del modelo TemaUsuario
        $temaBibliografia = new TemaBibliografia(); // Objeto del modelo TemaUsuario        
        $cronograma = new Cronograma();
        $em = $this->getDoctrine()->getManager(); // Manejador


        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id)); // Consulta 
        $tema = $em->getRepository('GSProyectosBundle:Tema')->find($id); // Consulta 
        $cronograma = $em->getRepository('GSProyectosBundle:Cronograma')->findBy(array('tema' => $id)); // Consulta 
        $espacioTrabajo = $em->getRepository('GSProyectosBundle:Espaciotrabajo')->findBy(array('tema' => $id)); // Consulta 
        $temaBibliografia = $em->getRepository('GSProyectosBundle:TemaBibliografia')->findBy(array('tema' => $id)); // Consulta         

        /*
         * Si el usuario es participante del proyecto podra ver el entorno de 
         * trabajo para desarrollar la produccion intelectual 
         */

        foreach ($temaUsuario as $value) {
            if ($value->getUsuario()->getNumerodocumentoidentidad() == $user) {
                $descripcionTema = html_entity_decode($tema->getDescripcion()); // Decodificar caracteres especiales almacenados en la descripcion del Tema
                return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:vista.html.twig', array('temaUsuario' => $temaUsuario, 'tema' => $tema, 'temaBibliografia' => $temaBibliografia, 'espacioTrabajo' => $espacioTrabajo, 'descripcionTema' => $descripcionTema, 'cronograma' => $cronograma, 'user' => $user));
            }
        }
        return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_buscar')); // Ruta tomada si el usuario que intenta acceder no tiene privilegios.
    }

    /*
     * Recibe el id correspondiente a idbibliografia. 
     * Esta acción permite verificar si la bibliografía tiene asignada 
     * una lectura con proposito.
     * 
     */

    public function ExistelecturaconpropositoAction($id) {
        $lecturaConProposito = new Lecturaconproposito();
        $em = $this->getDoctrine()->getManager();
        $lecturaConProposito = $em->getRepository('GSProyectosBundle:Lecturaconproposito')->findBy(array('bibliografia' => $id));

        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Existelecturaconproposito.html.twig', array('lectura' => $lecturaConProposito));
    }

    /*
     * Esta acción permite visualizar la producción intelectual 
     */

    public function CatalogobibliograficoAction() {
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = new Produccionintelectual();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->findBy(array(), array('fecharegistro' => 'DESC'), 30);
        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Catalogobibliografico.html.twig', array('produccionIntelectual' => $produccionIntelectual));
    }

    /*
     * Recibe el id correspondiente a idproduccionintelectual.
     * Permite tener una vista global sobre el contenido de la 
     * producción intelectual seleccionada.
     */

    public function CatalogobibliograficovistaAction($id) {
        $em = $this->getDoctrine()->getManager();
        $produccionIntelectual = new Produccionintelectual();
        $temaUsuario = new TemaUsuario();
        $temaBibliografia = new TemaBibliografia();
        $produccionIntelectual = $em->getRepository('GSProyectosBundle:Produccionintelectual')->find($id);
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $produccionIntelectual->getTema()->getIdtema()));
        $temaBibliografia = $em->getRepository('GSProyectosBundle:TemaBibliografia')->findBy(array('tema' => $produccionIntelectual->getTema()->getIdtema()));
        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Catalogobibliograficovista.html.twig', array('produccionIntelectual' => $produccionIntelectual, 'temaUsuario' => $temaUsuario, 'temaBibliografia' => $temaBibliografia));
    }

    public function BibliografiavistaAction($id) {
        $em = $this->getDoctrine()->getManager();
        $bibliografia = new Produccionintelectual();
        $lecturaConProposito = new Lecturaconproposito();
        $bibliografia = $em->getRepository('GSProyectosBundle:Bibliografia')->find($id);
        $lecturaConProposito = $em->getRepository('GSProyectosBundle:Lecturaconproposito')->findBy(array('bibliografia' => $id));
        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Bibliografiavista.html.twig', array('bibliografia' => $bibliografia, 'lecturaConProposito' => $lecturaConProposito));
    }

    /*
     * Permite al usuario modificar los datos basicos de su perfíl
     */

    public function PerfilAction(Request $request) {
        /*
         * Obtener username de la sesion
         */
        $u = $this->get('security.context')->getToken()->getUser();

        /*
         * 
         */
        $redimencionarImagen = new RedimencionarImagen();
        $usuario = new Usuario();
        $usere = new User();
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($u->getUsername());
        $formUsuario = $this->createForm(new UsuarioType(), $usuario);

        $userManager = $this->get('fos_user.user_manager'); // Instancia del manejador del bundle FOSUser
        $user = $userManager->createUser();
        $usere = $userManager->findUserByUsername($u->getUsername());

        if ($request->getMethod() == 'POST') {
            $formUsuario->handleRequest($request);
            if ($formUsuario->isValid()) {
                $password = $formUsuario->get('password')->getData();

                if ($password) {
                    $usere->setPlainPassword($password);
                    $userManager->updateUser($usere, false); //Actualizacion del contenido del manejador
                    $this->getDoctrine()->getManager()->flush(); //Guarda en la base de datos U
                }

                /*
                 * MANEJO DE LA FOTO
                 */
                $archivo = $formUsuario->get('archivo')->getData();
                if ($archivo) {
                    $dir = 'images/fotos/';
                    $nombreArchivo = $usuario->getUser()->getEmail();
                    // $file = $formUsuario['archivo']->getData();
                    $extension = $archivo->guessExtension(); //Obtener la extensión del archivo cargado                     
                    if ($extension && ($extension == "JPG" || $extension == "JPeG" || $extension == "jpeg" || $extension == "jpg")) {
                        $usuario->setFoto($dir . $nombreArchivo . '.' . "jpg"); //Instancia del modelo Produccionintelectual, nombre 
                        $archivo->move($dir, $nombreArchivo . '.' . "jpg"); //Mover el archivo al directorio
                        $redimencionarImagen->redimencionar($usuario->getFoto(), $dir);
                    }
                }

                $em->persist($usuario);
                $em->flush();
            }
        }

        return $this->render('GSProyectosBundle:Desarrollarproduccionintelectual:Perfil.html.twig', array('usuario' => $usuario, 'formUsuario' => $formUsuario->createView()));
    }

    /*
     * Recibe el id correspondiente al idtema, y un espacio, correspondiente al 
     * idespacio de trabajo.
     * Esta accion permite solicitar a los miembros la revisión del contenido
     * correspondiente en desarrollo. 
     * La solicitud es enviada a traves de correo electronico y el sistema 
     * de mensajería interno. 
     */

    public function SolicitudrevisionAction($id, $espacio) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager(); //Instancia del manejador de doctrine
        $existe = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id, 'usuario' => $user));
        if ($existe) {
            $identificadorFecha = new IdentificadorFecha(); //Objeto de la clase identificador fecha
            $mensajeEnviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
            $usuario = new Usuario(); //Objeto del modelo Usuario. Se intanciara con los datos del usuario de la sesion
            $usuarios = new Usuario(); //Objeto del modelo Usuario. Se asignan todos los usuarios disponibles. 
            $destinatario = new Usuario(); //Objeto del modelo Usuario. 
            $users = new User(); //Objeto del modelo User.     
            $espacioTrabajo = new Espaciotrabajo(); // Objeto del modelo Espaciotrbajo 
            $temaUsuario = new TemaUsuario(); // Objeto del modelo Temausuario
            $tema = new Tema(); // Objeto del modelo 
            $usuario = $em->getRepository('GSProyectosBundle:Usuario')->find($user);
            $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $id));
            $espacioTrabajo = $em->getRepository('GSProyectosBundle:Espaciotrabajo')->find($espacio);
            $tema = $em->getRepository('GSProyectosBundle:Tema')->find($id);

            $mensaje = '<h3>Solicitud de Revisión</h3>' . // Mensaje que sera enviado a nivel interno - Mensajería del sistema
                    '<p><strong>Tema: </strong>' . $tema->getTitulo() . '</p>' .
                    '<p><strong>Descripción: </strong>' . $tema->getDescripcion() .
                    '<p>De click en el siguiente enlace para ir al documento.</p>' .
                    '<p>' . $espacioTrabajo->getNombre() . ': <a href="' . $espacioTrabajo->getUrl() . '">' . $espacioTrabajo->getUrl() . '</a></p>' .
                    '<p>De click en el siguiente enlace para ir al espacio de trabajo.</p>' .
                    '<p><a href="http://localhost/simon/web/usuario/produccionIntelectual/vista/' . $id . '"> Espacio de trabajo</a></p>'
            ;

            $fechaRegistro = new \DateTime("now");
            $asunto = 'Solicitud Revisión' . ' ' . $espacioTrabajo->getNombre();

            foreach ($temaUsuario as $value) { //El registro se crea para cada destinatario
                $enviado = new Mensajeenviado(); //Objeto del modelo Mensajeenviado
                $recibido = new Mensajerecibido(); //Objeto del modelo Mensajerecibido
                $em = $this->getDoctrine()->getManager();
                $destinatario = $em->getRepository('GSProyectosBundle:Usuario')->find($value->getUsuario()->getNumerodocumentoidentidad());
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

                $descripcionTema = html_entity_decode($tema->getDescripcion()); // Decodificar caracteres especiales almacenados en la descripcion del Tema

                $message = \Swift_Message::newInstance() //Enviar mensaje via correo electrónico
                        ->setSubject($asunto)
                        ->setFrom($usuario->getUser()->getEmail())
                        ->setTo($destinatario->getUser()->getEmail())
                        ->setBody(
                        $this->renderView(
                                'GSProyectosBundle:Desarrollarproduccionintelectual:emailsolicitudrevision.html.twig', array('descripcionTema' => $descripcionTema, 'tema' => $tema, 'espacioTrabajo' => $espacioTrabajo)
                        ), 'text/html'
                );
                $this->get('mailer')->send($message);
            }
            return $this->redirect($this->generateUrl('gs_proyectos_mensajes_buscar'));
        } else {
            return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_buscar'));
        }
    }

    public function CompartirconmiembrosAction($id) {
        /*
         * Obtener username de la sesion
         */
        $userManager = $this->get('security.context')->getToken()->getUser();
        $user = $userManager->getUsername();
        /*
         * 
         */
        $em = $this->getDoctrine()->getManager();
        $espacioTrabajo = new Espaciotrabajo();
        $temaUsuario = new TemaUsuario();

        $espacioTrabajo = $em->getRepository('GSProyectosBundle:Espaciotrabajo')->find($id);
        $temaUsuario = $em->getRepository('GSProyectosBundle:TemaUsuario')->findBy(array('tema' => $espacioTrabajo->getTema()->getIdtema(), 'usuario' => $user));
        if ($temaUsuario) {
            if ($espacioTrabajo->getCompartirmiembros()) {
                $espacioTrabajo->setCompartirmiembros(false);
            } else {
                $espacioTrabajo->setCompartirmiembros(true);
            }

            $em->persist($espacioTrabajo);
            $em->flush($espacioTrabajo);
            return $this->redirect($this->generateUrl('gs_proyectos_desarrollarproduccionintelectual_vista', array('id' => $espacioTrabajo->getTema()->getIdtema())));
        }
    }

}

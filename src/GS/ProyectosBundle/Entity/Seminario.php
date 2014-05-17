<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Seminario
 *
 * @ORM\Table(name="seminario", indexes={@ORM\Index(name="prioridad_seminario_idx", columns={"prioridad"}), @ORM\Index(name="usuario_seminario_idx", columns={"usuario"})})
 * @ORM\Entity(repositoryClass="GS\ProyectosBundle\Entity\SeminarioRepository")
 */
class Seminario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idseminario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idseminario;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     */
    private $titulo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceso", type="boolean", nullable=false)
     */
    private $acceso = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="destacado", type="boolean", nullable=false)
     */
    private $destacado = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechamodificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicioPublicacion", type="datetime", nullable=false)
     */
    private $fechainiciopublicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFinPublicacion", type="datetime", nullable=true)
     */
    private $fechafinpublicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="vecesVisto", type="integer", nullable=false)
     */
    private $vecesvisto = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostratTitulo", type="boolean", nullable=false)
     */
    private $mostrattitulo = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarAutor", type="boolean", nullable=false)
     */
    private $mostrarautor = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarCategoria", type="boolean", nullable=false)
     */
    private $mostrarcategoria = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarFechaCracion", type="boolean", nullable=false)
     */
    private $mostrarfechacracion = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarFechaPublicacion", type="boolean", nullable=false)
     */
    private $mostrarfechapublicacion = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarFechaModificacion", type="boolean", nullable=false)
     */
    private $mostrarfechamodificacion = '0';

    /**
     * @var \Prioridad
     *
     * @ORM\ManyToOne(targetEntity="Prioridad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prioridad", referencedColumnName="idprioridad")
     * })
     */
    private $prioridad;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="numeroDocumentoIdentidad")
     * })
     */
    private $usuario;



    /**
     * Get idseminario
     *
     * @return integer 
     */
    public function getIdseminario()
    {
        return $this->idseminario;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Seminario
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set acceso
     *
     * @param boolean $acceso
     * @return Seminario
     */
    public function setAcceso($acceso)
    {
        $this->acceso = $acceso;

        return $this;
    }

    /**
     * Get acceso
     *
     * @return boolean 
     */
    public function getAcceso()
    {
        return $this->acceso;
    }

    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Seminario
     */
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;

        return $this;
    }

    /**
     * Get destacado
     *
     * @return boolean 
     */
    public function getDestacado()
    {
        return $this->destacado;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Seminario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Seminario
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Seminario
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Seminario
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime 
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /**
     * Set fechamodificacion
     *
     * @param \DateTime $fechamodificacion
     * @return Seminario
     */
    public function setFechamodificacion($fechamodificacion)
    {
        $this->fechamodificacion = $fechamodificacion;

        return $this;
    }

    /**
     * Get fechamodificacion
     *
     * @return \DateTime 
     */
    public function getFechamodificacion()
    {
        return $this->fechamodificacion;
    }

    /**
     * Set fechainiciopublicacion
     *
     * @param \DateTime $fechainiciopublicacion
     * @return Seminario
     */
    public function setFechainiciopublicacion($fechainiciopublicacion)
    {
        $this->fechainiciopublicacion = $fechainiciopublicacion;

        return $this;
    }

    /**
     * Get fechainiciopublicacion
     *
     * @return \DateTime 
     */
    public function getFechainiciopublicacion()
    {
        return $this->fechainiciopublicacion;
    }

    /**
     * Set fechafinpublicacion
     *
     * @param \DateTime $fechafinpublicacion
     * @return Seminario
     */
    public function setFechafinpublicacion($fechafinpublicacion)
    {
        $this->fechafinpublicacion = $fechafinpublicacion;

        return $this;
    }

    /**
     * Get fechafinpublicacion
     *
     * @return \DateTime 
     */
    public function getFechafinpublicacion()
    {
        return $this->fechafinpublicacion;
    }

    /**
     * Set vecesvisto
     *
     * @param integer $vecesvisto
     * @return Seminario
     */
    public function setVecesvisto($vecesvisto)
    {
        $this->vecesvisto = $vecesvisto;

        return $this;
    }

    /**
     * Get vecesvisto
     *
     * @return integer 
     */
    public function getVecesvisto()
    {
        return $this->vecesvisto;
    }

    /**
     * Set mostrattitulo
     *
     * @param boolean $mostrattitulo
     * @return Seminario
     */
    public function setMostrattitulo($mostrattitulo)
    {
        $this->mostrattitulo = $mostrattitulo;

        return $this;
    }

    /**
     * Get mostrattitulo
     *
     * @return boolean 
     */
    public function getMostrattitulo()
    {
        return $this->mostrattitulo;
    }

    /**
     * Set mostrarautor
     *
     * @param boolean $mostrarautor
     * @return Seminario
     */
    public function setMostrarautor($mostrarautor)
    {
        $this->mostrarautor = $mostrarautor;

        return $this;
    }

    /**
     * Get mostrarautor
     *
     * @return boolean 
     */
    public function getMostrarautor()
    {
        return $this->mostrarautor;
    }

    /**
     * Set mostrarcategoria
     *
     * @param boolean $mostrarcategoria
     * @return Seminario
     */
    public function setMostrarcategoria($mostrarcategoria)
    {
        $this->mostrarcategoria = $mostrarcategoria;

        return $this;
    }

    /**
     * Get mostrarcategoria
     *
     * @return boolean 
     */
    public function getMostrarcategoria()
    {
        return $this->mostrarcategoria;
    }

    /**
     * Set mostrarfechacracion
     *
     * @param boolean $mostrarfechacracion
     * @return Seminario
     */
    public function setMostrarfechacracion($mostrarfechacracion)
    {
        $this->mostrarfechacracion = $mostrarfechacracion;

        return $this;
    }

    /**
     * Get mostrarfechacracion
     *
     * @return boolean 
     */
    public function getMostrarfechacracion()
    {
        return $this->mostrarfechacracion;
    }

    /**
     * Set mostrarfechapublicacion
     *
     * @param boolean $mostrarfechapublicacion
     * @return Seminario
     */
    public function setMostrarfechapublicacion($mostrarfechapublicacion)
    {
        $this->mostrarfechapublicacion = $mostrarfechapublicacion;

        return $this;
    }

    /**
     * Get mostrarfechapublicacion
     *
     * @return boolean 
     */
    public function getMostrarfechapublicacion()
    {
        return $this->mostrarfechapublicacion;
    }

    /**
     * Set mostrarfechamodificacion
     *
     * @param boolean $mostrarfechamodificacion
     * @return Seminario
     */
    public function setMostrarfechamodificacion($mostrarfechamodificacion)
    {
        $this->mostrarfechamodificacion = $mostrarfechamodificacion;

        return $this;
    }

    /**
     * Get mostrarfechamodificacion
     *
     * @return boolean 
     */
    public function getMostrarfechamodificacion()
    {
        return $this->mostrarfechamodificacion;
    }

    /**
     * Set prioridad
     *
     * @param \GS\ProyectosBundle\Entity\Prioridad $prioridad
     * @return Seminario
     */
    public function setPrioridad(\GS\ProyectosBundle\Entity\Prioridad $prioridad = null)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return \GS\ProyectosBundle\Entity\Prioridad 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set usuario
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $usuario
     * @return Seminario
     */
    public function setUsuario(\GS\ProyectosBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GS\ProyectosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

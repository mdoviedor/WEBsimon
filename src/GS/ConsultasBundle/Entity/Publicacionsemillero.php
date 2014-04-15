<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publicacionsemillero
 *
 * @ORM\Table(name="publicacionsemillero", indexes={@ORM\Index(name="semillero_publicacionSemillero_idx", columns={"semillero"}), @ORM\Index(name="prioridad_publicacionSemillero_idx", columns={"prioridad"}), @ORM\Index(name="usuario_publicacionSemillero_idx", columns={"usuario"})})
 * @ORM\Entity
 */
class Publicacionsemillero
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpublicacionSemillero", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpublicacionsemillero;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

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
     * @var boolean
     *
     * @ORM\Column(name="acceso", type="boolean", nullable=false)
     */
    private $acceso = '1';

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
     * @ORM\Column(name="mostrarTitulo", type="boolean", nullable=false)
     */
    private $mostrartitulo = '1';

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
     * @ORM\Column(name="mostrarFechaCreacion", type="boolean", nullable=false)
     */
    private $mostrarfechacreacion = '0';

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
     * @var \Semillero
     *
     * @ORM\ManyToOne(targetEntity="Semillero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="semillero", referencedColumnName="idsemillero")
     * })
     */
    private $semillero;

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
     * Get idpublicacionsemillero
     *
     * @return integer 
     */
    public function getIdpublicacionsemillero()
    {
        return $this->idpublicacionsemillero;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Publicacionsemillero
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Publicacionsemillero
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
     * Set destacado
     *
     * @param boolean $destacado
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * Set acceso
     *
     * @param boolean $acceso
     * @return Publicacionsemillero
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
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * Set mostrartitulo
     *
     * @param boolean $mostrartitulo
     * @return Publicacionsemillero
     */
    public function setMostrartitulo($mostrartitulo)
    {
        $this->mostrartitulo = $mostrartitulo;

        return $this;
    }

    /**
     * Get mostrartitulo
     *
     * @return boolean 
     */
    public function getMostrartitulo()
    {
        return $this->mostrartitulo;
    }

    /**
     * Set mostrarautor
     *
     * @param boolean $mostrarautor
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * Set mostrarfechacreacion
     *
     * @param boolean $mostrarfechacreacion
     * @return Publicacionsemillero
     */
    public function setMostrarfechacreacion($mostrarfechacreacion)
    {
        $this->mostrarfechacreacion = $mostrarfechacreacion;

        return $this;
    }

    /**
     * Get mostrarfechacreacion
     *
     * @return boolean 
     */
    public function getMostrarfechacreacion()
    {
        return $this->mostrarfechacreacion;
    }

    /**
     * Set mostrarfechapublicacion
     *
     * @param boolean $mostrarfechapublicacion
     * @return Publicacionsemillero
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
     * @return Publicacionsemillero
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
     * @param \GS\ConsultasBundle\Entity\Prioridad $prioridad
     * @return Publicacionsemillero
     */
    public function setPrioridad(\GS\ConsultasBundle\Entity\Prioridad $prioridad = null)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return \GS\ConsultasBundle\Entity\Prioridad 
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set semillero
     *
     * @param \GS\ConsultasBundle\Entity\Semillero $semillero
     * @return Publicacionsemillero
     */
    public function setSemillero(\GS\ConsultasBundle\Entity\Semillero $semillero = null)
    {
        $this->semillero = $semillero;

        return $this;
    }

    /**
     * Get semillero
     *
     * @return \GS\ConsultasBundle\Entity\Semillero 
     */
    public function getSemillero()
    {
        return $this->semillero;
    }

    /**
     * Set usuario
     *
     * @param \GS\ConsultasBundle\Entity\Usuario $usuario
     * @return Publicacionsemillero
     */
    public function setUsuario(\GS\ConsultasBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GS\ConsultasBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

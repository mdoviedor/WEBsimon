<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articulo
 *
 * @ORM\Table(name="articulo", indexes={@ORM\Index(name="prioridad_articulo_idx", columns={"prioridad"}), @ORM\Index(name="usuario_articulo_idx", columns={"usuario"})})
 * @ORM\Entity
 */
class Articulo
{
    /**
     * @var string
     *
     * @ORM\Column(name="idarticulo", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idarticulo;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=100, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="textoIntroduccion", type="string", length=255, nullable=false)
     */
    private $textointroduccion;

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
     * @var boolean
     *
     * @ORM\Column(name="acceso", type="boolean", nullable=false)
     */
    private $acceso = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarTitulo", type="boolean", nullable=false)
     */
    private $mostrartitulo = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarTextoIntroduccion", type="boolean", nullable=false)
     */
    private $mostrartextointroduccion = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarCategoria", type="boolean", nullable=false)
     */
    private $mostrarcategoria = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="mostrarAutor", type="boolean", nullable=false)
     */
    private $mostrarautor = '1';

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
     * @ORM\Column(name="mostrarImage", type="boolean", nullable=false)
     */
    private $mostrarimage = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text", nullable=false)
     */
    private $texto;

    /**
     * @var integer
     *
     * @ORM\Column(name="vecesVisto", type="integer", nullable=false)
     */
    private $vecesvisto = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="destacado", type="boolean", nullable=false)
     */
    private $destacado = '0';

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
     * Get idarticulo
     *
     * @return string 
     */
    public function getIdarticulo()
    {
        return $this->idarticulo;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Articulo
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
     * Set textointroduccion
     *
     * @param string $textointroduccion
     * @return Articulo
     */
    public function setTextointroduccion($textointroduccion)
    {
        $this->textointroduccion = $textointroduccion;

        return $this;
    }

    /**
     * Get textointroduccion
     *
     * @return string 
     */
    public function getTextointroduccion()
    {
        return $this->textointroduccion;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Articulo
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
     * @return Articulo
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
     * @return Articulo
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
     * @return Articulo
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
     * Set acceso
     *
     * @param boolean $acceso
     * @return Articulo
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
     * Set mostrartitulo
     *
     * @param boolean $mostrartitulo
     * @return Articulo
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
     * Set mostrartextointroduccion
     *
     * @param boolean $mostrartextointroduccion
     * @return Articulo
     */
    public function setMostrartextointroduccion($mostrartextointroduccion)
    {
        $this->mostrartextointroduccion = $mostrartextointroduccion;

        return $this;
    }

    /**
     * Get mostrartextointroduccion
     *
     * @return boolean 
     */
    public function getMostrartextointroduccion()
    {
        return $this->mostrartextointroduccion;
    }

    /**
     * Set mostrarcategoria
     *
     * @param boolean $mostrarcategoria
     * @return Articulo
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
     * Set mostrarautor
     *
     * @param boolean $mostrarautor
     * @return Articulo
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
     * Set mostrarfechacreacion
     *
     * @param boolean $mostrarfechacreacion
     * @return Articulo
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
     * @return Articulo
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
     * Set mostrarimage
     *
     * @param boolean $mostrarimage
     * @return Articulo
     */
    public function setMostrarimage($mostrarimage)
    {
        $this->mostrarimage = $mostrarimage;

        return $this;
    }

    /**
     * Get mostrarimage
     *
     * @return boolean 
     */
    public function getMostrarimage()
    {
        return $this->mostrarimage;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Articulo
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Articulo
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set vecesvisto
     *
     * @param integer $vecesvisto
     * @return Articulo
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
     * Set estado
     *
     * @param boolean $estado
     * @return Articulo
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
     * Set destacado
     *
     * @param boolean $destacado
     * @return Articulo
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
     * Set prioridad
     *
     * @param \GS\ConsultasBundle\Entity\Prioridad $prioridad
     * @return Articulo
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
     * Set usuario
     *
     * @param \GS\ConsultasBundle\Entity\Usuario $usuario
     * @return Articulo
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

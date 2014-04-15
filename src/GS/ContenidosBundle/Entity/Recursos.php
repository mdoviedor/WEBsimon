<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recursos
 *
 * @ORM\Table(name="recursos", indexes={@ORM\Index(name="usuario_recursos_idx", columns={"usuario"}), @ORM\Index(name="tipoRecurso_recursos_idx", columns={"tipoRecurso"})})
 * @ORM\Entity
 */
class Recursos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrecursos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrecursos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechamodificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="vecesVisto", type="integer", nullable=false)
     */
    private $vecesvisto = '0';

    /**
     * @var \Tiporecurso
     *
     * @ORM\ManyToOne(targetEntity="Tiporecurso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoRecurso", referencedColumnName="idtipoRecurso")
     * })
     */
    private $tiporecurso;

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
     * Get idrecursos
     *
     * @return integer 
     */
    public function getIdrecursos()
    {
        return $this->idrecursos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Recursos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Recursos
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
     * @return Recursos
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
     * Set fechainiciopublicacion
     *
     * @param \DateTime $fechainiciopublicacion
     * @return Recursos
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
     * @return Recursos
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
     * Set fechamodificacion
     *
     * @param \DateTime $fechamodificacion
     * @return Recursos
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
     * Set vecesvisto
     *
     * @param integer $vecesvisto
     * @return Recursos
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
     * Set tiporecurso
     *
     * @param \GS\ContenidosBundle\Entity\Tiporecurso $tiporecurso
     * @return Recursos
     */
    public function setTiporecurso(\GS\ContenidosBundle\Entity\Tiporecurso $tiporecurso = null)
    {
        $this->tiporecurso = $tiporecurso;

        return $this;
    }

    /**
     * Get tiporecurso
     *
     * @return \GS\ContenidosBundle\Entity\Tiporecurso 
     */
    public function getTiporecurso()
    {
        return $this->tiporecurso;
    }

    /**
     * Set usuario
     *
     * @param \GS\ContenidosBundle\Entity\Usuario $usuario
     * @return Recursos
     */
    public function setUsuario(\GS\ContenidosBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GS\ContenidosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

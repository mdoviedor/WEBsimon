<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tema
 *
 * @ORM\Table(name="tema")
 * @ORM\Entity(repositoryClass="GS\ConsultasBundle\Entity\TemaRepository")
 */
class Tema
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtema", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtema;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="text", nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempoEstimado", type="string", length=2, nullable=false)
     */
    private $tiempoestimado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;

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
     * Get idtema
     *
     * @return integer 
     */
    public function getIdtema()
    {
        return $this->idtema;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Tema
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
     * Set tiempoestimado
     *
     * @param string $tiempoestimado
     * @return Tema
     */
    public function setTiempoestimado($tiempoestimado)
    {
        $this->tiempoestimado = $tiempoestimado;

        return $this;
    }

    /**
     * Get tiempoestimado
     *
     * @return string 
     */
    public function getTiempoestimado()
    {
        return $this->tiempoestimado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tema
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
     * Set estado
     *
     * @param boolean $estado
     * @return Tema
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
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Tema
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
     * @return Tema
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
     * @return Tema
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
     * @return Tema
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
     * @return Tema
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
}

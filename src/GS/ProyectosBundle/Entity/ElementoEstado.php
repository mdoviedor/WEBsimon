<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElementoEstado
 *
 * @ORM\Table(name="elemento_estado", indexes={@ORM\Index(name="elementoEstado_elementoInventario_idx", columns={"elementoInventario"}), @ORM\Index(name="elementoEstado_estadoElementoInventario_idx", columns={"estadoElementoInventario"})})
 * @ORM\Entity
 */
class ElementoEstado
{
    /**
     * @var string
     *
     * @ORM\Column(name="idelemento_estado", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idelementoEstado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechamodificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \Elementoinventario
     *
     * @ORM\ManyToOne(targetEntity="Elementoinventario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="elementoInventario", referencedColumnName="idelementoInventario")
     * })
     */
    private $elementoinventario;

    /**
     * @var \Estadoelementoinventario
     *
     * @ORM\ManyToOne(targetEntity="Estadoelementoinventario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estadoElementoInventario", referencedColumnName="idestadoElementoInventario")
     * })
     */
    private $estadoelementoinventario;



    /**
     * Get idelementoEstado
     *
     * @return string 
     */
    public function getIdelementoEstado()
    {
        return $this->idelementoEstado;
    }

    /**
     * Set fechamodificacion
     *
     * @param \DateTime $fechamodificacion
     * @return ElementoEstado
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return ElementoEstado
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
     * Set elementoinventario
     *
     * @param \GS\ProyectosBundle\Entity\Elementoinventario $elementoinventario
     * @return ElementoEstado
     */
    public function setElementoinventario(\GS\ProyectosBundle\Entity\Elementoinventario $elementoinventario = null)
    {
        $this->elementoinventario = $elementoinventario;

        return $this;
    }

    /**
     * Get elementoinventario
     *
     * @return \GS\ProyectosBundle\Entity\Elementoinventario 
     */
    public function getElementoinventario()
    {
        return $this->elementoinventario;
    }

    /**
     * Set estadoelementoinventario
     *
     * @param \GS\ProyectosBundle\Entity\Estadoelementoinventario $estadoelementoinventario
     * @return ElementoEstado
     */
    public function setEstadoelementoinventario(\GS\ProyectosBundle\Entity\Estadoelementoinventario $estadoelementoinventario = null)
    {
        $this->estadoelementoinventario = $estadoelementoinventario;

        return $this;
    }

    /**
     * Get estadoelementoinventario
     *
     * @return \GS\ProyectosBundle\Entity\Estadoelementoinventario 
     */
    public function getEstadoelementoinventario()
    {
        return $this->estadoelementoinventario;
    }
}

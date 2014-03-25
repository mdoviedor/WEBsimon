<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ElementoUsuario
 *
 * @ORM\Table(name="elemento_usuario", indexes={@ORM\Index(name="elementoUsuario_usuario_idx", columns={"usuario"}), @ORM\Index(name="elementoUsuario_elementoInventario_idx", columns={"elementoInventario"})})
 * @ORM\Entity
 */
class ElementoUsuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="idelemento_usuario", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idelementoUsuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

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
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="numeroDocumentoIdentidad")
     * })
     */
    private $usuario;



    /**
     * Get idelementoUsuario
     *
     * @return string 
     */
    public function getIdelementoUsuario()
    {
        return $this->idelementoUsuario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return ElementoUsuario
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
     * Set estado
     *
     * @param string $estado
     * @return ElementoUsuario
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set elementoinventario
     *
     * @param \GS\ProyectosBundle\Entity\Elementoinventario $elementoinventario
     * @return ElementoUsuario
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
     * Set usuario
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $usuario
     * @return ElementoUsuario
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

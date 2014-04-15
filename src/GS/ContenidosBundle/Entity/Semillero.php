<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Semillero
 *
 * @ORM\Table(name="semillero")
 * @ORM\Entity
 */
class Semillero
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idsemillero", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsemillero;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;



    /**
     * Get idsemillero
     *
     * @return integer 
     */
    public function getIdsemillero()
    {
        return $this->idsemillero;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Semillero
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
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Semillero
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Semillero
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
}

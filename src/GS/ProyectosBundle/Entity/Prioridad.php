<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prioridad
 *
 * @ORM\Table(name="prioridad")
 * @ORM\Entity
 */
class Prioridad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprioridad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idprioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idprioridad
     *
     * @return integer 
     */
    public function getIdprioridad()
    {
        return $this->idprioridad;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Prioridad
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
}

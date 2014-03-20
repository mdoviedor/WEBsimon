<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estadoelementoinventario
 *
 * @ORM\Table(name="estadoelementoinventario")
 * @ORM\Entity
 */
class Estadoelementoinventario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idestadoElementoInventario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestadoelementoinventario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idestadoelementoinventario
     *
     * @return integer 
     */
    public function getIdestadoelementoinventario()
    {
        return $this->idestadoelementoinventario;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Estadoelementoinventario
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

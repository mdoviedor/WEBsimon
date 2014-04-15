<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoproduccion
 *
 * @ORM\Table(name="tipoproduccion")
 * @ORM\Entity
 */
class Tipoproduccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoProduccion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoproduccion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtipoproduccion
     *
     * @return integer 
     */
    public function getIdtipoproduccion()
    {
        return $this->idtipoproduccion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipoproduccion
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

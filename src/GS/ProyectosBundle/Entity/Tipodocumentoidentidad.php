<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipodocumentoidentidad
 *
 * @ORM\Table(name="tipodocumentoidentidad")
 * @ORM\Entity
 */
class Tipodocumentoidentidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoDocumentoIdentidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipodocumentoidentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtipodocumentoidentidad
     *
     * @return integer 
     */
    public function getIdtipodocumentoidentidad()
    {
        return $this->idtipodocumentoidentidad;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipodocumentoidentidad
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

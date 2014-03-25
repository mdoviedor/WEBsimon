<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tiporecurso
 *
 * @ORM\Table(name="tiporecurso")
 * @ORM\Entity
 */
class Tiporecurso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoRecurso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtiporecurso;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtiporecurso
     *
     * @return integer 
     */
    public function getIdtiporecurso()
    {
        return $this->idtiporecurso;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tiporecurso
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

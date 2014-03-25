<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Areainvestigacion
 *
 * @ORM\Table(name="areainvestigacion")
 * @ORM\Entity
 */
class Areainvestigacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idareaInvestigacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idareainvestigacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idareainvestigacion
     *
     * @return integer 
     */
    public function getIdareainvestigacion()
    {
        return $this->idareainvestigacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Areainvestigacion
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

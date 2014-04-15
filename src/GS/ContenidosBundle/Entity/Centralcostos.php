<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Centralcostos
 *
 * @ORM\Table(name="centralcostos")
 * @ORM\Entity
 */
class Centralcostos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcentralCostos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcentralcostos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=false)
     */
    private $nombre;



    /**
     * Get idcentralcostos
     *
     * @return integer 
     */
    public function getIdcentralcostos()
    {
        return $this->idcentralcostos;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Centralcostos
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

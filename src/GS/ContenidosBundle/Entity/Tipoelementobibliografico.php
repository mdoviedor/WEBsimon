<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipoelementobibliografico
 *
 * @ORM\Table(name="tipoelementobibliografico")
 * @ORM\Entity
 */
class Tipoelementobibliografico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoElementoBibliografico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipoelementobibliografico;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtipoelementobibliografico
     *
     * @return integer 
     */
    public function getIdtipoelementobibliografico()
    {
        return $this->idtipoelementobibliografico;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipoelementobibliografico
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

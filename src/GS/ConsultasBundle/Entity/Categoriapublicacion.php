<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoriapublicacion
 *
 * @ORM\Table(name="categoriapublicacion")
 * @ORM\Entity
 */
class Categoriapublicacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcategoriaPublicacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriapublicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idcategoriapublicacion
     *
     * @return integer 
     */
    public function getIdcategoriapublicacion()
    {
        return $this->idcategoriapublicacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Categoriapublicacion
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

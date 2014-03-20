<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipousuario
 *
 * @ORM\Table(name="tipousuario")
 * @ORM\Entity
 */
class Tipousuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtipoUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtipousuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idtipousuario
     *
     * @return integer 
     */
    public function getIdtipousuario()
    {
        return $this->idtipousuario;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tipousuario
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

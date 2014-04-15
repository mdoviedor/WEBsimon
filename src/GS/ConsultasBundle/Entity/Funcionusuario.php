<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionusuario
 *
 * @ORM\Table(name="funcionusuario")
 * @ORM\Entity
 */
class Funcionusuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionUsuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionusuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;



    /**
     * Get idfuncionusuario
     *
     * @return integer 
     */
    public function getIdfuncionusuario()
    {
        return $this->idfuncionusuario;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Funcionusuario
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

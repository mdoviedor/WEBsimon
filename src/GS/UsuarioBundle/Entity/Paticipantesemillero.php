<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paticipantesemillero
 *
 * @ORM\Table(name="paticipantesemillero", indexes={@ORM\Index(name="semillero_participante_idx", columns={"semillero"})})
 * @ORM\Entity
 */
class Paticipantesemillero
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaticipanteSemillero", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaticipantesemillero;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=45, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="correoElectronico", type="string", length=45, nullable=false)
     */
    private $correoelectronico;

    /**
     * @var \Semillero
     *
     * @ORM\ManyToOne(targetEntity="Semillero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="semillero", referencedColumnName="idsemillero")
     * })
     */
    private $semillero;



    /**
     * Get idpaticipantesemillero
     *
     * @return integer 
     */
    public function getIdpaticipantesemillero()
    {
        return $this->idpaticipantesemillero;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Paticipantesemillero
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

    /**
     * Set apellido
     *
     * @param string $apellido
     * @return Paticipantesemillero
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set correoelectronico
     *
     * @param string $correoelectronico
     * @return Paticipantesemillero
     */
    public function setCorreoelectronico($correoelectronico)
    {
        $this->correoelectronico = $correoelectronico;

        return $this;
    }

    /**
     * Get correoelectronico
     *
     * @return string 
     */
    public function getCorreoelectronico()
    {
        return $this->correoelectronico;
    }

    /**
     * Set semillero
     *
     * @param \GS\UsuarioBundle\Entity\Semillero $semillero
     * @return Paticipantesemillero
     */
    public function setSemillero(\GS\UsuarioBundle\Entity\Semillero $semillero = null)
    {
        $this->semillero = $semillero;

        return $this;
    }

    /**
     * Get semillero
     *
     * @return \GS\UsuarioBundle\Entity\Semillero 
     */
    public function getSemillero()
    {
        return $this->semillero;
    }
}

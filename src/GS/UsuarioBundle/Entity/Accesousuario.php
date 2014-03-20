<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Accesousuario
 *
 * @ORM\Table(name="accesousuario", indexes={@ORM\Index(name="accesoUsuario_usuario_idx", columns={"usuario"})})
 * @ORM\Entity
 */
class Accesousuario {

    /**
     * @var string
     *
     * @ORM\Column(name="idaccesoUsuario", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $idaccesousuario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaAcceso", type="datetime", nullable=false)
     */
    private $fechaacceso;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="numeroDocumentoIdentidad")
     * })
     */
    private $usuario;

    /**
     * Get idaccesousuario
     *
     * @return string 
     */
    public function getIdaccesousuario() {
        return $this->idaccesousuario;
    }

    /**
     * Set idaccesousuario
     *
     * @param string $idaccesousuario
     * @return Accesousuario
     */
    public function setIdaccesousuario($idaccesousuario) {
        $this->fechaacceso = $idaccesousuario;

        return $this;
    }

    /**
     * Set fechaacceso
     *
     * @param \DateTime $fechaacceso
     * @return Accesousuario
     */
    public function setFechaacceso($fechaacceso) {
        $this->fechaacceso = $fechaacceso;

        return $this;
    }

    /**
     * Get fechaacceso
     *
     * @return \DateTime 
     */
    public function getFechaacceso() {
        return $this->fechaacceso;
    }

    /**
     * Set usuario
     *
     * @param \GS\UsuarioBundle\Entity\Usuario $usuario
     * @return Accesousuario
     */
    public function setUsuario(\GS\UsuarioBundle\Entity\Usuario $usuario = null) {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GS\UsuarioBundle\Entity\Usuario 
     */
    public function getUsuario() {
        return $this->usuario;
    }

}

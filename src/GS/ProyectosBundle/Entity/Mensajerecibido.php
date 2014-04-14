<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensajerecibido
 *
 * @ORM\Table(name="mensajerecibido", indexes={@ORM\Index(name="para_mensajeRecibido_idx", columns={"para"}), @ORM\Index(name="de_mnensajeRecibido_idx", columns={"de"})})
 * @ORM\Entity(repositoryClass="GS\ProyectosBundle\Entity\MensajerecibidoRepository")
 */
class Mensajerecibido {

    /**
     * @var string
     *
     * @ORM\Column(name="idmensajeRecibido", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $idmensajerecibido;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=100, nullable=true)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="text", nullable=false)
     */
    private $mensaje;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var boolean
     *
     * @ORM\Column(name="revisado", type="boolean", nullable=true)
     */
    private $revisado = '0';

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="de", referencedColumnName="numeroDocumentoIdentidad")
     * })
     */
    private $de;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="para", referencedColumnName="numeroDocumentoIdentidad")
     * })
     */
    private $para;

    /**
     * Get idmensajerecibido
     *
     * @return string 
     */
    public function getIdmensajerecibido() {
        return $this->idmensajerecibido;
    }

    /**
     * Set idmensajerecibido
     *
     * @param string $idmensajerecibido
     * @return Mensajeenviado
     */
    public function setIdmensajerecibido($idmensajerecibido) {
        $this->idmensajerecibido = $idmensajerecibido;

        return $this;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Mensajerecibido
     */
    public function setAsunto($asunto) {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string 
     */
    public function getAsunto() {
        return $this->asunto;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return Mensajerecibido
     */
    public function setMensaje($mensaje) {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje() {
        return $this->mensaje;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Mensajerecibido
     */
    public function setFecha($fecha) {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha() {
        return $this->fecha;
    }

    /**
     * Set revisado
     *
     * @param boolean $revisado
     * @return Mensajerecibido
     */
    public function setRevisado($revisado) {
        $this->revisado = $revisado;

        return $this;
    }

    /**
     * Get revisado
     *
     * @return boolean 
     */
    public function getRevisado() {
        return $this->revisado;
    }

    /**
     * Set de
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $de
     * @return Mensajerecibido
     */
    public function setDe(\GS\ProyectosBundle\Entity\Usuario $de = null) {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return \GS\ProyectosBundle\Entity\Usuario 
     */
    public function getDe() {
        return $this->de;
    }

    /**
     * Set para
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $para
     * @return Mensajerecibido
     */
    public function setPara(\GS\ProyectosBundle\Entity\Usuario $para = null) {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return \GS\ProyectosBundle\Entity\Usuario 
     */
    public function getPara() {
        return $this->para;
    }

}

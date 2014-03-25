<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensajeenviado
 *
 * @ORM\Table(name="mensajeenviado", indexes={@ORM\Index(name="para_mensajeEnviado_idx", columns={"para"}), @ORM\Index(name="de_mensajeEnviado_idx", columns={"de"})})
 * @ORM\Entity
 */
class Mensajeenviado
{
    /**
     * @var string
     *
     * @ORM\Column(name="idmensajeEnviado", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmensajeenviado;

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
     * Get idmensajeenviado
     *
     * @return string 
     */
    public function getIdmensajeenviado()
    {
        return $this->idmensajeenviado;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Mensajeenviado
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string 
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set mensaje
     *
     * @param string $mensaje
     * @return Mensajeenviado
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Mensajeenviado
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set de
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $de
     * @return Mensajeenviado
     */
    public function setDe(\GS\ProyectosBundle\Entity\Usuario $de = null)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return \GS\ProyectosBundle\Entity\Usuario 
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set para
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $para
     * @return Mensajeenviado
     */
    public function setPara(\GS\ProyectosBundle\Entity\Usuario $para = null)
    {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return \GS\ProyectosBundle\Entity\Usuario 
     */
    public function getPara()
    {
        return $this->para;
    }
}

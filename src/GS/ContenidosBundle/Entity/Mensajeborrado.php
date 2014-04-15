<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mensajeborrado
 *
 * @ORM\Table(name="mensajeborrado", indexes={@ORM\Index(name="para_mensajeBorrado_idx", columns={"para"}), @ORM\Index(name="de_mensajeBorrado_idx", columns={"de"})})
 * @ORM\Entity
 */
class Mensajeborrado
{
    /**
     * @var string
     *
     * @ORM\Column(name="idmensajeBorrado", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmensajeborrado;

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
     * @ORM\Column(name="revisado", type="boolean", nullable=false)
     */
    private $revisado;

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
     * Get idmensajeborrado
     *
     * @return string 
     */
    public function getIdmensajeborrado()
    {
        return $this->idmensajeborrado;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     * @return Mensajeborrado
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
     * @return Mensajeborrado
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
     * @return Mensajeborrado
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
     * Set revisado
     *
     * @param boolean $revisado
     * @return Mensajeborrado
     */
    public function setRevisado($revisado)
    {
        $this->revisado = $revisado;

        return $this;
    }

    /**
     * Get revisado
     *
     * @return boolean 
     */
    public function getRevisado()
    {
        return $this->revisado;
    }

    /**
     * Set de
     *
     * @param \GS\ContenidosBundle\Entity\Usuario $de
     * @return Mensajeborrado
     */
    public function setDe(\GS\ContenidosBundle\Entity\Usuario $de = null)
    {
        $this->de = $de;

        return $this;
    }

    /**
     * Get de
     *
     * @return \GS\ContenidosBundle\Entity\Usuario 
     */
    public function getDe()
    {
        return $this->de;
    }

    /**
     * Set para
     *
     * @param \GS\ContenidosBundle\Entity\Usuario $para
     * @return Mensajeborrado
     */
    public function setPara(\GS\ContenidosBundle\Entity\Usuario $para = null)
    {
        $this->para = $para;

        return $this;
    }

    /**
     * Get para
     *
     * @return \GS\ContenidosBundle\Entity\Usuario 
     */
    public function getPara()
    {
        return $this->para;
    }
}

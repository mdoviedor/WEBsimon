<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="user_UNIQUE", columns={"user"})}, indexes={@ORM\Index(name="usuario_tipoDocumentoIdentidad_idx", columns={"tipoDocumentoIdentidad"}), @ORM\Index(name="usuario_tipoUsuario_idx", columns={"tipoUsuario"})})
 * @ORM\Entity(repositoryClass="GS\ProyectosBundle\Entity\UsuarioRepository")
 */
class Usuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="numeroDocumentoIdentidad", type="string", length=15, nullable=false)
     * @ORM\Id
     */
    private $numerodocumentoidentidad;

    /**
     * @var string
     *
     * @ORM\Column(name="primerNombre", type="string", length=45, nullable=false)
     */
    private $primernombre;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoNombre", type="string", length=45, nullable=true)
     */
    private $segundonombre;

    /**
     * @var string
     *
     * @ORM\Column(name="primerApellido", type="string", length=45, nullable=false)
     */
    private $primerapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="segundoApellido", type="string", length=45, nullable=false)
     */
    private $segundoapellido;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoFijo", type="string", length=45, nullable=true)
     */
    private $telefonofijo;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonoCelular", type="string", length=45, nullable=true)
     */
    private $telefonocelular;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \Tipodocumentoidentidad
     *
     * @ORM\ManyToOne(targetEntity="Tipodocumentoidentidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoDocumentoIdentidad", referencedColumnName="idtipoDocumentoIdentidad")
     * })
     */
    private $tipodocumentoidentidad;

    /**
     * @var \Tipousuario
     *
     * @ORM\ManyToOne(targetEntity="Tipousuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoUsuario", referencedColumnName="idtipoUsuario")
     * })
     */
    private $tipousuario;



    /**
     * Get numerodocumentoidentidad
     *
     * @return string 
     */
    public function getNumerodocumentoidentidad()
    {
        return $this->numerodocumentoidentidad;
    }

    /**
     * Set primernombre
     *
     * @param string $primernombre
     * @return Usuario
     */
    public function setPrimernombre($primernombre)
    {
        $this->primernombre = $primernombre;

        return $this;
    }

    /**
     * Get primernombre
     *
     * @return string 
     */
    public function getPrimernombre()
    {
        return $this->primernombre;
    }

    /**
     * Set segundonombre
     *
     * @param string $segundonombre
     * @return Usuario
     */
    public function setSegundonombre($segundonombre)
    {
        $this->segundonombre = $segundonombre;

        return $this;
    }

    /**
     * Get segundonombre
     *
     * @return string 
     */
    public function getSegundonombre()
    {
        return $this->segundonombre;
    }

    /**
     * Set primerapellido
     *
     * @param string $primerapellido
     * @return Usuario
     */
    public function setPrimerapellido($primerapellido)
    {
        $this->primerapellido = $primerapellido;

        return $this;
    }

    /**
     * Get primerapellido
     *
     * @return string 
     */
    public function getPrimerapellido()
    {
        return $this->primerapellido;
    }

    /**
     * Set segundoapellido
     *
     * @param string $segundoapellido
     * @return Usuario
     */
    public function setSegundoapellido($segundoapellido)
    {
        $this->segundoapellido = $segundoapellido;

        return $this;
    }

    /**
     * Get segundoapellido
     *
     * @return string 
     */
    public function getSegundoapellido()
    {
        return $this->segundoapellido;
    }

    /**
     * Set telefonofijo
     *
     * @param string $telefonofijo
     * @return Usuario
     */
    public function setTelefonofijo($telefonofijo)
    {
        $this->telefonofijo = $telefonofijo;

        return $this;
    }

    /**
     * Get telefonofijo
     *
     * @return string 
     */
    public function getTelefonofijo()
    {
        return $this->telefonofijo;
    }

    /**
     * Set telefonocelular
     *
     * @param string $telefonocelular
     * @return Usuario
     */
    public function setTelefonocelular($telefonocelular)
    {
        $this->telefonocelular = $telefonocelular;

        return $this;
    }

    /**
     * Get telefonocelular
     *
     * @return string 
     */
    public function getTelefonocelular()
    {
        return $this->telefonocelular;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Usuario
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime 
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /**
     * Set user
     *
     * @param \GS\ProyectosBundle\Entity\User $user
     * @return Usuario
     */
    public function setUser(\GS\ProyectosBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \GS\ProyectosBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set tipodocumentoidentidad
     *
     * @param \GS\ProyectosBundle\Entity\Tipodocumentoidentidad $tipodocumentoidentidad
     * @return Usuario
     */
    public function setTipodocumentoidentidad(\GS\ProyectosBundle\Entity\Tipodocumentoidentidad $tipodocumentoidentidad = null)
    {
        $this->tipodocumentoidentidad = $tipodocumentoidentidad;

        return $this;
    }

    /**
     * Get tipodocumentoidentidad
     *
     * @return \GS\ProyectosBundle\Entity\Tipodocumentoidentidad 
     */
    public function getTipodocumentoidentidad()
    {
        return $this->tipodocumentoidentidad;
    }

    /**
     * Set tipousuario
     *
     * @param \GS\ProyectosBundle\Entity\Tipousuario $tipousuario
     * @return Usuario
     */
    public function setTipousuario(\GS\ProyectosBundle\Entity\Tipousuario $tipousuario = null)
    {
        $this->tipousuario = $tipousuario;

        return $this;
    }

    /**
     * Get tipousuario
     *
     * @return \GS\ProyectosBundle\Entity\Tipousuario 
     */
    public function getTipousuario()
    {
        return $this->tipousuario;
    }

    /**
     * Set numerodocumentoidentidad
     *
     * @param string $numerodocumentoidentidad
     * @return Usuario
     */
    public function setNumerodocumentoidentidad($numerodocumentoidentidad)
    {
        $this->numerodocumentoidentidad = $numerodocumentoidentidad;

        return $this;
    }
}

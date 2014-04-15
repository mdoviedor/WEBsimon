<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemaUsuario
 *
 * @ORM\Table(name="tema_usuario", indexes={@ORM\Index(name="funcionUsuario_temaUsuario_idx", columns={"funcionUsuario"}), @ORM\Index(name="tema_temaUsuario_idx", columns={"tema"}), @ORM\Index(name="usuario_temaUsuario_idx", columns={"usuario"})})
 * @ORM\Entity
 */
class TemaUsuario
{
    /**
     * @var string
     *
     * @ORM\Column(name="idtema_usuario", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtemaUsuario;

    /**
     * @var \Funcionusuario
     *
     * @ORM\ManyToOne(targetEntity="Funcionusuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="funcionUsuario", referencedColumnName="idfuncionUsuario")
     * })
     */
    private $funcionusuario;

    /**
     * @var \Tema
     *
     * @ORM\ManyToOne(targetEntity="Tema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tema", referencedColumnName="idtema")
     * })
     */
    private $tema;

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
     * Get idtemaUsuario
     *
     * @return string 
     */
    public function getIdtemaUsuario()
    {
        return $this->idtemaUsuario;
    }

    /**
     * Set funcionusuario
     *
     * @param \GS\ConsultasBundle\Entity\Funcionusuario $funcionusuario
     * @return TemaUsuario
     */
    public function setFuncionusuario(\GS\ConsultasBundle\Entity\Funcionusuario $funcionusuario = null)
    {
        $this->funcionusuario = $funcionusuario;

        return $this;
    }

    /**
     * Get funcionusuario
     *
     * @return \GS\ConsultasBundle\Entity\Funcionusuario 
     */
    public function getFuncionusuario()
    {
        return $this->funcionusuario;
    }

    /**
     * Set tema
     *
     * @param \GS\ConsultasBundle\Entity\Tema $tema
     * @return TemaUsuario
     */
    public function setTema(\GS\ConsultasBundle\Entity\Tema $tema = null)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return \GS\ConsultasBundle\Entity\Tema 
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set usuario
     *
     * @param \GS\ConsultasBundle\Entity\Usuario $usuario
     * @return TemaUsuario
     */
    public function setUsuario(\GS\ConsultasBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GS\ConsultasBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

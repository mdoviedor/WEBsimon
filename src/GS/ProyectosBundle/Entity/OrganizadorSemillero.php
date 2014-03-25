<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganizadorSemillero
 *
 * @ORM\Table(name="organizador_semillero", indexes={@ORM\Index(name="semillero_organizadorSemillero_idx", columns={"semillero"}), @ORM\Index(name="usuario_organizadorSemillero_idx", columns={"usuario"})})
 * @ORM\Entity
 */
class OrganizadorSemillero
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idorganizador_semillero", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idorganizadorSemillero;

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
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="numeroDocumentoIdentidad")
     * })
     */
    private $usuario;



    /**
     * Get idorganizadorSemillero
     *
     * @return integer 
     */
    public function getIdorganizadorSemillero()
    {
        return $this->idorganizadorSemillero;
    }

    /**
     * Set semillero
     *
     * @param \GS\ProyectosBundle\Entity\Semillero $semillero
     * @return OrganizadorSemillero
     */
    public function setSemillero(\GS\ProyectosBundle\Entity\Semillero $semillero = null)
    {
        $this->semillero = $semillero;

        return $this;
    }

    /**
     * Get semillero
     *
     * @return \GS\ProyectosBundle\Entity\Semillero 
     */
    public function getSemillero()
    {
        return $this->semillero;
    }

    /**
     * Set usuario
     *
     * @param \GS\ProyectosBundle\Entity\Usuario $usuario
     * @return OrganizadorSemillero
     */
    public function setUsuario(\GS\ProyectosBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \GS\ProyectosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}

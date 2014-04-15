<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nombreelemento
 *
 * @ORM\Table(name="nombreelemento", indexes={@ORM\Index(name="nombreElemento_claseElemento_idx", columns={"claseElemento"})})
 * @ORM\Entity
 */
class Nombreelemento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idnombreElemento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idnombreelemento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;

    /**
     * @var \Claseelemento
     *
     * @ORM\ManyToOne(targetEntity="Claseelemento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="claseElemento", referencedColumnName="idclaseElemento")
     * })
     */
    private $claseelemento;



    /**
     * Get idnombreelemento
     *
     * @return integer 
     */
    public function getIdnombreelemento()
    {
        return $this->idnombreelemento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Nombreelemento
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
     * Set claseelemento
     *
     * @param \GS\ConsultasBundle\Entity\Claseelemento $claseelemento
     * @return Nombreelemento
     */
    public function setClaseelemento(\GS\ConsultasBundle\Entity\Claseelemento $claseelemento = null)
    {
        $this->claseelemento = $claseelemento;

        return $this;
    }

    /**
     * Get claseelemento
     *
     * @return \GS\ConsultasBundle\Entity\Claseelemento 
     */
    public function getClaseelemento()
    {
        return $this->claseelemento;
    }
}

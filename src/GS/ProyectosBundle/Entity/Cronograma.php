<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cronograma
 *
 * @ORM\Table(name="cronograma", indexes={@ORM\Index(name="tema_cronograma_idx", columns={"tema"})})
 * @ORM\Entity
 */
class Cronograma
{
    /**
     * @var string
     *
     * @ORM\Column(name="idcronograma", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcronograma;

    /**
     * @var string
     *
     * @ORM\Column(name="hito", type="text", nullable=false)
     */
    private $hito;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false)
     */
    private $descripcion;

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
     * Get idcronograma
     *
     * @return string 
     */
    public function getIdcronograma()
    {
        return $this->idcronograma;
    }

    /**
     * Set hito
     *
     * @param string $hito
     * @return Cronograma
     */
    public function setHito($hito)
    {
        $this->hito = $hito;

        return $this;
    }

    /**
     * Get hito
     *
     * @return string 
     */
    public function getHito()
    {
        return $this->hito;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Cronograma
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
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Cronograma
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Cronograma
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tema
     *
     * @param \GS\ProyectosBundle\Entity\Tema $tema
     * @return Cronograma
     */
    public function setTema(\GS\ProyectosBundle\Entity\Tema $tema = null)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return \GS\ProyectosBundle\Entity\Tema 
     */
    public function getTema()
    {
        return $this->tema;
    }
}

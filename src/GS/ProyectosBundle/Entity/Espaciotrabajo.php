<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Espaciotrabajo
 *
 * @ORM\Table(name="espaciotrabajo", indexes={@ORM\Index(name="tema_espacioTrabajo_idx", columns={"tema"})})
 * @ORM\Entity(repositoryClass="GS\ProyectosBundle\Entity\EspaciotrabajoRepository")
 */
class Espaciotrabajo
{
    /**
     * @var string
     *
     * @ORM\Column(name="idespacioTrabajo", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $idespaciotrabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=45, nullable=false)
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=400, nullable=false)
     */
    private $url;

    /**
     * @var boolean
     *
     * @ORM\Column(name="compartirMiembros", type="boolean", nullable=false)
     */
    private $compartirmiembros = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="compartirDirector", type="boolean", nullable=false)
     */
    private $compartirdirector = '0';

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
     * Get idespaciotrabajo
     *
     * @return string 
     */
    public function getIdespaciotrabajo()
    {
        return $this->idespaciotrabajo;
    }
    /**
     * Set idespaciotrabajo
     *
     * @param string $idespaciotrabajo
     * @return Espaciotrabajo
     */
    public function setIdespaciotrabajo($idespaciotrabajo)
    {
        $this->idespaciotrabajo = $idespaciotrabajo;

        return $this;
    }
    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Espaciotrabajo
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
     * Set url
     *
     * @param string $url
     * @return Espaciotrabajo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set compartirmiembros
     *
     * @param boolean $compartirmiembros
     * @return Espaciotrabajo
     */
    public function setCompartirmiembros($compartirmiembros)
    {
        $this->compartirmiembros = $compartirmiembros;

        return $this;
    }

    /**
     * Get compartirmiembros
     *
     * @return boolean 
     */
    public function getCompartirmiembros()
    {
        return $this->compartirmiembros;
    }

    /**
     * Set compartirdirector
     *
     * @param boolean $compartirdirector
     * @return Espaciotrabajo
     */
    public function setCompartirdirector($compartirdirector)
    {
        $this->compartirdirector = $compartirdirector;

        return $this;
    }

    /**
     * Get compartirdirector
     *
     * @return boolean 
     */
    public function getCompartirdirector()
    {
        return $this->compartirdirector;
    }

    /**
     * Set tema
     *
     * @param \GS\ProyectosBundle\Entity\Tema $tema
     * @return Espaciotrabajo
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

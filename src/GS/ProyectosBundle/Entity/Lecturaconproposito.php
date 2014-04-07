<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lecturaconproposito
 *
 * @ORM\Table(name="lecturaconproposito", indexes={@ORM\Index(name="bibliografia_lecturaConProposito_idx", columns={"bibliografia"})})
 * @ORM\Entity(repositoryClass="GS\ProyectosBundle\Entity\LecturaconpropositoRepository")
 */
class Lecturaconproposito
{
    /**
     * @var string
     * @ORM\Column(name="idlecturaConProposito", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $idlecturaconproposito;

    /**
     * @var string
     *
     * @ORM\Column(name="propositoGeneral", type="text", nullable=false)
     */
    private $propositogeneral;

    /**
     * @var string
     *
     * @ORM\Column(name="tituloSubcapitulos", type="text", nullable=true)
     */
    private $titulosubcapitulos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="resumen", type="boolean", nullable=false)
     */
    private $resumen;

    /**
     * @var boolean
     *
     * @ORM\Column(name="preguntasFinalCapitulo", type="boolean", nullable=false)
     */
    private $preguntasfinalcapitulo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="glosario", type="boolean", nullable=false)
     */
    private $glosario;

    /**
     * @var string
     *
     * @ORM\Column(name="secciones", type="text", nullable=true)
     */
    private $secciones;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcionIlustraciones", type="text", nullable=true)
     */
    private $descripcionilustraciones;

    /**
     * @var string
     *
     * @ORM\Column(name="resumenLectura", type="text", nullable=true)
     */
    private $resumenlectura;

    /**
     * @var string
     *
     * @ORM\Column(name="lecturaProposito", type="text", nullable=true)
     */
    private $lecturaproposito;

    /**
     * @var string
     *
     * @ORM\Column(name="resumenSeccion", type="text", nullable=true)
     */
    private $resumenseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="preguntas", type="text", nullable=true)
     */
    private $preguntas;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendaciones", type="text", nullable=true)
     */
    private $recomendaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \Bibliografia
     *
     * @ORM\ManyToOne(targetEntity="Bibliografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bibliografia", referencedColumnName="idbibliografia")
     * })
     */
    private $bibliografia;



    /**
     * Get idlecturaconproposito
     *
     * @return string 
     */
    public function getIdlecturaconproposito()
    {
        return $this->idlecturaconproposito;
    }
    
     /**
     * Set idlecturaconproposito
     *
     * @param string $idlecturaconproposito
     * @return Lecturaconproposito
     */
    public function setIdlecturaconproposito($idlecturaconproposito)
    {
        $this->idlecturaconproposito = $idlecturaconproposito;

        return $this;
    }

    /**
     * Set propositogeneral
     *
     * @param string $propositogeneral
     * @return Lecturaconproposito
     */
    public function setPropositogeneral($propositogeneral)
    {
        $this->propositogeneral = $propositogeneral;

        return $this;
    }

    /**
     * Get propositogeneral
     *
     * @return string 
     */
    public function getPropositogeneral()
    {
        return $this->propositogeneral;
    }

    /**
     * Set titulosubcapitulos
     *
     * @param string $titulosubcapitulos
     * @return Lecturaconproposito
     */
    public function setTitulosubcapitulos($titulosubcapitulos)
    {
        $this->titulosubcapitulos = $titulosubcapitulos;

        return $this;
    }

    /**
     * Get titulosubcapitulos
     *
     * @return string 
     */
    public function getTitulosubcapitulos()
    {
        return $this->titulosubcapitulos;
    }

    /**
     * Set resumen
     *
     * @param boolean $resumen
     * @return Lecturaconproposito
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return boolean 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set preguntasfinalcapitulo
     *
     * @param boolean $preguntasfinalcapitulo
     * @return Lecturaconproposito
     */
    public function setPreguntasfinalcapitulo($preguntasfinalcapitulo)
    {
        $this->preguntasfinalcapitulo = $preguntasfinalcapitulo;

        return $this;
    }

    /**
     * Get preguntasfinalcapitulo
     *
     * @return boolean 
     */
    public function getPreguntasfinalcapitulo()
    {
        return $this->preguntasfinalcapitulo;
    }

    /**
     * Set glosario
     *
     * @param boolean $glosario
     * @return Lecturaconproposito
     */
    public function setGlosario($glosario)
    {
        $this->glosario = $glosario;

        return $this;
    }

    /**
     * Get glosario
     *
     * @return boolean 
     */
    public function getGlosario()
    {
        return $this->glosario;
    }

    /**
     * Set secciones
     *
     * @param string $secciones
     * @return Lecturaconproposito
     */
    public function setSecciones($secciones)
    {
        $this->secciones = $secciones;

        return $this;
    }

    /**
     * Get secciones
     *
     * @return string 
     */
    public function getSecciones()
    {
        return $this->secciones;
    }

    /**
     * Set descripcionilustraciones
     *
     * @param string $descripcionilustraciones
     * @return Lecturaconproposito
     */
    public function setDescripcionilustraciones($descripcionilustraciones)
    {
        $this->descripcionilustraciones = $descripcionilustraciones;

        return $this;
    }

    /**
     * Get descripcionilustraciones
     *
     * @return string 
     */
    public function getDescripcionilustraciones()
    {
        return $this->descripcionilustraciones;
    }

    /**
     * Set resumenlectura
     *
     * @param string $resumenlectura
     * @return Lecturaconproposito
     */
    public function setResumenlectura($resumenlectura)
    {
        $this->resumenlectura = $resumenlectura;

        return $this;
    }

    /**
     * Get resumenlectura
     *
     * @return string 
     */
    public function getResumenlectura()
    {
        return $this->resumenlectura;
    }

    /**
     * Set lecturaproposito
     *
     * @param string $lecturaproposito
     * @return Lecturaconproposito
     */
    public function setLecturaproposito($lecturaproposito)
    {
        $this->lecturaproposito = $lecturaproposito;

        return $this;
    }

    /**
     * Get lecturaproposito
     *
     * @return string 
     */
    public function getLecturaproposito()
    {
        return $this->lecturaproposito;
    }

    /**
     * Set resumenseccion
     *
     * @param string $resumenseccion
     * @return Lecturaconproposito
     */
    public function setResumenseccion($resumenseccion)
    {
        $this->resumenseccion = $resumenseccion;

        return $this;
    }

    /**
     * Get resumenseccion
     *
     * @return string 
     */
    public function getResumenseccion()
    {
        return $this->resumenseccion;
    }

    /**
     * Set preguntas
     *
     * @param string $preguntas
     * @return Lecturaconproposito
     */
    public function setPreguntas($preguntas)
    {
        $this->preguntas = $preguntas;

        return $this;
    }

    /**
     * Get preguntas
     *
     * @return string 
     */
    public function getPreguntas()
    {
        return $this->preguntas;
    }

    /**
     * Set recomendaciones
     *
     * @param string $recomendaciones
     * @return Lecturaconproposito
     */
    public function setRecomendaciones($recomendaciones)
    {
        $this->recomendaciones = $recomendaciones;

        return $this;
    }

    /**
     * Get recomendaciones
     *
     * @return string 
     */
    public function getRecomendaciones()
    {
        return $this->recomendaciones;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Lecturaconproposito
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
     * Set bibliografia
     *
     * @param \GS\ProyectosBundle\Entity\Bibliografia $bibliografia
     * @return Lecturaconproposito
     */
    public function setBibliografia(\GS\ProyectosBundle\Entity\Bibliografia $bibliografia = null)
    {
        $this->bibliografia = $bibliografia;

        return $this;
    }

    /**
     * Get bibliografia
     *
     * @return \GS\ProyectosBundle\Entity\Bibliografia 
     */
    public function getBibliografia()
    {
        return $this->bibliografia;
    }
}

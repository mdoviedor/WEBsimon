<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bibliografia
 *
 * @ORM\Table(name="bibliografia", indexes={@ORM\Index(name="categoria_bibliografia_idx", columns={"categoria"}), @ORM\Index(name="tipoElementoBibliografico_bibliografia_idx", columns={"tipoElementoBibliografico"}), @ORM\Index(name="areaInvestigacion_bibliografia_idx", columns={"areaInvestigacion"})})
 * @ORM\Entity(repositoryClass="GS\ProyectosBundle\Entity\BibliografiaRepository")
 */
class Bibliografia
{
    /**
     * @var string
     *
     * @ORM\Column(name="idbibliografia", type="string", length=10, nullable=false)
     * @ORM\Id
     */
    private $idbibliografia;
    
     /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;
    
     /**
     * @var string
     *
     * @ORM\Column(name="nombrearchivo", type="string", length=45, nullable=true)
     */
    private $nombrearchivo;
    
     /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="text", nullable=true)
     */
    private $ubicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="autores", type="text", nullable=false)
     */
    private $autores;

    /**
     * @var boolean
     *
     * @ORM\Column(name="traduccion", type="boolean", nullable=false)
     */
    private $traduccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaEdicion", type="datetime", nullable=true)
     */
    private $fechaedicion;

    /**
     * @var string
     *
     * @ORM\Column(name="editorial", type="text", nullable=true)
     */
    private $editorial;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="text", nullable=true)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="recomendacionesUso", type="text", nullable=true)
     */
    private $recomendacionesuso;

    /**
     * @var string
     *
     * @ORM\Column(name="tablaContenido", type="text", nullable=true)
     */
    private $tablacontenido;

    /**
     * @var string
     *
     * @ORM\Column(name="palabrasClave", type="text", nullable=false)
     */
    private $palabrasclave;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=100, nullable=true)
     */
    private $archivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \Areainvestigacion
     *
     * @ORM\ManyToOne(targetEntity="Areainvestigacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="areaInvestigacion", referencedColumnName="idareaInvestigacion")
     * })
     */
    private $areainvestigacion;

    /**
     * @var \Categoriabibliografia
     *
     * @ORM\ManyToOne(targetEntity="Categoriabibliografia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoria;

    /**
     * @var \Tipoelementobibliografico
     *
     * @ORM\ManyToOne(targetEntity="Tipoelementobibliografico")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoElementoBibliografico", referencedColumnName="idtipoElementoBibliografico")
     * })
     */
    private $tipoelementobibliografico;



    /**
     * Get idbibliografia
     *
     * @return string 
     */
    public function getIdbibliografia()
    {
        return $this->idbibliografia;
    }
    
     /**
     * Set idbibliografia
     *
     * @param string $idbibliografia
     * @return Bibliografia
     */
    public function setIdbibliografia($idbibliografia)
    {
        $this->idbibliografia= $idbibliografia;

        return $this;
    }
    
       /**
     * Set nombre
     *
     * @param string $nombre
     * @return Bibliografia
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string 
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }
    
         /**
     * Set ubicacion
     *
     * @param string $ubicacion
     * @return Bibliografia
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

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
     * Set nombrearchivo
     *
     * @param string $nombrearchivo
     * @return Bibliografia
     */
    public function setNombrearchivo($nombrearchivo)
    {
        $this->nombrearchivo = $nombrearchivo;

        return $this;
    }

    /**
     * Get nombrearchivo
     *
     * @return string 
     */
    public function getNombrearchivo()
    {
        return $this->nombrearchivo;
    }


    /**
     * Set autores
     *
     * @param string $autores
     * @return Bibliografia
     */
    public function setAutores($autores)
    {
        $this->autores = $autores;

        return $this;
    }

    /**
     * Get autores
     *
     * @return string 
     */
    public function getAutores()
    {
        return $this->autores;
    }

    /**
     * Set traduccion
     *
     * @param boolean $traduccion
     * @return Bibliografia
     */
    public function setTraduccion($traduccion)
    {
        $this->traduccion = $traduccion;

        return $this;
    }

    /**
     * Get traduccion
     *
     * @return boolean 
     */
    public function getTraduccion()
    {
        return $this->traduccion;
    }

    /**
     * Set fechaedicion
     *
     * @param \DateTime $fechaedicion
     * @return Bibliografia
     */
    public function setFechaedicion($fechaedicion)
    {
        $this->fechaedicion = $fechaedicion;

        return $this;
    }

    /**
     * Get fechaedicion
     *
     * @return \DateTime 
     */
    public function getFechaedicion()
    {
        return $this->fechaedicion;
    }

    /**
     * Set editorial
     *
     * @param string $editorial
     * @return Bibliografia
     */
    public function setEditorial($editorial)
    {
        $this->editorial = $editorial;

        return $this;
    }

    /**
     * Get editorial
     *
     * @return string 
     */
    public function getEditorial()
    {
        return $this->editorial;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return Bibliografia
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set recomendacionesuso
     *
     * @param string $recomendacionesuso
     * @return Bibliografia
     */
    public function setRecomendacionesuso($recomendacionesuso)
    {
        $this->recomendacionesuso = $recomendacionesuso;

        return $this;
    }

    /**
     * Get recomendacionesuso
     *
     * @return string 
     */
    public function getRecomendacionesuso()
    {
        return $this->recomendacionesuso;
    }

    /**
     * Set tablacontenido
     *
     * @param string $tablacontenido
     * @return Bibliografia
     */
    public function setTablacontenido($tablacontenido)
    {
        $this->tablacontenido = $tablacontenido;

        return $this;
    }

    /**
     * Get tablacontenido
     *
     * @return string 
     */
    public function getTablacontenido()
    {
        return $this->tablacontenido;
    }

    /**
     * Set palabrasclave
     *
     * @param string $palabrasclave
     * @return Bibliografia
     */
    public function setPalabrasclave($palabrasclave)
    {
        $this->palabrasclave = $palabrasclave;

        return $this;
    }

    /**
     * Get palabrasclave
     *
     * @return string 
     */
    public function getPalabrasclave()
    {
        return $this->palabrasclave;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     * @return Bibliografia
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string 
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Bibliografia
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
     * Set areainvestigacion
     *
     * @param \GS\ProyectosBundle\Entity\Areainvestigacion $areainvestigacion
     * @return Bibliografia
     */
    public function setAreainvestigacion(\GS\ProyectosBundle\Entity\Areainvestigacion $areainvestigacion = null)
    {
        $this->areainvestigacion = $areainvestigacion;

        return $this;
    }

    /**
     * Get areainvestigacion
     *
     * @return \GS\ProyectosBundle\Entity\Areainvestigacion 
     */
    public function getAreainvestigacion()
    {
        return $this->areainvestigacion;
    }

    /**
     * Set categoria
     *
     * @param \GS\ProyectosBundle\Entity\Categoriabibliografia $categoria
     * @return Bibliografia
     */
    public function setCategoria(\GS\ProyectosBundle\Entity\Categoriabibliografia $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \GS\ProyectosBundle\Entity\Categoriabibliografia 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set tipoelementobibliografico
     *
     * @param \GS\ProyectosBundle\Entity\Tipoelementobibliografico $tipoelementobibliografico
     * @return Bibliografia
     */
    public function setTipoelementobibliografico(\GS\ProyectosBundle\Entity\Tipoelementobibliografico $tipoelementobibliografico = null)
    {
        $this->tipoelementobibliografico = $tipoelementobibliografico;

        return $this;
    }

    /**
     * Get tipoelementobibliografico
     *
     * @return \GS\ProyectosBundle\Entity\Tipoelementobibliografico 
     */
    public function getTipoelementobibliografico()
    {
        return $this->tipoelementobibliografico;
    }
}

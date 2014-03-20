<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Produccionintelectual
 *
 * @ORM\Table(name="produccionintelectual", indexes={@ORM\Index(name="tipoProduccion_produccionIntelectual_idx", columns={"tipoProduccion"}), @ORM\Index(name="tema_produccionIntelectual_idx", columns={"tema"})})
 * @ORM\Entity
 */
class Produccionintelectual
{
    /**
     * @var string
     *
     * @ORM\Column(name="idproduccionIntelectual", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idproduccionintelectual;

    /**
     * @var string
     *
     * @ORM\Column(name="archivo", type="string", length=100, nullable=false)
     */
    private $archivo;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="text", nullable=false)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="palabrasClave", type="text", nullable=false)
     */
    private $palabrasclave;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fecharegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaModificacion", type="datetime", nullable=false)
     */
    private $fechamodificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaInicioPublicacion", type="datetime", nullable=false)
     */
    private $fechainiciopublicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFinPublicacion", type="datetime", nullable=true)
     */
    private $fechafinpublicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="vecesVisto", type="integer", nullable=false)
     */
    private $vecesvisto = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="acceso", type="boolean", nullable=false)
     */
    private $acceso = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="destacado", type="boolean", nullable=false)
     */
    private $destacado = '0';

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
     * @var \Tipoproduccion
     *
     * @ORM\ManyToOne(targetEntity="Tipoproduccion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipoProduccion", referencedColumnName="idtipoProduccion")
     * })
     */
    private $tipoproduccion;



    /**
     * Get idproduccionintelectual
     *
     * @return string 
     */
    public function getIdproduccionintelectual()
    {
        return $this->idproduccionintelectual;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     * @return Produccionintelectual
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
     * Set resumen
     *
     * @param string $resumen
     * @return Produccionintelectual
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
     * Set palabrasclave
     *
     * @param string $palabrasclave
     * @return Produccionintelectual
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
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     * @return Produccionintelectual
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
     * Set fechamodificacion
     *
     * @param \DateTime $fechamodificacion
     * @return Produccionintelectual
     */
    public function setFechamodificacion($fechamodificacion)
    {
        $this->fechamodificacion = $fechamodificacion;

        return $this;
    }

    /**
     * Get fechamodificacion
     *
     * @return \DateTime 
     */
    public function getFechamodificacion()
    {
        return $this->fechamodificacion;
    }

    /**
     * Set fechainiciopublicacion
     *
     * @param \DateTime $fechainiciopublicacion
     * @return Produccionintelectual
     */
    public function setFechainiciopublicacion($fechainiciopublicacion)
    {
        $this->fechainiciopublicacion = $fechainiciopublicacion;

        return $this;
    }

    /**
     * Get fechainiciopublicacion
     *
     * @return \DateTime 
     */
    public function getFechainiciopublicacion()
    {
        return $this->fechainiciopublicacion;
    }

    /**
     * Set fechafinpublicacion
     *
     * @param \DateTime $fechafinpublicacion
     * @return Produccionintelectual
     */
    public function setFechafinpublicacion($fechafinpublicacion)
    {
        $this->fechafinpublicacion = $fechafinpublicacion;

        return $this;
    }

    /**
     * Get fechafinpublicacion
     *
     * @return \DateTime 
     */
    public function getFechafinpublicacion()
    {
        return $this->fechafinpublicacion;
    }

    /**
     * Set vecesvisto
     *
     * @param integer $vecesvisto
     * @return Produccionintelectual
     */
    public function setVecesvisto($vecesvisto)
    {
        $this->vecesvisto = $vecesvisto;

        return $this;
    }

    /**
     * Get vecesvisto
     *
     * @return integer 
     */
    public function getVecesvisto()
    {
        return $this->vecesvisto;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Produccionintelectual
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set acceso
     *
     * @param boolean $acceso
     * @return Produccionintelectual
     */
    public function setAcceso($acceso)
    {
        $this->acceso = $acceso;

        return $this;
    }

    /**
     * Get acceso
     *
     * @return boolean 
     */
    public function getAcceso()
    {
        return $this->acceso;
    }

    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Produccionintelectual
     */
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;

        return $this;
    }

    /**
     * Get destacado
     *
     * @return boolean 
     */
    public function getDestacado()
    {
        return $this->destacado;
    }

    /**
     * Set tema
     *
     * @param \GS\UsuarioBundle\Entity\Tema $tema
     * @return Produccionintelectual
     */
    public function setTema(\GS\UsuarioBundle\Entity\Tema $tema = null)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return \GS\UsuarioBundle\Entity\Tema 
     */
    public function getTema()
    {
        return $this->tema;
    }

    /**
     * Set tipoproduccion
     *
     * @param \GS\UsuarioBundle\Entity\Tipoproduccion $tipoproduccion
     * @return Produccionintelectual
     */
    public function setTipoproduccion(\GS\UsuarioBundle\Entity\Tipoproduccion $tipoproduccion = null)
    {
        $this->tipoproduccion = $tipoproduccion;

        return $this;
    }

    /**
     * Get tipoproduccion
     *
     * @return \GS\UsuarioBundle\Entity\Tipoproduccion 
     */
    public function getTipoproduccion()
    {
        return $this->tipoproduccion;
    }
}

<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Elementoinventario
 *
 * @ORM\Table(name="elementoinventario", indexes={@ORM\Index(name="elementoInventario_centralCosotos_idx", columns={"centralCostos"}), @ORM\Index(name="elementoInventario_nombreElemento_idx", columns={"nombreElemento"})})
 * @ORM\Entity
 */
class Elementoinventario
{
    /**
     * @var string
     *
     * @ORM\Column(name="idelementoInventario", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idelementoinventario;

    /**
     * @var string
     *
     * @ORM\Column(name="otroNumeroInventario", type="string", length=45, nullable=true)
     */
    private $otronumeroinventario;

    /**
     * @var string
     *
     * @ORM\Column(name="serial", type="string", length=80, nullable=true)
     */
    private $serial;

    /**
     * @var string
     *
     * @ORM\Column(name="costo", type="string", length=45, nullable=true)
     */
    private $costo;

    /**
     * @var string
     *
     * @ORM\Column(name="marca", type="string", length=45, nullable=true)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="modelo", type="string", length=45, nullable=true)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \Centralcostos
     *
     * @ORM\ManyToOne(targetEntity="Centralcostos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="centralCostos", referencedColumnName="idcentralCostos")
     * })
     */
    private $centralcostos;

    /**
     * @var \Nombreelemento
     *
     * @ORM\ManyToOne(targetEntity="Nombreelemento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nombreElemento", referencedColumnName="idnombreElemento")
     * })
     */
    private $nombreelemento;



    /**
     * Get idelementoinventario
     *
     * @return string 
     */
    public function getIdelementoinventario()
    {
        return $this->idelementoinventario;
    }

    /**
     * Set otronumeroinventario
     *
     * @param string $otronumeroinventario
     * @return Elementoinventario
     */
    public function setOtronumeroinventario($otronumeroinventario)
    {
        $this->otronumeroinventario = $otronumeroinventario;

        return $this;
    }

    /**
     * Get otronumeroinventario
     *
     * @return string 
     */
    public function getOtronumeroinventario()
    {
        return $this->otronumeroinventario;
    }

    /**
     * Set serial
     *
     * @param string $serial
     * @return Elementoinventario
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return string 
     */
    public function getSerial()
    {
        return $this->serial;
    }

    /**
     * Set costo
     *
     * @param string $costo
     * @return Elementoinventario
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get costo
     *
     * @return string 
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * Set marca
     *
     * @param string $marca
     * @return Elementoinventario
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return string 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set modelo
     *
     * @param string $modelo
     * @return Elementoinventario
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string 
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Elementoinventario
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
     * Set centralcostos
     *
     * @param \GS\UsuarioBundle\Entity\Centralcostos $centralcostos
     * @return Elementoinventario
     */
    public function setCentralcostos(\GS\UsuarioBundle\Entity\Centralcostos $centralcostos = null)
    {
        $this->centralcostos = $centralcostos;

        return $this;
    }

    /**
     * Get centralcostos
     *
     * @return \GS\UsuarioBundle\Entity\Centralcostos 
     */
    public function getCentralcostos()
    {
        return $this->centralcostos;
    }

    /**
     * Set nombreelemento
     *
     * @param \GS\UsuarioBundle\Entity\Nombreelemento $nombreelemento
     * @return Elementoinventario
     */
    public function setNombreelemento(\GS\UsuarioBundle\Entity\Nombreelemento $nombreelemento = null)
    {
        $this->nombreelemento = $nombreelemento;

        return $this;
    }

    /**
     * Get nombreelemento
     *
     * @return \GS\UsuarioBundle\Entity\Nombreelemento 
     */
    public function getNombreelemento()
    {
        return $this->nombreelemento;
    }
}

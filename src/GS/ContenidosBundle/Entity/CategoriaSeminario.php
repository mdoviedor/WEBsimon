<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaSeminario
 *
 * @ORM\Table(name="categoria_seminario", indexes={@ORM\Index(name="categoriaSeminario_categoriaSeminario_idx", columns={"categoriaPublicacion"}), @ORM\Index(name="seminario_categoriaSeminario_idx", columns={"seminario"})})
 * @ORM\Entity
 */
class CategoriaSeminario
{
    /**
     * @var string
     *
     * @ORM\Column(name="idcategoria_seminario", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriaSeminario;

    /**
     * @var \Categoriapublicacion
     *
     * @ORM\ManyToOne(targetEntity="Categoriapublicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoriaPublicacion", referencedColumnName="idcategoriaPublicacion")
     * })
     */
    private $categoriapublicacion;

    /**
     * @var \Seminario
     *
     * @ORM\ManyToOne(targetEntity="Seminario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="seminario", referencedColumnName="idseminario")
     * })
     */
    private $seminario;



    /**
     * Get idcategoriaSeminario
     *
     * @return string 
     */
    public function getIdcategoriaSeminario()
    {
        return $this->idcategoriaSeminario;
    }

    /**
     * Set categoriapublicacion
     *
     * @param \GS\ContenidosBundle\Entity\Categoriapublicacion $categoriapublicacion
     * @return CategoriaSeminario
     */
    public function setCategoriapublicacion(\GS\ContenidosBundle\Entity\Categoriapublicacion $categoriapublicacion = null)
    {
        $this->categoriapublicacion = $categoriapublicacion;

        return $this;
    }

    /**
     * Get categoriapublicacion
     *
     * @return \GS\ContenidosBundle\Entity\Categoriapublicacion 
     */
    public function getCategoriapublicacion()
    {
        return $this->categoriapublicacion;
    }

    /**
     * Set seminario
     *
     * @param \GS\ContenidosBundle\Entity\Seminario $seminario
     * @return CategoriaSeminario
     */
    public function setSeminario(\GS\ContenidosBundle\Entity\Seminario $seminario = null)
    {
        $this->seminario = $seminario;

        return $this;
    }

    /**
     * Get seminario
     *
     * @return \GS\ContenidosBundle\Entity\Seminario 
     */
    public function getSeminario()
    {
        return $this->seminario;
    }
}

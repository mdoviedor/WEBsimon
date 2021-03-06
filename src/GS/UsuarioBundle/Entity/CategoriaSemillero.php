<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaSemillero
 *
 * @ORM\Table(name="categoria_semillero", indexes={@ORM\Index(name="publicacionSemillero_categoria_idx", columns={"publicacionSemillero"}), @ORM\Index(name="categoriaPublicacion_categoria_idx", columns={"categoriaPublicacion"})})
 * @ORM\Entity
 */
class CategoriaSemillero
{
    /**
     * @var string
     *
     * @ORM\Column(name="idcategoria_semillero", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriaSemillero;

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
     * @var \Publicacionsemillero
     *
     * @ORM\ManyToOne(targetEntity="Publicacionsemillero")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="publicacionSemillero", referencedColumnName="idpublicacionSemillero")
     * })
     */
    private $publicacionsemillero;



    /**
     * Get idcategoriaSemillero
     *
     * @return string 
     */
    public function getIdcategoriaSemillero()
    {
        return $this->idcategoriaSemillero;
    }

    /**
     * Set categoriapublicacion
     *
     * @param \GS\UsuarioBundle\Entity\Categoriapublicacion $categoriapublicacion
     * @return CategoriaSemillero
     */
    public function setCategoriapublicacion(\GS\UsuarioBundle\Entity\Categoriapublicacion $categoriapublicacion = null)
    {
        $this->categoriapublicacion = $categoriapublicacion;

        return $this;
    }

    /**
     * Get categoriapublicacion
     *
     * @return \GS\UsuarioBundle\Entity\Categoriapublicacion 
     */
    public function getCategoriapublicacion()
    {
        return $this->categoriapublicacion;
    }

    /**
     * Set publicacionsemillero
     *
     * @param \GS\UsuarioBundle\Entity\Publicacionsemillero $publicacionsemillero
     * @return CategoriaSemillero
     */
    public function setPublicacionsemillero(\GS\UsuarioBundle\Entity\Publicacionsemillero $publicacionsemillero = null)
    {
        $this->publicacionsemillero = $publicacionsemillero;

        return $this;
    }

    /**
     * Get publicacionsemillero
     *
     * @return \GS\UsuarioBundle\Entity\Publicacionsemillero 
     */
    public function getPublicacionsemillero()
    {
        return $this->publicacionsemillero;
    }
}

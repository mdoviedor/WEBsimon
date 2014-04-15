<?php

namespace GS\ContenidosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaArticulo
 *
 * @ORM\Table(name="categoria_articulo", indexes={@ORM\Index(name="categoria_categoriaArticulo_idx", columns={"categoria"}), @ORM\Index(name="articulo_categoriaArticulo_idx", columns={"articuloo"})})
 * @ORM\Entity
 */
class CategoriaArticulo
{
    /**
     * @var string
     *
     * @ORM\Column(name="idcategoria_articulo", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcategoriaArticulo;

    /**
     * @var \Articulo
     *
     * @ORM\ManyToOne(targetEntity="Articulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="articuloo", referencedColumnName="idarticulo")
     * })
     */
    private $articuloo;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="idcategoria")
     * })
     */
    private $categoria;



    /**
     * Get idcategoriaArticulo
     *
     * @return string 
     */
    public function getIdcategoriaArticulo()
    {
        return $this->idcategoriaArticulo;
    }

    /**
     * Set articuloo
     *
     * @param \GS\ContenidosBundle\Entity\Articulo $articuloo
     * @return CategoriaArticulo
     */
    public function setArticuloo(\GS\ContenidosBundle\Entity\Articulo $articuloo = null)
    {
        $this->articuloo = $articuloo;

        return $this;
    }

    /**
     * Get articuloo
     *
     * @return \GS\ContenidosBundle\Entity\Articulo 
     */
    public function getArticuloo()
    {
        return $this->articuloo;
    }

    /**
     * Set categoria
     *
     * @param \GS\ContenidosBundle\Entity\Categoria $categoria
     * @return CategoriaArticulo
     */
    public function setCategoria(\GS\ContenidosBundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \GS\ContenidosBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}

<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TemaBibliografia
 *
 * @ORM\Table(name="tema_bibliografia", indexes={@ORM\Index(name="tema_temabibliografia_idx", columns={"tema"}), @ORM\Index(name="bibliografica_temabibliografia_idx", columns={"bibliografia"})})
 * @ORM\Entity
 */
class TemaBibliografia
{
    /**
     * @var string
     *
     * @ORM\Column(name="idtema_bibliografia", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtemaBibliografia;

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
     * @var \Tema
     *
     * @ORM\ManyToOne(targetEntity="Tema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tema", referencedColumnName="idtema")
     * })
     */
    private $tema;



    /**
     * Get idtemaBibliografia
     *
     * @return string 
     */
    public function getIdtemaBibliografia()
    {
        return $this->idtemaBibliografia;
    }

    /**
     * Set bibliografia
     *
     * @param \GS\ConsultasBundle\Entity\Bibliografia $bibliografia
     * @return TemaBibliografia
     */
    public function setBibliografia(\GS\ConsultasBundle\Entity\Bibliografia $bibliografia = null)
    {
        $this->bibliografia = $bibliografia;

        return $this;
    }

    /**
     * Get bibliografia
     *
     * @return \GS\ConsultasBundle\Entity\Bibliografia 
     */
    public function getBibliografia()
    {
        return $this->bibliografia;
    }

    /**
     * Set tema
     *
     * @param \GS\ConsultasBundle\Entity\Tema $tema
     * @return TemaBibliografia
     */
    public function setTema(\GS\ConsultasBundle\Entity\Tema $tema = null)
    {
        $this->tema = $tema;

        return $this;
    }

    /**
     * Get tema
     *
     * @return \GS\ConsultasBundle\Entity\Tema 
     */
    public function getTema()
    {
        return $this->tema;
    }
}

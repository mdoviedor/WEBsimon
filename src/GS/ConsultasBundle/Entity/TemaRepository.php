<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TemaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TemaRepository extends EntityRepository
{
    /*
     * Consulta para la busqueda avanzada de los temas 
     
     */
        public function busquedaAvanzada($titulo,$estado,$numeroResultados)
    {
        $em = $this->getEntityManager();

        $dql = "select t
            from GSConsultasBundle:Tema t
            where (t.titulo LIKE :titulo AND t.estado=:estado)";

        $query = $em->createQuery($dql);
        $query->setParameter('titulo', '%' . $titulo . '%');
        $query->setParameter('estado', $estado);
        $query->setMaxResults($numeroResultados);
        $temas = $query->getResult();

        return $temas;
    }
    
    /*
     * Consulta para la busqueda avanzada de los temas con mas opciones VERMAS
     
     */
    
    public function verMas($titulo,$estado)
    {
        $em = $this->getEntityManager();

        $dql = "select t
            from GSConsultasBundle:Tema t
            where (t.titulo LIKE :titulo AND t.estado=:estado)";

        $query = $em->createQuery($dql);
        $query->setParameter('titulo', '%' . $titulo . '%');
        $query->setParameter('estado', $estado);
        $temas = $query->getResult();

        return $temas;
    }
}

<?php

namespace GS\ConsultasBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProduccionintelectualRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProduccionintelectualRepository extends EntityRepository {
    /*
     * Consulta para la busqueda avanzada de la produccion intelectual 
     */

    public function busquedaAvanzada($estado, $titulo, $tipoproduccion, $numeroresultados, $primernombre, $primerapellido, $desde, $hasta) {

        return $this->getEntityManager()
                        ->createQuery(
                                "SELECT p FROM GSConsultasBundle:Usuario u JOIN GSConsultasBundle:TemaUsuario e WITH e.usuario = u.numerodocumentoidentidad JOIN GSConsultasBundle:Produccionintelectual p WITH p.tema = e.tema JOIN GSConsultasBundle:Tema ti WITH p.tema = ti.idtema AND p.estado = true AND "
                                . "((u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido)OR "
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.fecharegistro BETWEEN :desde AND :hasta)OR "
                                . "(u.primernombre LIKE :primernombre AND p.titulo LIKE :titulo) OR "
                                . "(u.primernombre LIKE :primernombre AND p.tipoproduccion = :tipoproduccion) OR "
                                . "(u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo) OR  "
                                . "(u.primerapellido LIKE :primerapellido AND p.tipoproduccion = :tipoproduccion)OR "
                                . "(p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion) OR"
                                . "(p.tipoproduccion = :tipoproduccion) OR "
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo) OR "
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.tipoproduccion = :tipoproduccion)OR "
                                . "(u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion) OR "
                                . "(u.primernombre LIKE :primernombre AND p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion)OR "
                                . "(p.fecharegistro BETWEEN :desde AND :hasta)OR"
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion AND p.fecharegistro BETWEEN :desde AND :hasta))"
                        )
                        ->setParameter('titulo', '%' . $titulo . '%')
                        ->setParameter('tipoproduccion', $tipoproduccion)
                        ->setParameter('primernombre', $primernombre . '%')
                        ->setParameter('primerapellido', $primerapellido . '%')
                        ->setParameter('desde', new \DateTime($desde))
                        ->setParameter('hasta', new \DateTime($hasta))
                        // ->setParameter('destacado', $destacado)
                        ->setMaxResults($numeroresultados)//maneja el numero de resultados que se visualizaran 
                        ->getResult();
    }
    
      public function busquedaAvanzadaAdministrador($estado, $titulo, $tipoproduccion, $numeroresultados, $primernombre, $primerapellido, $desde, $hasta) {

        return $this->getEntityManager()
                        ->createQuery(
                                "SELECT p FROM GSConsultasBundle:Usuario u JOIN GSConsultasBundle:TemaUsuario e WITH e.usuario = u.numerodocumentoidentidad JOIN GSConsultasBundle:Produccionintelectual p WITH p.tema = e.tema JOIN GSConsultasBundle:Tema ti WITH p.tema = ti.idtema AND"
                                . "((u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido)OR "
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.fecharegistro BETWEEN :desde AND :hasta)OR "
                                . "(u.primernombre LIKE :primernombre AND p.titulo LIKE :titulo) OR "
                                . "(u.primernombre LIKE :primernombre AND p.tipoproduccion = :tipoproduccion) OR "
                                . "(u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo) OR  "
                                . "(u.primerapellido LIKE :primerapellido AND p.tipoproduccion = :tipoproduccion)OR "
                                . "(p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion) OR"
                                . "(p.tipoproduccion = :tipoproduccion) OR "
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo) OR "
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.tipoproduccion = :tipoproduccion)OR "
                                . "(u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion) OR "
                                . "(u.primernombre LIKE :primernombre AND p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion)OR "
                                . "(p.fecharegistro BETWEEN :desde AND :hasta)OR"
                                . "(u.primernombre LIKE :primernombre AND u.primerapellido LIKE :primerapellido AND p.titulo LIKE :titulo AND p.tipoproduccion = :tipoproduccion AND p.fecharegistro BETWEEN :desde AND :hasta))"
                        )
                        ->setParameter('titulo', '%' . $titulo . '%')
                        ->setParameter('tipoproduccion', $tipoproduccion)
                        ->setParameter('primernombre', $primernombre . '%')
                        ->setParameter('primerapellido', $primerapellido . '%')
                        ->setParameter('desde', new \DateTime($desde))
                        ->setParameter('hasta', new \DateTime($hasta))
                        // ->setParameter('destacado', $destacado)
                        ->setMaxResults($numeroresultados)//maneja el numero de resultados que se visualizaran 
                        ->getResult();
    }

}

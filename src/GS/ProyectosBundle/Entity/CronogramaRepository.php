<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CronogramaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CronogramaRepository extends EntityRepository
{
    public function buscarUltimoCronograma() {//Traer el ultimo registro hecho en la base de datos
        return $this->getEntityManager()
                        ->createQuery('SELECT c.idcronograma FROM GSProyectosBundle:Cronograma c ORDER BY c.idcronograma DESC')
                        ->setMaxResults(1)
                        ->getResult();
    }
}
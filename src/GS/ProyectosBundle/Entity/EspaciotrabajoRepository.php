<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EspaciotrabajoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EspaciotrabajoRepository extends EntityRepository
{
    public function buscarUltimoEspacioTrabajo() {//Traer el ultimo registro hecho en la base de datos
        return $this->getEntityManager()
                        ->createQuery('SELECT e.idespaciotrabajo FROM GSProyectosBundle:Espaciotrabajo e ORDER BY e.idespaciotrabajo DESC')
                        ->setMaxResults(1)
                        ->getResult();
    }
}

<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MensajeborradoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MensajeborradoRepository extends EntityRepository
{
      public function buscarUltimoMensajeBorrado() {//Traer el ultimo registro hecho en la base de datos
        return $this->getEntityManager()
                        ->createQuery('SELECT c.idmensajeborrado FROM GSProyectosBundle:Mensajeborrado c ORDER BY c.idmensajeborrado DESC')
                        ->setMaxResults(1)
                        ->getResult();
    }
}
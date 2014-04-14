<?php

namespace GS\ProyectosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * MensajeenviadoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MensajeenviadoRepository extends EntityRepository
{
      public function buscarUltimoMensajeEnviado() {//Traer el ultimo registro hecho en la base de datos
        return $this->getEntityManager()
                        ->createQuery('SELECT c.idmensajeenviado FROM GSProyectosBundle:Mensajeenviado c ORDER BY c.idmensajeenviado DESC')
                        ->setMaxResults(1)
                        ->getResult();
    }
}
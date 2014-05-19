<?php

namespace GS\UsuarioBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UsuarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsuarioRepository extends EntityRepository {
    /*
     * Buscar usuario desde el panel de aministración de usuarios. 
     */

    public function buscarUsuarios($parametro, $limite) {
        return $this->getEntityManager()
                        ->createQuery('SELECT u FROM GSUsuarioBundle:Usuario u WHERE u.primernombre LIKE :parametro OR u.primerapellido LIKE :parametro OR u.numerodocumentoidentidad = :documento')
                        ->setParameter('parametro', $parametro . '%')
                        ->setParameter('documento', $parametro )
                        ->setMaxResults($limite)
                        ->getResult();
    }

}
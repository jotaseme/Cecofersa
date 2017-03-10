<?php

namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * AsociadsoRepository
 *
 */
class AsociadosRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM BackBundle:Asociados a ORDER BY a.nombre ASC'
            )
            ->getResult();
    }
}

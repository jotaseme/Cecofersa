<?php

namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * FamiliasAsociadosRepository
 *
 */
class FamiliasAsociadosRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByName($id_asociado)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT f FROM BackBundle:FamiliasAsociados f WHERE f.idAsociado = :id_asociado ORDER BY f.nombreFamilia ASC ')
            ->setParameter('id_asociado', $id_asociado)
            ->getResult();
    }
}

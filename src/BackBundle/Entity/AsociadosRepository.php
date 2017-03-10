<?php

namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * AsociadsoRepository
 *
 */
class AsociadosRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByName($filter)
    {
        if($filter=='activos'){
            $filter=1;
        }elseif($filter=='inactivos'){
            $filter = 0;
        }else{
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT a FROM BackBundle:Asociados a ORDER BY a.nombre ASC ')
                ->getResult();
        }
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM BackBundle:Asociados a WHERE a.activo = :filter ORDER BY a.nombre ASC ')
            ->setParameter('filter', $filter)
            ->getResult();
    }
}

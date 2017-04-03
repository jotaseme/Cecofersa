<?php

namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * ProveedoresRepository
 *
 */
class ProveedoresRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByName($filter){
        if($filter=='activos'){
            $filter=1;
        }elseif($filter=='inactivos'){
            $filter = 0;
        }else{
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT a FROM BackBundle:Proveedores a ORDER BY a.proveedor ASC ')
                ->getResult();
        }
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM BackBundle:Proveedores a WHERE a.activo = :filter ORDER BY a.proveedor ASC ')
            ->setParameter('filter', $filter)
            ->getResult();
    }
}
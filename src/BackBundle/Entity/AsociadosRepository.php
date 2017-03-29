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

    public function findAllOrderedByNameRelacionAsociados($tipo)
    {
        if($tipo == 'Todos'){
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT a FROM BackBundle:Asociados a WHERE a.nombre != :nombre1
                    and a.nombre != :nombre2 and a.nombre != :nombre3 and a.activo = :activo ORDER BY a.nombre ASC ')
                ->setParameter('nombre1', 'CECOFERSA')
                ->setParameter('nombre2', 'CECOFERSA PORTUGAL')
                ->setParameter('nombre3', 'DELCREDIT')
                ->setParameter('activo', '1')
                ->getResult();
        }elseif($tipo == 'Portugal'){
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT a FROM BackBundle:Asociados a WHERE a.nombre != :nombre1
                    and a.nombre != :nombre2 and a.nombre != :nombre3 and a.activo = :activo and a.pais = :pais ORDER BY a.nombre ASC ')
                ->setParameter('nombre1', 'CECOFERSA')
                ->setParameter('nombre2', 'CECOFERSA PORTUGAL')
                ->setParameter('nombre3', 'DELCREDIT')
                ->setParameter('activo', '1')
                ->setParameter('pais', 'PT')
                ->getResult();
        }
    }

    public function findAllOrderByComunidadProvinciaNombre($pais){
        if($pais == 'es'){
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT a FROM BackBundle:Asociados a WHERE a.activo = 1 and a.pais = \'ES\' and a.nombre != :nombre1 and a.nombre != :nombre2 and a.nombre != :nombre3 order by a.comunidadAutonoma, a.provincia, a.nombre asc')
                ->setParameter('nombre1', 'CECOFERSA')
                ->setParameter('nombre2', 'CECOFERSA PORTUGAL')
                ->setParameter('nombre3', 'DELCREDIT')
                ->getResult();
        }elseif($pais == 'pt'){
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT a FROM BackBundle:Asociados a WHERE a.activo = 1 and a.pais = \'PT\' and a.nombre != :nombre1 and a.nombre != :nombre2 and a.nombre != :nombre3 order by a.provincia, a.nombre asc')
                ->setParameter('nombre1', 'CECOFERSA')
                ->setParameter('nombre2', 'CECOFERSA PORTUGAL')
                ->setParameter('nombre3', 'DELCREDIT')
                ->getResult();
        }

    }
}

<?php

namespace BackBundle\Entity;namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * DireccionesAsociadosRepository
 *
 */
class DireccionesAsociadosRepository  extends \Doctrine\ORM\EntityRepository
{
    public function findAllOrderedByNameEtiquetasAsociados($tipo)
    {
        if($tipo == 'Todos'){
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT d, a.nombre, a.contacto FROM BackBundle:DireccionesAsociados d JOIN BackBundle:Asociados a WITH  d.idasociado= a.idAsociado WHERE a.nombre != :nombre1
                    and a.nombre != :nombre2 and a.nombre != :nombre3 and a.activo = :activo and d.etiquetas = :etiquetas ORDER BY a.nombre ASC ')
                ->setParameter('nombre1', 'CECOFERSA')
                ->setParameter('nombre2', 'CECOFERSA PORTUGAL')
                ->setParameter('nombre3', 'DELCREDIT')
                ->setParameter('etiquetas', 'VERDADERO')
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
}
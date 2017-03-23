<?php

namespace BackBundle\Entity;namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * DireccionesAsociadosRepository
 *
 */
class BlogRepository  extends \Doctrine\ORM\EntityRepository
{
    public function findAllByIdiomaOrderedByFecha($filter)
    {
        if ($filter == 'es' || $filter == 'en' || $filter == 'pt') {
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT b FROM BackBundle:Blog b WHERE b.idioma = :filter ORDER BY b.fecha DESC')
                ->setParameter('filter', /*$filter*/'es')
                ->getResult();
        } else {
            return $this->getEntityManager()
                ->createQuery(
                    'SELECT b FROM BackBundle:Blog b WHERE b.idioma = :filter ORDER BY b.fecha DESC')
                ->setParameter('filter', 'es')
                ->getResult();
        }
    }
}
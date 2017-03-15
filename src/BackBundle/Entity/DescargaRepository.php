<?php

namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;
/**
 * DescargaRepository
 *
 */
class DescargaRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDownloadsLast24H($id_usuario)
    {
        $time_now = new \DateTime('now');
        $time_yesterday = date('Y-m-d H:i:s', strtotime('-2 day', strtotime($time_now->format('Y-m-d H:i:s'))));

        return $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM BackBundle:Descarga d WHERE d.usuarioUsuario = :id_usuario AND d.fecha BETWEEN :yesterday AND :today ')
            ->setParameter('id_usuario', $id_usuario)
            ->setParameter('today', $time_now->format('Y-m-d H:i:s'))
            ->setParameter('yesterday', $time_yesterday)
            ->getResult();
    }
}

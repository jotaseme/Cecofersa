<?php

namespace BackBundle\Entity;
use Doctrine\ORM\EntityRepository;
use DoctrineExtensions\Query\Mysql;
/**
 * DescargaRepository
 *
 */
class DescargaRepository extends \Doctrine\ORM\EntityRepository
{
    public function findDownloadsLast24H($id_usuario)
    {
        $time_now = new \DateTime('now');
        $time_yesterday = date('Y-m-d H:i:s', strtotime('-1 day', strtotime($time_now->format('Y-m-d H:i:s'))));

        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(d) FROM BackBundle:Descarga d WHERE d.usuarioUsuario = :id_usuario AND d.fecha BETWEEN :yesterday AND :today ')
            ->setParameter('id_usuario', $id_usuario)
            ->setParameter('today', $time_now->format('Y-m-d H:i:s'))
            ->setParameter('yesterday', $time_yesterday)
            ->getSingleScalarResult();
    }

    public function findDownloadsLast7D($id_usuario)
    {
        $time_now = new \DateTime('now');
        $time_yesterday = date('Y-m-d H:i:s', strtotime('-7 day', strtotime($time_now->format('Y-m-d H:i:s'))));

        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(d) FROM BackBundle:Descarga d WHERE d.usuarioUsuario = :id_usuario AND d.fecha BETWEEN :yesterday AND :today ')
            ->setParameter('id_usuario', $id_usuario)
            ->setParameter('today', $time_now->format('Y-m-d H:i:s'))
            ->setParameter('yesterday', $time_yesterday)
            ->getSingleScalarResult();
    }


    public function findDownloadsLast30D($id_usuario)
    {
        $time_now = new \DateTime('now');
        $time_yesterday = date('Y-m-d H:i:s', strtotime('-30 day', strtotime($time_now->format('Y-m-d H:i:s'))));

        return $this->getEntityManager()
            ->createQuery(
                'SELECT count(d) FROM BackBundle:Descarga d WHERE d.usuarioUsuario = :id_usuario AND d.fecha BETWEEN :yesterday AND :today ')
            ->setParameter('id_usuario', $id_usuario)
            ->setParameter('today', $time_now->format('Y-m-d H:i:s'))
            ->setParameter('yesterday', $time_yesterday)
            ->getSingleScalarResult();
    }

    public function findDownloadYears($id_usuario){

        $repo =  $this->getEntityManager()
            ->getRepository('BackBundle:Descarga');

        $qb = $repo->createQueryBuilder('d')
            ->select('YEAR(d.fecha)')
            ->distinct()
            ->where('d.usuarioUsuario = :id_usuario')
            ->setParameter('id_usuario',$id_usuario)
            ->getQuery();
        $years = $qb->getResult();

        return $years;
    }


    public function count_downloads($month,$year,$id_usuario)
    {
        $qb = $this->getEntityManager()
            ->createQueryBuilder();
        $qb->select('COUNT(d.idDescarga)')
            ->from('BackBundle:Descarga', 'd')
            ->where('YEAR(d.fecha) = :year')
            ->andWhere('MONTH(d.fecha) = :current_month')
            ->andWhere('d.usuarioUsuario = :id_usuario')
            ->setParameter('year', $year)
            ->setParameter('current_month', $month)
            ->setParameter('id_usuario', $id_usuario);
        try{
            $result = $qb->getQuery()->getSingleScalarResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return false;
        }

        return $result;
    }

    public function findAllOrderedByDate($id_usuario)
    {
        try{
            $descargas = $this->getEntityManager()
                ->createQuery(
                    'SELECT d FROM BackBundle:Descarga d WHERE d.usuarioUsuario = :id_usuario ORDER BY d.fecha DESC'
                )->setParameter('id_usuario',$id_usuario)
                ->getResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return false;
        }
        return $descargas;
    }

    public function count_downloads_history($year,$id_usuario)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('COUNT(d.idDescarga)')
            ->from('BackBundle:Descarga', 'd')
            ->where('YEAR(d.fecha) = :year')
            ->andWhere('d.usuarioUsuario = :id_usuario')
            ->groupBy('d.usuarioUsuario')
            ->setParameter('year', $year)
            ->setParameter('id_usuario', $id_usuario);
        try{
            $result = $qb->getQuery()->getSingleScalarResult();
        }catch (\Doctrine\ORM\NoResultException $e){
            return false;
        }

        return $result;
    }



}

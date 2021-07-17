<?php

namespace App\Repository;

use App\Entity\LinkAccessLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LinkAccessLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method LinkAccessLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method LinkAccessLog[]    findAll()
 * @method LinkAccessLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinkAccessLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LinkAccessLog::class);
    }

    // /**
    //  * @return LinkAccessLog[] Returns an array of LinkAccessLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LinkAccessLog
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

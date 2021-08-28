<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\Les2joueursWin1set;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Les2joueursWin1set|null find($id, $lockMode = null, $lockVersion = null)
 * @method Les2joueursWin1set|null findOneBy(array $criteria, array $orderBy = null)
 * @method Les2joueursWin1set[]    findAll()
 * @method Les2joueursWin1set[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Les2joueursWin1setRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Les2joueursWin1set::class);
    }

    // /**
    //  * @return Les2joueursWin1set[] Returns an array of Les2joueursWin1set objects
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
    public function findOneBySomeField($value): ?Les2joueursWin1set
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

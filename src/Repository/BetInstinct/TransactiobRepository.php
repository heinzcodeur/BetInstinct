<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\Transactiob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transactiob|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transactiob|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transactiob[]    findAll()
 * @method Transactiob[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactiobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transactiob::class);
    }

    // /**
    //  * @return Transactiob[] Returns an array of Transactiob objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Transactiob
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

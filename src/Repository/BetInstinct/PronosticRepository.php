<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\Pronostic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Pronostic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pronostic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pronostic[]    findAll()
 * @method Pronostic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PronosticRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pronostic::class);
    }

    // /**
    //  * @return Pronostic[] Returns an array of Pronostic objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pronostic
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

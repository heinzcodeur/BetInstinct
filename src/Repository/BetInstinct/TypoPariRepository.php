<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\TypoPari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypoPari|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypoPari|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypoPari[]    findAll()
 * @method TypoPari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypoPariRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypoPari::class);
    }

    // /**
    //  * @return TypoPari[] Returns an array of TypoPari objects
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
    public function findOneBySomeField($value): ?TypoPari
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

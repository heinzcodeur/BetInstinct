<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\TypedePari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypedePari|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypedePari|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypedePari[]    findAll()
 * @method TypedePari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypedePariRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypedePari::class);
    }

    // /**
    //  * @return TypedePari[] Returns an array of TypedePari objects
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
    public function findOneBySomeField($value): ?TypedePari
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

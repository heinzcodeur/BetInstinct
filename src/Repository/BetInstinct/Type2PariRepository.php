<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\Type2Pari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Type2Pari|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type2Pari|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type2Pari[]    findAll()
 * @method Type2Pari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Type2PariRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type2Pari::class);
    }

    // /**
    //  * @return Type2Pari[] Returns an array of Type2Pari objects
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
    public function findOneBySomeField($value): ?Type2Pari
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

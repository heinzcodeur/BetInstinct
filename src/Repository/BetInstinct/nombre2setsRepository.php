<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\nombre2sets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method nombre2sets|null find($id, $lockMode = null, $lockVersion = null)
 * @method nombre2sets|null findOneBy(array $criteria, array $orderBy = null)
 * @method nombre2sets[]    findAll()
 * @method nombre2sets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class nombre2setsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, nombre2sets::class);
    }

    // /**
    //  * @return nombre2sets[] Returns an array of nombre2sets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?nombre2sets
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

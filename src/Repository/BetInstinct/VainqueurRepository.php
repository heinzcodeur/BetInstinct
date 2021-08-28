<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\Vainqueur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vainqueur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vainqueur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vainqueur[]    findAll()
 * @method Vainqueur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VainqueurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vainqueur::class);
    }

    // /**
    //  * @return Vainqueur[] Returns an array of Vainqueur objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vainqueur
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

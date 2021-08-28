<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\Type2choix;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Type2choix|null find($id, $lockMode = null, $lockVersion = null)
 * @method Type2choix|null findOneBy(array $criteria, array $orderBy = null)
 * @method Type2choix[]    findAll()
 * @method Type2choix[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Type2choixRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Type2choix::class);
    }

    // /**
    //  * @return Type2choix[] Returns an array of Type2choix objects
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
    public function findOneBySomeField($value): ?Type2choix
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

<?php

namespace App\Repository\BetInstinct;

use App\Entity\BetInstinct\FormulePari;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormulePari|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormulePari|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormulePari[]    findAll()
 * @method FormulePari[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormulePariRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormulePari::class);
    }

    // /**
    //  * @return FormulePari[] Returns an array of FormulePari objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FormulePari
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

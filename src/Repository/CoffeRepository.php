<?php

namespace App\Repository;

use App\Entity\Coffe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coffe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coffe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coffe[]    findAll()
 * @method Coffe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoffeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coffe::class);
    }

    // /**
    //  * @return Coffe[] Returns an array of Coffe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Coffe
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

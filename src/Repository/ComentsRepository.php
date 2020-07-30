<?php

namespace App\Repository;

use App\Entity\Coments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Coments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coments[]    findAll()
 * @method Coments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coments::class);
    }

    // /**
    //  * @return Coments[] Returns an array of Coments objects
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
    public function findOneBySomeField($value): ?Coments
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

<?php

namespace App\Repository;

use App\Entity\Beekeeper;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Beekeeper|null find($id, $lockMode = null, $lockVersion = null)
 * @method Beekeeper|null findOneBy(array $criteria, array $orderBy = null)
 * @method Beekeeper[]    findAll()
 * @method Beekeeper[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeekeeperRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Beekeeper::class);
    }

    /**
     * @return Beekeeper[] Returns an array of Beekeeper objects
     */
    public function findBeekeeprProductList($id)
    {
        return $this->createQueryBuilder('b')
            ->leftJoin('b.products', 'p')
            ->leftJoin('p.beekeeper', 'b')
            ->addSelect('p', 'b')
            ->where('b.id= :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Beekeeper[] Returns an array of Beekeeper objects
     */
    public function findLastbeekeepr()
    {
        return $this->createQueryBuilder('b')
            ->orderBy('b.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Beekeeper
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

declare(strict_types=1);

namespace Lotriss\Eav\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lotriss\Eav\Entity\EavAttributeDatetime;

/**
 * @method EavAttributeDatetime|null find($id, $lockMode = null, $lockVersion = null)
 * @method EavAttributeDatetime|null findOneBy(array $criteria, array $orderBy = null)
 * @method EavAttributeDatetime[]    findAll()
 * @method EavAttributeDatetime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EavAttributeDatetimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EavAttributeDatetime::class);
    }

    // /**
    //  * @return EavAttributeDatetime[] Returns an array of EavAttributeDatetime objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EavAttributeDatetime
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

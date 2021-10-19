<?php

declare(strict_types=1);

namespace Lotriss\Eav\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lotriss\Eav\Entity\EavAttributeDecimal;

/**
 * @method EavAttributeDecimal|null find($id, $lockMode = null, $lockVersion = null)
 * @method EavAttributeDecimal|null findOneBy(array $criteria, array $orderBy = null)
 * @method EavAttributeDecimal[]    findAll()
 * @method EavAttributeDecimal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EavAttributeDecimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EavAttributeDecimal::class);
    }

    // /**
    //  * @return EavAttributeDecimal[] Returns an array of EavAttributeDecimal objects
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
    public function findOneBySomeField($value): ?EavAttributeDecimal
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

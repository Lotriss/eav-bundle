<?php

declare(strict_types=1);

namespace Lotriss\Eav\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lotriss\Eav\Entity\EavAttributeVarchar;

/**
 * @method EavAttributeVarchar|null find($id, $lockMode = null, $lockVersion = null)
 * @method EavAttributeVarchar|null findOneBy(array $criteria, array $orderBy = null)
 * @method EavAttributeVarchar[]    findAll()
 * @method EavAttributeVarchar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EavAttributeVarcharRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EavAttributeVarchar::class);
    }

    // /**
    //  * @return EavAttributeVarchar[] Returns an array of EavAttributeVarchar objects
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
    public function findOneBySomeField($value): ?EavAttributeVarchar
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

<?php

namespace Lotriss\Eav\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lotriss\Eav\Entity\EavAttributeText;

/**
 * @method null|EavAttributeText find($id, $lockMode = null, $lockVersion = null)
 * @method null|EavAttributeText findOneBy(array $criteria, array $orderBy = null)
 * @method EavAttributeText[]    findAll()
 * @method EavAttributeText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EavAttributeTextRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EavAttributeText::class);
    }

    // /**
    //  * @return EavAttributeText[] Returns an array of EavAttributeText objects
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
    public function findOneBySomeField($value): ?EavAttributeText
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

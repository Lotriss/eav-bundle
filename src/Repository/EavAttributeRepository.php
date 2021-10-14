<?php

namespace Lotriss\Eav\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Lotriss\Eav\Entity\EavAttribute;

/**
 * @method null|EavAttribute find($id, $lockMode = null, $lockVersion = null)
 * @method null|EavAttribute findOneBy(array $criteria, array $orderBy = null)
 * @method EavAttribute[]    findAll()
 * @method EavAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EavAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EavAttribute::class);
    }

    public function getAttributeByCode(string $code, string $entityName): ?EavAttribute
    {
        return $this->createQueryBuilder('eav')
            ->andWhere('eav.code = :code')
            ->setParameter('code', $code)
            ->andWhere('eav.entityName = :entityName')
            ->setParameter('entityName', $entityName)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $entityName
     *
     * @return EavAttribute[]
     */
    public function getAttributesByEntityName(string $entityName): array
    {
        return $this->createQueryBuilder('eav')
            ->andWhere('eav.entityName = :entityName')
            ->setParameter('entityName', $entityName)
            ->getQuery()
            ->getResult();
    }

    public function save(EavAttribute $eavAttribute): void
    {
        $this->getEntityManager()->persist($eavAttribute);
        $this->getEntityManager()->flush();
    }
}

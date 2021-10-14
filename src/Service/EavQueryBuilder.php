<?php

namespace Lotriss\Eav\Service;

use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\QueryBuilder;
use Lotriss\Eav\Entity\EavAttribute;
use Lotriss\Eav\Service\Exception\BadSearchAttributeException;
use Lotriss\Eav\Service\Exception\UnknownEavAttributeException;

class EavQueryBuilder
{
    private EavConfig $eavConfig;

    private EavHelper $eavHelper;

    public function __construct(EavConfig $eavConfig, EavHelper $eavHelper)
    {
        $this->eavConfig = $eavConfig;
        $this->eavHelper = $eavHelper;
    }

    public function getQuery(string $entityName, array $searchParams, QueryBuilder $qb): QueryBuilder
    {
        $qb->from($entityName, 'entity');
        $attributes = $this->eavConfig->getEavSettingsForEntity($entityName);
        $select = ['entity.id', 'entity.slug'];
        foreach ($attributes as $attribute) {
            $selectCode = $attribute->getSelectCode();
            $select[] = vsprintf('%s.value as %s', [$selectCode, $attribute->getCode()]);
            $conditionString = vsprintf('entity.id = %s.entityId AND %s.attributeId = %d', [$selectCode, $selectCode, $attribute->getId()]);
            $qb->leftJoin($this->eavHelper->getEavEntityClassByType($attribute->getType()), $selectCode, Join::WITH, $conditionString);
        }
        $qb->select($select);
        foreach ($searchParams as $attributeCode => $searchParam) {
            if (!isset($attributes[$attributeCode])) {
                throw new UnknownEavAttributeException(vsprintf('Unknown attribute %s in search parameters', [$attributeCode]));
            }
            $this->buildWhereConditions($attributes[$attributeCode], $searchParam, $qb);
        }

        return $qb;
    }

    private function buildWhereConditions(EavAttribute $attribute, array $searchData, QueryBuilder $qb): void
    {
        if ('none' === $attribute->getSearchType()) {
            throw new BadSearchAttributeException();
        }
        foreach ($searchData as $condType => $data) {
            if (!$this->validateSearchCondAgainstAttribute($condType, $attribute)) {
                throw new BadSearchAttributeException();
            }
            if ('eq' === $condType) {
                $qb->andWhere($attribute->getSelectCode().'.value'.' = :'.$attribute->getSelectCode());
                $qb->setParameter($attribute->getSelectCode(), $data);
            } elseif ('like' === $condType) {
                $qb->andWhere($attribute->getSelectCode().'.value'.' LIKE :'.$attribute->getSelectCode());
                $qb->setParameter($attribute->getSelectCode(), sprintf('%%%s%%', $data));
            }
        }
    }

    private function validateSearchCondAgainstAttribute(string $searchCond, EavAttribute $attribute): bool
    {
        if ('like' === $attribute->getSearchType()) {
            $allowedSearchConditions = ['like', 'eq'];
        } elseif ('exact' === $attribute->getSearchType()) {
            $allowedSearchConditions = ['eq'];
        } elseif ('compare_operations' === $attribute->getSearchType() && in_array($attribute->getType(), ['decimal', 'int'])) {
            $allowedSearchConditions = ['eq', 'neq', 'gt', 'lt', 'gte', 'lte'];
        } else {
            $allowedSearchConditions = [];
        }

        return in_array($searchCond, $allowedSearchConditions);
    }
}

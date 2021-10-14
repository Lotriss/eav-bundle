<?php

namespace Lotriss\Eav\Service;

use Doctrine\ORM\EntityManagerInterface;
use Lotriss\Eav\Entity\EavAttributeDatetime;
use Lotriss\Eav\Entity\EavAttributeDecimal;
use Lotriss\Eav\Entity\EavAttributeInt;
use Lotriss\Eav\Entity\EavAttributeJson;
use Lotriss\Eav\Entity\EavAttributeText;
use Lotriss\Eav\Entity\EavAttributeVarchar;
use Lotriss\Eav\Service\Exception\UnknownEavTypeException;

class EavHelper
{
    public const EAV_TYPE_ENTITY_CLASS = [
        'varchar' => EavAttributeVarchar::class,
        'text' => EavAttributeText::class,
        'int' => EavAttributeInt::class,
        'decimal' => EavAttributeDecimal::class,
        'json' => EavAttributeJson::class,
        'datetime' => EavAttributeDatetime::class,
    ];

    protected EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEavEntityClassByType(string $type): string
    {
        if (!isset(static::EAV_TYPE_ENTITY_CLASS[$type])) {
            throw new UnknownEavTypeException(vsprintf('Unknown type [%s], probably there is a typo in attribute config', [$type]));
        }

        return static::EAV_TYPE_ENTITY_CLASS[$type];
    }
}
